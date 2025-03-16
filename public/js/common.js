let datatable;

/**
 * This file will be used by all view in this system
 */

// Add class to app
let windowWidth = $(window).width();
// if (768 <= windowWidth && windowWidth <= 991) $('.app').addClass('is-folded');

// Default error handler for api exception
let eHandler;

let momentFormat = {
    full: 'HH:mm:ss DD/MM/YYYY',
    full_reverse: 'YYYY/MM/DD HH:mm:ss',
    date: 'DD/MM/YYYY',
    date_reverse: 'YYYY/MM/DD',
    date_stroke: 'DD-MM-YYYY',
    date_reverse_stroke: 'YYYY-MM-DD',
    datetime_picker: 'YYYY-MM-DD HH:mm:ss',
};

function getMsgFromException(error) {
    let msg = 'Lỗi chưa xác định!';
    try {
        if (typeof error['responseJSON']['errors'] !== "undefined") {
            msg = Object.values(error['responseJSON']['errors'])[0][0]
        } else {
            msg = error['responseJSON']['message'] || error.statusText;
        }
    } catch (e) {
        console.error('getMsgFromException', error);
    }

    return msg;
}

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Init select2
    if (typeof $().select2 !== "undefined") $('.select2').select2({
        language: 'vi'
    });

    if ($('#alertModal').length) {
        const cookieKey = 'hide_notify' + window.location.pathname;

        const hideNotify = $.cookie(cookieKey);
        if (!hideNotify) {
            $('#alertModal').modal();

            $('#btn-hide-notify').click(function() {
                $('#alertModal').modal('hide');

                $.cookie(cookieKey, 1, { expires: 30 });
            });
        }
    }

    $('.desktop-toggle').click(function() {
        $('body > .app').toggleClass('is-folded');
    });

    $('.mobile-toggle').click(function() {
        $('body > .app').toggleClass('is-expand');
    });

    if (typeof toastr !== "undefined")
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

    if (typeof $.fn.dataTable !== 'undefined') {
        $.fn.dataTable.ext.errMode = 'none';
        $.extend( $.fn.dataTable.defaults, {
            initComplete: function() {
                $('[data-toggle="tooltip"]').tooltip();

                // hien thi lai tooltip khi table reload
                this.api().on('draw.dt', function() {
                    $('table.dataTable [data-toggle="tooltip"]').tooltip();
                });
            },
            "language": {
                "sProcessing":   "Đang xử lý...",
                "sLengthMenu":   "Xem _MENU_ mục",
                "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
                "emptyTable":  "Không tìm thấy dòng nào phù hợp",
                "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
                "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                "sInfoPostFix":  "",
                "sSearch":       "Tìm:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "Đầu",
                    "sPrevious": "Trước",
                    "sNext":     "Tiếp",
                    "sLast":     "Cuối"
                }
            }
        });
    }

    $('form.form-json').submit(function(e) {
        e.preventDefault();

        if (typeof CKEDITOR !== "undefined" && Object.keys(CKEDITOR.instances).length > 0) {
            Object.keys(CKEDITOR.instances).forEach(function(key) {
                CKEDITOR.instances[key].updateElement();
            });
        }

        let reload = $(this).data('reload');
        let runAfterDone = $(this).data('done');
        let keepModal = !!$(this).data('keep_modal');
        let formData = new FormData($(this)[0]);

        let showInfo = toastr.info;
        let showSuccess = toastr.success;
        let showError = toastr.error;

        if ($(this).closest('.modal').length) {
            showInfo = swalLoading;
            showSuccess = swalSuccess;
            showError = swalError;
        }

        showInfo('Đang xử lý...');

        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                showSuccess(data && data.message ? data.message : 'Thao tác thành công!');
                // data when 204 No Content

                if (typeof data === 'undefined' || data.message) {

                    if (reload) return window.location.reload();

                    if (!keepModal && $('.modal.show').length) $('.modal.show').modal('hide');
                    if (runAfterDone && typeof window[runAfterDone] !== 'undefined') {
                        window[runAfterDone](data);
                    } else {
                        reloadTable();
                    }
                } else {
                    showError('Thao tác thất bại!');
                }
            },
            error: function(a) {
                showError(a['responseJSON'].message);
            }
        });
    });

    if (typeof toastr === 'undefined') window.toastr = {};

    toastr.errorX = function(error) {
        console.error(error)

        if (swal && typeof swal.close === 'function') swal.close();

        toastr.error(getMsgFromException(error));
    };
    eHandler = toastr.errorX;

    toastr.successX = function(result, withReload = false, delay = 1500) {
        if (result.code === 200) {
            let msg = 'Thao tác thành công!';
            try {
                msg = result['message'];
            } catch (e) { }
            toastr.success(msg);

            if (withReload === true) {
                setTimeout(function() {
                    window.location.reload();
                }, delay);
            }
        } else {
            toastr.error('Lỗi chưa xác định!');
        }
    };

    if (typeof $.fn.datepicker !== 'undefined') !function(a){
        a.fn.datepicker.dates.vi = {
            days:[ "Chủ nhật","Thứ hai","Thứ ba","Thứ tư","Thứ năm","Thứ sáu","Thứ bảy"],
            daysShort:["CN","Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7"],
            daysMin:["CN","T2","T3","T4","T5","T6","T7"],
            months:["Tháng 1","Tháng 2","Tháng 3","Tháng 4","Tháng 5","Tháng 6","Tháng 7","Tháng 8","Tháng 9","Tháng 10","Tháng 11","Tháng 12"],
            monthsShort:["Th1","Th2","Th3","Th4","Th5","Th6","Th7","Th8","Th9","Th10","Th11","Th12"],
            today:"Hôm nay",
            clear:"Xóa",
            format:"dd/mm/yyyy"}
    }(jQuery);

    $('input.has-preview[type="file"]').change(function() {
        let file = $(this).prop('files')[0];
        let imagePreview = $(this).parent().find('.image-preview');
        if (file) imagePreview.attr('src', URL.createObjectURL(file));
    });
});

