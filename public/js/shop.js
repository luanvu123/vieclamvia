const backgrounds = [
    'linear-gradient(to right, #DE581B, #F3B82B)',
    'linear-gradient(to right, #772061, #C03A4F)',
    'linear-gradient(to right, #D92E00, #FF4500)',
    'linear-gradient(to right, #B03060, #FF6699)',
    'linear-gradient(to right, #FF6F00, #FFD300)',
    'linear-gradient(to right, #FF7F00, #FFAA00)',
    'linear-gradient(to right, #FF4500, #FFA500)',
    'linear-gradient(to right, #D2691E, #FF7F50)',
    'linear-gradient(to right, #FF3F00, #FF6F61)',
];

const app = new Vue({
    el: '#main-content',
    data: {
        bm_categories: [],
        bm_icon: null,
        other_types: [],
        category: null,
        quantity: 1,
        is_mobile: false,
        data_empty: false
    },
    methods: {
        formatTextContent(content) {
            return content.split('|').map(line => '📌 ' + line).join("\n");
        },
        backgroundByIndex(index) {
            return {
                background: backgrounds[index % backgrounds.length]
            }
        },
        formatMoney,
        onShowModalPurchase(category, event) {
            if ($(event.target).hasClass('icon-info') || $(event.target).closest('.view-info').length) {
                this.category = category;
                $('#modalInfo').modal();
                return;
            }

            if (category.quantity == 0) return;

            this.quantity = category.min_purchase || 1;
            this.category = category;
            if (this.quantity > category.quantity) this.quantity = category.quantity;
            $('#modalPurchase').modal();
        },
        showCategoryPrice(category) {
            if (Math.floor(category.price) <= Math.floor(category.discount_price))
                return `<span class="discount-price">${formatMoney(category.discount_price, '₫')}</span>`;
            return `
                <div>
                    <span class="origin-price">${formatMoney(category.price, '₫')}</span>
                    <span class="discount-price">${formatMoney(category.discount_price, '₫')}</span>
                </div>
            `
        },
        async onPurchase() {
            if (!LOGGED_IN) {
                $('#modalPurchase').modal('hide');
                return $('#loginModal').modal();
            }

            const {quantity, category} = this;
            if (!quantity) return;

            if (category.min_purchase && quantity < category.min_purchase) return swalError('Vui lòng mua tối thiểu ' + category.min_purchase);
            if (quantity > category.quantity) return swalError(`Chỉ có ${category.quantity} tài khoản có thể mua!`);

            try {
                swalLoading('Đang Xử lý yêu cầu');
                const apiResult = await callAjaxPost(ROUTE_CREATE_ORDER, {
                    category_id: category.id,
                    quantity
                });

                let extraHtml = '';
                if (apiResult.message.includes('nick đã bị người khác')) {
                    extraHtml = `<p style="color: red;font-weight: 500;font-size: 16px">${apiResult.message}</p>`;
                }

                // check live
                let facebookIds = apiResult.facebook_ids || [];
                if (!facebookIds.length || !apiResult.check_live) {
                    await swalSuccess('Mua thành công, Quý khách vui lòng xem kỹ Hướng dẫn sử dụng và chính sách Bảo hành!', extraHtml);
                    window.location.href = ROUTE_ORDERS;
                    return;
                }

                // Check live
                swalLoading('Đang check Live...');

                let dieCount = 0;
                checkLiveWithThreads(facebookIds, 50,
                    function(uid, live) {
                        if (!live) dieCount++;
                    },
                    async function() {

                        if (dieCount) {
                            try {
                                await callAjaxPost(ROUTE_REPORT_DIE_ACCOUNT, {
                                    order_id: apiResult.order_id,
                                    die_count: dieCount
                                });
                                console.log('report_die_accounts done');
                            } catch (e) {
                                console.error('report_die_accounts error', e);
                            }
                        }

                        await swalSuccess(`Mua Thành công, Live: ${facebookIds.length - dieCount}, Die: ${dieCount}\n` +
                            `Quý khách vui lòng xem kỹ Hướng dẫn sử dụng và chính sách Bảo hành!`);

                        window.location.href = ROUTE_ORDERS;
                    }
                )
            } catch (e) {
                eHandler(e);
            }
        },
        getExportFormats() {
            return this.category.export_format.map(key => ACCOUNT_FIELDS[key]).join(' | ');
        }
    },
    mounted: async function() {
        const parentCategories = await callAjaxPost(ROUTE_CATEGORIES, {
            type_id,
            parent_id,
        });

        let other_types = {};

        parentCategories.forEach(parent => {
            let parentData = {
                id: parent.id,
                name: parent.name,
                children: [],
            };

            parent.children.forEach(category => {
                let formatted = {
                    id: category.id,
                    image: category.image,
                    name: category.name,
                    description: category.data.description,
                    warranty: category.data.warranty,
                    quantity: category.quantity,
                    price: category.price,
                    discount_price: category.discount_price,
                    data: category.data,
                    export_format: category.export_format || [],
                    min_purchase: category.min_purchase,
                    is_bm: parent.type.is_bm
                };

                if (parent.type.is_bm) {
                    app.bm_categories.push(formatted);
                    if (!app.bm_icon) app.bm_icon = parent.type.image;
                } else {
                    parentData.children.push(formatted);
                }
            });

            if (parent.type.is_bm) return;

            if (!other_types[parent.type.id]) other_types[parent.type.id] = {
                name: parent.type.name,
                priority: parent.type.priority,
                image: parent.type.image,
                children: [],
            }

            other_types[parent.type.id].children.push(parentData);
        });

        let types = Object.values(other_types);

        // Sort lai theo priority cua type
        if (types.length > 1) {
            types = types.sort((a, b) => a.priority - b.priority);
        }

        app.other_types = types;

        if (!app.bm_categories.length && !app.other_types.length) app.data_empty = true;
    },
});

function handleResize() {
    app.is_mobile = $(window).width() < 768;
}

$(window).resize(function(){
    handleResize();
});

$(window).ready(function(){
    handleResize();
});