function callAjaxGet(url) {
    return callAjax(url, {}, 'GET');
}

function callAjaxPost(url, data = {}, isFormData = false) {
    return callAjax(url, data, 'POST', isFormData);
}

function callAjax(url, data, method, isFormData = false) {
    return new Promise((resolve, reject) => {
        let requestObj = {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url,
            method,
            data,
            dataType: 'JSON',
            success: function(result) {
                return resolve(result);
            },
            error: function(err) {
                return reject(err);
            }
        };
        if (isFormData) {
            requestObj.processData = false;
            requestObj.contentType = false;
        }
        $.ajax(requestObj);
    });
}

function formatMoney(input, suffix = '', round = true) {
    if (!input) return '0';
    if (round) {
        input = (parseInt(input) + 0.5).toString();
    } else {
        input = input.toString();
    }

    let negative = false;
    if (input.substr(0, 1) === '-') {
        input = input.substr(1);
        negative = true;
    }
    if (round) {
        input = parseInt(input);
    } else {
        input = parseFloat(input);
    }
    return (negative ? '-' : '') + input.toLocaleString('en-GB') + suffix;
}

// Set menu active item
let currentUrl = window.location.origin + window.location.pathname;
if (currentUrl.endsWith('/')) currentUrl = currentUrl.substring(0, currentUrl.length - 1);
let activeItem = $('.side-nav li > a[href="' +currentUrl+ '"]').first();
if (activeItem.length) {
    $(activeItem).parent().addClass('active');

    // Loop to parents and find dropdown
    let loopParent = 5;
    let parent = activeItem;
    for (let i = 0; i < loopParent; i++) {
        parent = $(parent).parent();
        if (parent.hasClass('dropdown')) parent.addClass('open');
        if (parent.hasClass('dropdown-menu')) parent.show();
    }
} else {
    // Maybe special case
    activeItem = $(`.dropdown-toggle[data-link="${currentUrl}"]`);
    if (!activeItem.length) {
        activeItem = $(`.link-shop[data-link="${currentUrl}"]`);
        if (activeItem.length) activeItem = activeItem.parent();
    }

    if (activeItem.length) {
        activeItem.addClass('active');
        const parent = $(activeItem).parent();
        parent.addClass('open');
        parent.parent().closest('.dropdown').addClass('open');
    }
}
$('.nav-choose').click(function(){
    $('.nav-choose').removeClass('active');
});
$('.nav-choose .server-box').click(function(e){
    e.stopPropagation();
});
$('.toogle-nav').click(function (e) {
    e.preventDefault();
    $('.nav-choose').addClass('active')
});

// function getMoment(timeString) {
//     timeString = timeString.toString().trim();
//     let format = 'DD/MM/YYYY';
//     if (timeString.length == 10) {
//         if (timeString.match(/\d{4}-\d{2}-\d{2}/)) format = 'YYYY-MM-DD';
//     } else if (timeString.length > 10) {
//         if (timeString.match(/\d{4}-\d{2}-\d{2}/)) {
//             format = 'YYYY-MM-DD hh:mm:ss';
//         } else {
//             format = 'hh:mm:ss DD/MM/YYYY';
//         }
//     }
//
//     return moment(timeString, format);
// }

function getOrderStatus(status) {
    let mapping = {
        status_0: 'Hoàn thành',
        status_1: 'Đang chạy',
        status_2: 'ID Lỗi / Die',
        status_3: 'Hủy đơn',
        status_50: 'Tracking',
        status_93: 'Order Sai/Lỗi',
        status_94: 'Chờ xử lý',
        status_95: 'Hoàn tiền 1 phần',
        status_96: 'Chờ Hoàn tiền',
        status_97: 'Hoàn tiền',
        status_98: 'Chờ huỷ đơn',
        status_99: 'Bảo hành',
        status_100: 'Đang xử lý',
    };

    return mapping['status_' + status] || 'NULL';
}

/**
 * Define table components for render
 */
let components = {
    text_tag_p: value => value != null? `<span style="color:#72849a">${value}</span>` : '',
    text_primary: value => value != null? `<span class="text-primary">${value}</span>` : '',
    text_success: value => value != null? `<span class="text-success">${value}</span>` : '',
    text_green: value => value != null? `<span class="text-green">${value}</span>` : '',
    text_money: value => value != null? `<span class="text-money">${value}</span>` : '',
    // text_info: value => value != null? `<span class="text-info">${value}</span>` : '',
    text_warning: value => value != null? `<span class="text-warning">${value}</span>` : '',
    text_danger: value => value != null? `<span class="text-danger">${value}</span>` : '',
    text_secondary: value => value != null? `<span class="text-secondary">${value}</span>` : '',
    visible: value => `<span>${parseInt(value) == 1 ? 'Bật' : 'Tắt'}</span>`,

    number: value => value != null? `<span>${formatMoney(value)}</span>` : '',
    money: value => value != null? `<span class="text-money">${formatMoney(value)}</span>` : '',
    user_read: user_read => `<span>${user_read ? 'Đã đọc' : 'Chưa đọc'}</span>`,
    reason: (value, t, order) => {
      if (![3, 4, 97].includes(order.status) || !value) return '';
      return `<span style="color:#fa8c16">${value}</span>`
    },
    order_status: status => {
        if (status == 0) return `<span class="badge badge-pill badge-cyan status"><i class="anticon anticon-check-circle" style="vertical-align: -.3em;"></i> ${getOrderStatus(status)}</span>`;
        if (status == 1) return `<span class="badge badge-pill badge-geekblue status"><i class="anticon anticon-thunderbolt" style="vertical-align: -.3em;"></i> ${getOrderStatus(status)}</span>`;
        if (status == 2) return `<span class="badge badge-pill badge-red status"><i class="anticon anticon-issues-close" style="vertical-align: -.3em;"></i> ${getOrderStatus(status)}</span>`;
        if (status == 3) return `<span class="badge badge-pill badge-red status"><i class="anticon anticon-disconnect" style="vertical-align: -.3em;"></i> ${getOrderStatus(status)}</span>`;
        if (status == 50) return `<span class="badge badge-pill badge-magenta status"><i class="anticon anticon-search" style="vertical-align: -.3em;"></i> ${getOrderStatus(status)}</span>`;
        if (status == 93) return `<span class="badge badge-pill badge-purple status"><i class="anticon anticon-warning" style="vertical-align: -.3em;"></i> ${getOrderStatus(status)}</span>`;
        if (status == 94) return `<span class="badge badge-pill badge-gold status"><i class="anticon anticon-loading" style="vertical-align: -.3em;"></i> ${getOrderStatus(status)}</span>`;
        if (status == 95) return `<span class="badge badge-pill badge-green status"><i class="anticon anticon-dollar" style="vertical-align: -.3em;"></i> ${getOrderStatus(status)}</span>`;
        if (status == 96) return `<span class="badge badge-pill badge-green status"><i class="anticon anticon-dollar" style="vertical-align: -.3em;"></i> ${getOrderStatus(status)}</span>`;
        if (status == 97) return `<span class="badge badge-pill badge-magenta status"><i class="anticon anticon-undo" style="vertical-align: -.3em;"></i> ${getOrderStatus(status)}</span>`;
        if (status == 98) return `<span class="badge badge-pill badge-orange status"><i class="anticon anticon-file-sync" style="vertical-align: -.3em;"></i> ${getOrderStatus(status)}</span>`;
        if (status == 99) return `<span class="badge badge-pill badge-purple status"><i class="anticon anticon-pushpin" style="vertical-align: -.3em;"></i> ${getOrderStatus(status)}</span>`;
        if (status == 100) return `<span class="badge badge-pill badge-volcano status"><i class="anticon anticon-exception" style="vertical-align: -.3em;"></i> ${getOrderStatus(status)}</span>`;
    },
    money_before: (money_before, t, row) => {
        if (!money_before) return ' ';
        let html = `<span class="text-primary">${formatMoney(money_before)}</span>`;
        money_before = Number(money_before);
        let realAmount = row.money_after + row.price;
        if (row.event_name === 'refund') realAmount = row.money_after - row.price;
        if (!isNaN(realAmount) && realAmount !== money_before && Math.abs(realAmount - money_before) > 10)
            html += "<span class='text-danger'><i class='anticon anticon-exclamation-circle'></i></span>";
        return html;
    },
    money_after: value => value != null? `<span class="text-secondary">${formatMoney(value)}</span>` : '',
    bool: value => !!value ? 'Có' : 'Không',
    note: function(note, t, full) {
        if (!note) note = '';
        return `<span data-id="${full.id}" contentEditable="true" class="content-editable">${note}</span>`;
    },
    enable: enable => enable ? 'Không' : 'Có',
    btn_view: function(id, className = 'btn-view') {
        return `<button class="btn btn-tone btn-sm btn-primary btn-nw ${className}" data-id="${id}"><i class="anticon anticon-eye"></i>Xem</button>`;
    },
    btn_view_instruction_manual: function(id, content) {
        return `<button class="btn btn-tone btn-sm btn-success btn-nw btn-view-instruction-manual"
                        data-content="${content}" data-id="${id}"><i class="anticon anticon-book"></i>Xem HDSD</button>`;
    },
    btn_edit: function(id, className = 'btn-edit') {
        return `<button class="btn btn-tone btn-primary btn-sm ${className}" data-id="${id}"><i class="anticon anticon-edit"></i> Sửa</button>`;
    },
    btn_delete: function(id, className = 'btn-delete', text = 'Xóa') {
        return `<button class="btn btn-tone btn-danger btn-sm ${className}" data-id="${id}"><i class="anticon anticon-delete"></i> ${text}</button>`;
    },
    amount_with_bonus: (value, t, row) => {
        let text = `<span class="text-tomato">${formatMoney(value)}</span>`;
        if (row.bonus_amount) text += `<br /><span class="text-success">+${formatMoney(row.bonus_amount)}</span>`;

        return text;
    },
};

/**
 *
 * @param {string} title data title
 * @param {string} name data name to display
 * @param {string|function|null} render -> if string, it will be taken from $components, else it should be empty or an function
 * @param {boolean} disableOrder
 * @param {boolean} disableSearch
 * @param {boolean} visible
 * @returns {Object}
 */
function makeColumn(title, name, render = null, disableOrder = true, disableSearch = true, visible = true) {
    let obj = {
        title: title,
        data: name,
        name: name
    };
    obj.visible = visible

    if (disableOrder) obj.orderable = false;
    if (disableSearch) obj.searchable = false;

    // Some field will be enable search automatically
    if (['order_id', 'uid', 'link', 'id', 'user.username', 'description', 'bank_content', 'domain',
        'admin_username', 'type', 'display_name', 'phone', 'request_url', 'payload', 'response'].includes(name)) obj.searchable = true;

    if (render) {
        if (typeof render === 'string') obj.render = components[render];
        else obj.render = render;
    }
    return obj;
}

let definedColumns = {
    total_price: makeColumn('Tổng tiền', 'total_price', 'money'),
    username: makeColumn('Tài khoản', 'username', (status, t, ticket) => {
        return ticket.user.username;
    }, true),
    note: makeColumn('Ghi chú', 'note', 'note', true),
    created_at: makeColumn('Thời gian', 'created_at'),
    reason: makeColumn('Lý do', 'reason', 'reason', true),
    action: render => {return { title: 'Tác vụ', data: 'id', name: 'id', orderable: false, searchable: false, render}},
    id: makeColumn('Mã Đơn', 'id'),
    priority: makeColumn('Thứ tự', 'priority'),
    is_visible: makeColumn('Hiển thị', 'is_visible', 'bool'),
    title: makeColumn('Tiêu đề', 'title'),
    updated_at: makeColumn('Cập nhật cuối', 'updated_at', 'created_at'),
    id_sortable: makeColumn('STT', 'id', null, false),
    bank_name: makeColumn('Ngân Hàng', 'bank_name', (bank_name, t, row) => {
        return `<img class="b-d-5" src="/images/banks/icon/${bank_name}.png" style="width: ${row.size}px" alt="" />` +
            `<span> ${bank_name}</span>`
    }),
    payment_bank_name: makeColumn('Ngân Hàng', 'payment_information', function (payment_information) {
        // Trả về nếu k liên kết với ngân hàng nào
        if (!payment_information) return 'Khác';

        let icon = `<img class="b-d-5" src="/images/banks/icon/${payment_information.bank_name}.png" style="width: ${payment_information.size}px" alt="" />`;
        return icon + `<span> ${payment_information.bank_name}</span>`
    }, true),
    transaction_amount: makeColumn('Số Tiền (đ)', 'amount', (amount, t, row) => {
        if (!row.balance_history) return `<span class="text-danger">${formatMoney(amount)}</span>`;

        if (row.math == 0) {
            return `<span class="text-tomato">- ${formatMoney(amount)}</span>`;
        } else {
            return `<span class="text-success">+ ${formatMoney(amount)}</span>`;
        }
    }),
    balance_before: makeColumn('Tiền Trước', 'balance_history',(balance_history) => {
        if (!balance_history) return 0;
        return formatMoney(balance_history.balance_before)
    }),
    balance_after: makeColumn('Số Dư (đ)', 'balance_history', (balance_history) => {
        if (!balance_history) return 0;
        return `<span style="color:#886cff">${formatMoney(balance_history.balance_after)}</span>`;
    }),
    payment_transaction_status: makeColumn('Trạng Thái', 'status', (status, t, row) => {
        if (row.math == 0) {
            return '<span class="badge badge-pill badge-cyan">Đã Thanh Toán</span>';
        }
        if (row.math == 1) {
            return '<span class="badge badge-pill badge-magenta">Đã Hoàn Tiền</span>';
        }
        if (row.math == 2) {
            return '<span class="badge badge-pill badge-secondary">Hoa Hồng</span>';
        }
    }),
    order_status: makeColumn('Trạng thái', 'status', (status, t, order) => {
        if (order.found_uid) {
            return `<span class="badge badge-pill badge-red status"><i class="anticon anticon-pushpin" style="vertical-align: -.3em;"></i> Bảo Hành</span>`;
        }

        const configMap = {
            [STATUSES.completed]: { icon: 'anticon-check-circle', class: 'badge-cyan' },
            [STATUSES.running]: { icon: 'anticon-thunderbolt', class: 'badge-geekblue' },
            [STATUSES.error]: { icon: 'anticon-issues-close', class: 'badge-red' },
            [STATUSES.cancelled]: { icon: 'anticon-disconnect', class: 'badge-red' },
            [STATUSES.tracking]: { icon: 'anticon-search', class: 'badge-magenta' },
            [STATUSES.order_error]: { icon: 'anticon-warning', class: 'badge-purple' },
            [STATUSES.pending]: { icon: 'anticon-loading', class: 'badge-gold' },
            [STATUSES.partial]: { icon: 'anticon-dollar', class: 'badge-green' },
            [STATUSES.timeout]: { icon: 'anticon-dollar', class: 'badge-green' },
            [STATUSES.refund]: { icon: 'anticon-undo', class: 'badge-magenta' },
            [STATUSES.waiting_cancel]: { icon: 'anticon-file-sync', class: 'badge-orange' },
            [STATUSES.need_warranty]: { icon: 'anticon-pushpin', class: 'badge-purple' },
            [STATUSES.lack_money]: { icon: 'anticon-exception', class: 'badge-volcano' }
        };

        const config = configMap[status];
        if (config) {
            let matchText = '';
            for (let obj of Object.values(EnumOrderStatus)) {
                if (obj.value != status) continue;

                matchText = obj.text;
                break;
            }

            return `<span class="badge badge-pill ${config.class} status"><i class="anticon ${config.icon}" style="vertical-align: -.3em;"></i> ${matchText}</span>`;
        }
        return 'NULL';

    }),
    quantity: makeColumn('Số Lượng', 'quantity'),
    price: makeColumn('Đơn Giá', 'price'),
    total: makeColumn('Tổng Đơn', 'total', total => {
        return formatMoney(total);
    }),
    warranty_time_left: makeColumn('Thời Gian Bảo Hành',  'warranty_time_left', value => {
        if (value == 'Hết hạn') return value;

        return `<div class="d-flex">
                    <img style="width: 18px" src="/images/others/sand-clock.png" alt="" />
                    <div>${value}</div>
                </div>`;
    }),
    time: makeColumn('Thời Gian', 'time'),
    order_name: makeColumn('Loại', 'category', category => {
        return `<span>
                    <span><img src="${category.image}" class="img-flag" alt="" /></span>
                    <span style="color: #0078e3">${category.name}</span>
                </span>`
    }),
    description: makeColumn('Nhiệm vụ', 'description', 'text_tag_p'),
};

function textToArray(text) {
    return text.split("\n").map(x => x.trim()).filter(x => !!x);
}

function countLine(text) {
    try {
        return textToArray(text).length;
    } catch (e) {
        console.error(e);
        return 0;
    }
}

$(document).on('click', '.btn-copy', function() {
    /* Get the text field */
    let copyText = document.getElementById($(this).data('target'));

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    document.execCommand("copy");

    toastr.success('Đã sao chép!');
});

$(document).on('click', '.input-copy', function() {
    /* Get the text field */
    let copyText = this;

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    document.execCommand("copy");

    toastr.success('Đã sao chép!');
});


$(document).on('click', '.copy-on-click', function() {
    let text = $(this).html().trim();
    if (!text) return;
    const el = document.createElement('textarea');
    el.value = text;
    document.body.appendChild(el);
    el.select();
    el.setSelectionRange(0, 99999); /* For mobile devices */
    document.execCommand('copy');
    document.body.removeChild(el);

    toastr.success('Đã sao chép!');
});

function formatNumber(input) {
    if (!input || Number(input) == 0) return input;

    let newValue = input.toString().replace(/[^\d.]/g, '');
    let firstDotIndex = newValue.indexOf('.');
    newValue = newValue.replace(/\./g, (match, index) => index === firstDotIndex ? '.' : '');

    let part1 = newValue.split('.')[0], part2 = newValue.split('.')[1];

    if (part1 !== '0') {
        part1 = part1.toString()
            .replace(/^0+/, '')
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }

    if (part2 !== undefined) part1 += '.' + part2;

    return part1;
}

$('form.form-reload-table').submit(function(e) {
    e.preventDefault();
    let that = this;

    swalLoading();
    $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: $(this).serialize(),
        success: function(data) {
            swal.close();
            // Handle response 200 but does not have correct format
            if (data.code !== 200) return swalError('Có lỗi xảy ra!');
            // Just reset form and datatable
            datatable.ajax.reload(null, false);
            swalSuccess();
            $('.modal').modal('hide');
            $(that).trigger("reset");
        },
        error: swalX
    });
});

function onLogout() {
    callAjaxPost( '/auth/logout').then(() => {
        window.location.href = '/';
    });
}

function capitalize(string) {
    return string.toString().charAt(0).toUpperCase() + string.slice(1);
}

function hideModal() {
    $('.modal.show').modal('hide');
}

function reloadTable() {
    if (typeof datatable !== "undefined" && datatable) datatable.ajax.reload(null, false);
}

// Định dạng lại input dạng số sang xxx.xxx.xxx (bắt buộc phải để kiểu text)
$(document).on('keyup', '.input-money', function(){
    let value = $(this).val();

    $(this).val(formatNumber(value));
});

// Định dạng lại input dạng số trước khi submit form
function reformatInputMoney() {
    $('.input-money').each(function() {
        let value = $(this).val();
        if (!value) return;

        $(this).val(value.replace(/[^\d.]/g, ''));
    });
}

// Reformat currency before submit form
$('form').submit(function() {
    reformatInputMoney();
});

function copyToClipboard(text, successMsg = 'Đã Sao Chép!') {
    // Neu la dien thoai
    if (window.innerWidth <= 640) return popupCopy(text);

    // Neu pc
    let temp = $("<textarea>");
    $("body").append(temp);
    temp.val(text).select();
    document.execCommand("copy");
    temp.remove();

    toastr.success(successMsg);
}

const randomId = () => (Math.random() + 1).toString(36).substring(2);

function popupCopy(content) {
    const elmId = randomId();
    const htmlContent = `
        <div>
            <div class="form-group">
                <input class="form-control" id="${elmId}" readonly="">
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-copy" data-target="${elmId}">COPY</button>
            </div>
        </div>
    `

    setTimeout(() => {
        $('#' + elmId).val(content);
    }, 500);

    return swal.fire({
        title: 'Sao chép vào bộ nhớ đệm',
        icon: '',
        html: htmlContent,
        showConfirmButton: false
    })
}

function getObj(obj) {
    if (!obj) return {};
    return JSON.parse(JSON.stringify(obj));
}

function numberToVndCurrency(number) {
    number = Number(number);
    if (number >= 1000000) return formatMoney(Math.ceil(number / 1000000), ' Triệu');
    if (number >= 1000) return formatMoney(Math.ceil(number / 1000), 'K');

    return formatMoney(number);
}

$('.dropdown-toggle').click(function(e) {
    // code xu ly dac biet cho menu user
    const attachedLink = $(this).attr('data-link');
    if (attachedLink && $(e.target).hasClass('goto-view')) {
        window.location.href = attachedLink;
        return;
    }

    $(this).parent().toggleClass('open');
});

function checkLive(uid) {
    return axios
        .get(`https://graph.facebook.com/${uid}/picture?type=normal`)
        .then(response => {
            return !response.request.responseURL.includes('static');
        })
        .catch(() => false)
}

/**
 * Check live 1 mảng ids. callback nếu truyền vào thì sẽ được gọi mỗi khi check live thành công
 * @param arrayIds
 * @param callback
 * @returns {Promise<[]>}
 */
async function checkLives(arrayIds, callback = null) {
    for (let uid of arrayIds) {
        let realUid = uid.toString().trim();
        if (typeof uid == "object") {
            if (!uid.uid) continue;
            realUid = uid.uid.toString();
        }

        if (!realUid.match(/^\d+$/)) {
            let match = uid.toString().match(/(\d+)/);
            if (!match) continue;

            realUid = match[1];
        }

        let live = await checkLive(realUid, true);
        if (typeof callback === "function") callback(uid, live);
    }
}

/**
 * Chia luong va check live
 * @param array mang uid can check live
 * @param threads so luong check live
 * @param callbackCheckLive callback moi lan check live xong 1 uid
 * @param onDone callback khi check live xong
 */
function checkLiveWithThreads(array, threads = 50, callbackCheckLive = null, onDone = null) {
    // Lay ra so luong uid moi luong se check live
    const chunkSize = Math.ceil(array.length / threads);
    // Chuan bi du lieu cho moi luong check live
    const dataPerThreads = [];

    for (let i = 0; i < array.length; i += chunkSize) {
        const chunk = array.slice(i, i + chunkSize);
        dataPerThreads.push(chunk);
    }

    const total = dataPerThreads.length;
    let done = 0;

    dataPerThreads.forEach(listIds => {
        checkLives(listIds, callbackCheckLive).then(() => {
            done++;
            if (done >= total) {
                if (typeof onDone == "function") onDone();
            }
        });
    })
}

function getTimeLeft(timeString) {
    // Parse the date-time string
    const targetTime = moment(timeString, 'YYYY-MM-DD HH:mm:ss');
    const now = moment();

    // Calculate the difference
    const duration = moment.duration(targetTime.diff(now));

    // Get the remaining time in days and hours
    const days = duration.asDays();
    const hours = duration.asHours();

    // Determine the output
    if (days > 1) {
        return `${Math.floor(days)} Ngày`;
    } else if (hours > 1) {
        return `${Math.floor(hours)} Giờ`;
    } else {
        return 'Hết Hạn';
    }
}

function getContentFromString(string, returnArray = false) {
    let array = string.split('\n').map(x => x.trim()).filter(x => x.length);
    return returnArray ? array : array.join('\n');
}

$('.link-shop').click(function(e) {
    e.preventDefault();
    e.stopPropagation();
    window.location.href = $(this).attr('data-link');
});

function chunk(arr, chunkSize) {
    if (chunkSize <= 0) throw "Invalid chunk size";
    let R = [];
    for (let i=0,len=arr.length; i<len; i+=chunkSize)
        R.push(arr.slice(i,i+chunkSize));
    return R;
}

function wait(second) {
    return new Promise(res => setTimeout(() => res(true), second * 1000));
}

function downloadFile(filename, text) {
    const blob = new Blob([text], { type: 'text/plain' });
    const link = document.createElement('a');

    link.href = URL.createObjectURL(blob);

    link.download = filename;

    document.body.appendChild(link);

    link.click();
    document.body.removeChild(link);
}

$(document).on('click', '.icon-close-notify', function() {
    $(this).closest('.custom_notify').parent().remove();
});

