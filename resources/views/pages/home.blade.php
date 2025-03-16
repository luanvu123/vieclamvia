@extends('layout')
@section('content')

    <div class="main-content" id="main-content">
        <div class="card card-body">
            <div class="custom_notify" data-id="5">
                <div class="notify-content">
                    <img src="{{asset('imgs/notify.svg')}}" alt="" />
                    <div class="notify-content-html">
                        <p class="text-violet font-600 font-size-17">Thông báo</p>
                        <h3><span style="color:#000000"><strong>T&agrave;i nguy&ecirc;n tr&ecirc;n website
                                    chỉ phục vụ mục đ&iacute;ch&nbsp;QUẢNG C&Aacute;O. Kh&aacute;ch
                                    h&agrave;ng c&oacute; h&agrave;nh vi sử dụng vi phạm ph&aacute;p luật
                                    Việt Nam ch&uacute;ng t&ocirc;i kh&ocirc;ng chịu bất cứ tr&aacute;ch
                                    nhiệm n&agrave;o !</strong></span></h3>

                        <p><span style="color:#000000"><strong>👉&nbsp;</strong>Kh&aacute;ch h&agrave;ng
                                cần&nbsp;<strong>bảo h&agrave;nh BM, VIA&nbsp;</strong>-&gt;
                                Chat&nbsp;Support Fanpage</span><strong><span style="color:#000000">:&nbsp;</span><em><span
                                        style="color:#ffffff"><span style="background-color:#00ccff">&nbsp;</span></span><a
                                        href="https://m.me/102980577851649"><span style="color:#ffffff"><span
                                                style="background-color:#00ccff">CHAT
                                                NOW</span></span></a><span style="color:#ffffff"><span
                                            style="background-color:#00ccff">!&nbsp;</span></span></em></strong>
                        </p>

                        <p><span style="color:#000000"><strong>⏱&nbsp;</strong>Thời Gian Hỗ
                                Trợ:<strong>&nbsp;</strong>S&aacute;ng:<strong>&nbsp;09:30 - 12:00
                                    |&nbsp;</strong>Chiều:<strong>&nbsp;14:00 - 19:00
                                    |&nbsp;</strong>Tối:<strong>&nbsp;20:00 - 02:00</strong></span></p>

                        <p><span style="color:#000000"><strong>👉&nbsp;</strong>Group
                                Zalo</span><strong><span style="color:#000000">&nbsp;chia sẻ ADS, cập nhật
                                    th&ocirc;ng b&aacute;o&nbsp;(kh&ocirc;ng b&aacute;n
                                    h&agrave;ng):</span><span style="color:#ffffff">&nbsp;</span><em><a
                                        href="https://zalo.me/g/bvkisc776"><span style="color:#f1c40f"><span
                                                style="background-color:#ff99cc">&nbsp;</span></span><span
                                            style="color:#ffffcc"><span style="background-color:#ff99cc">THAM
                                                GIA</span></span></a><span style="color:#ffffcc"><span
                                            style="background-color:#ff99cc">&nbsp;NGAY!</span></span><span
                                        style="color:#ffff99"><span
                                            style="background-color:#ff99cc">&nbsp;</span></span></em></strong><br />
                            &nbsp;</p>
                    </div>
                    <span class="icon-close-notify anticon anticon-close"></span>
                </div>
            </div>
        </div>

        <div class="card card-body">

            <div class="mb-3">
                <a class="pinned_blog" href="https://vlclone.com/blogs/huongdan/loginbangcookie">
                    <span class="anticon anticon-check-o"></span>
                    <span>Hướng dẫn login bằng Cookie tránh checkpoint!</span>
                </a>
            </div>

            <template v-if="bm_categories.length">
                <div class="table-intro table-intro-bm text-center" data-toggle="collapse" href="#collapseBM">
                    <img src="" alt="" v-bind:src="bm_icon" />
                    Bảng Giá BM
                </div>

                <div class="collapse show" id="collapseBM">
                    <div class="row mb-3">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4" v-for="bm_category in bm_categories"
                            @key="bm_category.id">
                            <div class="bm-item" @click="onShowModalPurchase(bm_category, $event)"
                                v-bind:class="{c_pointer : bm_category.quantity > 0}">
                                <div class="bm-left">
                                    <div class="bm-quantity" v-text="bm_category.quantity"
                                        v-bind:class="{'text-danger': bm_category.quantity == 0}"></div>
                                </div>
                                <div class="bm-center">
                                    <div class="bm-name" v-text="bm_category.name"></div>
                                    <div class="bm-price" v-html="showCategoryPrice(bm_category)"></div>
                                </div>
                                <div class="bm-right">
                                    <div class="view-info">
                                        <span class="icon-info anticon anticon-info-circle"></span>
                                        Thông Tin
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <template v-if="other_types.length" v-for="(type, index) in other_types">
                <div class="table-intro text-center font-size-16" v-bind:style="backgroundByIndex(index)"
                    data-toggle="collapse" :href="'#collapseId' + index">
                    <img src="" alt="" v-bind:src="type.image" />
                    <span v-text="type.name"></span>
                </div>

                <div class="collapse show" :id="'collapseId' + index">
                    <template v-for="parent in type.children">
                        <div class="table-responsive">
                            <table class="table table-bordered table-accounts mb-3">
                                <thead>
                                    <tr data-toggle="collapse" :href="'#collapseParent' + parent . id">
                                        <th style="text-align: center;width: 40px;">#</th>
                                        <th class="col-category-name" v-text="parent.name"></th>
                                        <th class="col-description" v-if="!is_mobile">Mô tả</th>
                                        <th style="text-align: center;width: 70px;">Còn</th>
                                        <th style="width: 100px">Giá</th>
                                        <th style="width: 50px"></th>
                                    </tr>
                                </thead>
                                <tbody class="collapse show" :id="'collapseParent' + parent . id">
                                    <tr v-for="category in parent.children" @click="onShowModalPurchase(category, $event)"
                                        class="font-600" v-bind:class="{c_pointer : category.quantity > 0}">
                                        <td style="text-align: center;width: 70px">
                                            <img src="" v-bind:src="category.image || '/images/countries/vietnam.svg'"
                                                alt="" height="15" />
                                        </td>
                                        <td class="td-category-name">
                                            <span v-text="category.name"></span>
                                            <span class="icon-info anticon anticon-info-circle" v-b-tooltip.hover
                                                title="Xem mô tả"></span>
                                        </td>
                                        <td v-if="!is_mobile" class="col-description">
                                            <div v-text="category.description" class="category-description"
                                                v-b-tooltip.hover v-bind:title="category.description"></div>
                                        </td>
                                        <td style="text-align: center"
                                            v-bind:class="{'text-danger': category.quantity == 0}">
                                            <span class="category-quantity" v-text="formatMoney(category.quantity)"></span>
                                        </td>
                                        <td v-html="showCategoryPrice(category)"></td>
                                        <td style="text-align: center">
                                            <span v-if="category.quantity > 0"
                                                class="category-action anticon anticon-shopping-cart"></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </template>
                </div>
            </template>

            <template v-if="data_empty">
                <h5 class="text-no-data">Chưa có dữ liệu!</h5>
            </template>
        </div>
        <div class="card card-body">
            <div class="mb-3"><a href="https://vlclone.com/blogs/huongdan/loginbangcookie" class="pinned_blog"><span
                        class="anticon anticon-check-o"></span> <span>Hướng dẫn
                        login bằng Cookie tránh checkpoint!</span></a></div>
            <div data-toggle="collapse" href="#collapseBM" class="table-intro table-intro-bm text-center">
                <img src="/images/tags/fb-bm.png" alt="">
                Bảng Giá BM
            </div>
            <div id="collapseBM" class="collapse show">
                <div class="row mb-3">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                        <div class="bm-item">
                            <div class="bm-left">
                                <div class="bm-quantity text-danger">0</div>
                            </div>
                            <div class="bm-center">
                                <div class="bm-name">BM50$ Ngâm</div>
                                <div class="bm-price"><span class="discount-price">10,000₫</span></div>
                            </div>
                            <div class="bm-right">
                                <div class="view-info"><span class="icon-info anticon anticon-info-circle"></span>
                                    Thông Tin
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                        <div class="bm-item">
                            <div class="bm-left">
                                <div class="bm-quantity text-danger">0</div>
                            </div>
                            <div class="bm-center">
                                <div class="bm-name">BM50$ Ngâm có TK</div>
                                <div class="bm-price"><span class="discount-price">12,000₫</span></div>
                            </div>
                            <div class="bm-right">
                                <div class="view-info"><span class="icon-info anticon anticon-info-circle"></span>
                                    Thông Tin
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                        <div class="bm-item c_pointer">
                            <div class="bm-left">
                                <div class="bm-quantity">41</div>
                            </div>
                            <div class="bm-center">
                                <div class="bm-name">BM50$ Cổ 2022</div>
                                <div class="bm-price"><span class="discount-price">40,000₫</span></div>
                            </div>
                            <div class="bm-right">
                                <div class="view-info"><span class="icon-info anticon anticon-info-circle"></span>
                                    Thông Tin
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                        <div class="bm-item c_pointer">
                            <div class="bm-left">
                                <div class="bm-quantity">11</div>
                            </div>
                            <div class="bm-center">
                                <div class="bm-name">BM50$ Ngâm Kháng</div>
                                <div class="bm-price"><span class="discount-price">30,000₫</span></div>
                            </div>
                            <div class="bm-right">
                                <div class="view-info"><span class="icon-info anticon anticon-info-circle"></span>
                                    Thông Tin
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                        <div class="bm-item">
                            <div class="bm-left">
                                <div class="bm-quantity text-danger">0</div>
                            </div>
                            <div class="bm-center">
                                <div class="bm-name">BM50$ Cổ 2022 Kháng</div>
                                <div class="bm-price"><span class="discount-price">70,000₫</span></div>
                            </div>
                            <div class="bm-right">
                                <div class="view-info"><span class="icon-info anticon anticon-info-circle"></span>
                                    Thông Tin
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                        <div class="bm-item">
                            <div class="bm-left">
                                <div class="bm-quantity text-danger">0</div>
                            </div>
                            <div class="bm-center">
                                <div class="bm-name">BM350$ Ngâm</div>
                                <div class="bm-price"><span class="discount-price">20,000₫</span></div>
                            </div>
                            <div class="bm-right">
                                <div class="view-info"><span class="icon-info anticon anticon-info-circle"></span>
                                    Thông Tin
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                        <div class="bm-item">
                            <div class="bm-left">
                                <div class="bm-quantity text-danger">0</div>
                            </div>
                            <div class="bm-center">
                                <div class="bm-name">BM350$ Cổ 2022</div>
                                <div class="bm-price"><span class="discount-price">50,000₫</span></div>
                            </div>
                            <div class="bm-right">
                                <div class="view-info"><span class="icon-info anticon anticon-info-circle"></span>
                                    Thông Tin
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                        <div class="bm-item">
                            <div class="bm-left">
                                <div class="bm-quantity text-danger">0</div>
                            </div>
                            <div class="bm-center">
                                <div class="bm-name">BM350$ Cổ 2022 Kháng</div>
                                <div class="bm-price"><span class="discount-price">130,000₫</span></div>
                            </div>
                            <div class="bm-right">
                                <div class="view-info"><span class="icon-info anticon anticon-info-circle"></span>
                                    Thông Tin
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                        <div class="bm-item">
                            <div class="bm-left">
                                <div class="bm-quantity text-danger">0</div>
                            </div>
                            <div class="bm-center">
                                <div class="bm-name">BM5 Trống 5 Nolimit Tụt 250$ New</div>
                                <div class="bm-price"><span class="discount-price">900,000₫</span></div>
                            </div>
                            <div class="bm-right">
                                <div class="view-info"><span class="icon-info anticon anticon-info-circle"></span>
                                    Thông Tin
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                        <div class="bm-item">
                            <div class="bm-left">
                                <div class="bm-quantity text-danger">0</div>
                            </div>
                            <div class="bm-center">
                                <div class="bm-name">BM5 Trống 5 Nolimit Tụt 250$ 2024 Kháng</div>
                                <div class="bm-price"><span class="discount-price">1,900,000₫</span></div>
                            </div>
                            <div class="bm-right">
                                <div class="view-info"><span class="icon-info anticon anticon-info-circle"></span>
                                    Thông Tin
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                        <div class="bm-item">
                            <div class="bm-left">
                                <div class="bm-quantity text-danger">0</div>
                            </div>
                            <div class="bm-center">
                                <div class="bm-name">BM5 Trống 4 Nolimit Tụt 250$ Cổ 2021</div>
                                <div class="bm-price"><span class="discount-price">1,750,000₫</span></div>
                            </div>
                            <div class="bm-right">
                                <div class="view-info"><span class="icon-info anticon anticon-info-circle"></span>
                                    Thông Tin
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                        <div class="bm-item">
                            <div class="bm-left">
                                <div class="bm-quantity text-danger">0</div>
                            </div>
                            <div class="bm-center">
                                <div class="bm-name">BM5 Trống 4 Nolimit Tụt 250$ Cổ 2021 Kháng</div>
                                <div class="bm-price"><span class="discount-price">2,000,000₫</span></div>
                            </div>
                            <div class="bm-right">
                                <div class="view-info"><span class="icon-info anticon anticon-info-circle"></span>
                                    Thông Tin
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div data-toggle="collapse" href="#collapseId0" class="table-intro text-center font-size-16"
                style="background: linear-gradient(to right, rgb(222, 88, 27), rgb(243, 184, 43));"><img
                    src="/images/tags/facebook.svg" alt=""> <span>Danh sách Via</span></div>
            <div id="collapseId0" class="collapse show">
                <div class="table-responsive">
                    <table class="table table-bordered table-accounts mb-3">
                        <thead>
                            <tr data-toggle="collapse" href="#collapseParent4">
                                <th style="text-align: center; width: 40px;">#</th>
                                <th class="col-category-name">Via Kháng 902 | Chat Support</th>
                                <th class="col-description">Mô tả</th>
                                <th style="text-align: center; width: 70px;">Còn</th>
                                <th style="width: 100px;">Giá</th>
                                <th style="width: 50px;"></th>
                            </tr>
                        </thead>
                        <tbody id="collapseParent4" class="collapse show">
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/ChatSupport.png"
                                        alt="" height="15"></td>
                                <td class="td-category-name"><span>Via Chat Support (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Có thể Chat Support Facebook | Năm tạo: 2008-2024 | Checkpoint Mail"
                                        class="category-description">Có thể Chat Support Facebook | Năm
                                        tạo: 2008-2024 | Checkpoint Mail</div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">508</span></td>
                                <td><span class="discount-price">99,000₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img
                                        src="/images/stores/random-removebg-preview.png" alt="" height="15">
                                </td>
                                <td class="td-category-name"><span>Via Ngoại Cổ XMDT Die Ads</span> <span
                                        title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Green tick: 2 Lines | Tích hiện | Checkpoint Mail | Năm tạo: 2008-2022"
                                        class="category-description">Green tick: 2 Lines | Tích hiện |
                                        Checkpoint Mail | Năm tạo: 2008-2022</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">60,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img
                                        src="/images/stores/random-removebg-preview.png" alt="" height="15">
                                </td>
                                <td class="td-category-name"><span>Via Ngoại Cổ XMDT Limit 50$</span>
                                    <span title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span>
                                </td>
                                <td class="col-description">
                                    <div title="Green tick: 2 Lines | Tích hiện | Checkpoint Mail | Năm tạo: 2008-2022"
                                        class="category-description">Green tick: 2 Lines | Tích hiện |
                                        Checkpoint Mail | Năm tạo: 2008-2022</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">119,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ XMDT Limit 1M2</span> <span
                                        title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Green tick: 2 Lines | Tích hiện | Checkpoint Mail | Năm tạo: 2008-2022"
                                        class="category-description">Green tick: 2 Lines | Tích hiện |
                                        Checkpoint Mail | Năm tạo: 2008-2022</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">149,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Kháng 902 Live Ads</span>
                                    <span title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span>
                                </td>
                                <td class="col-description">
                                    <div title="Green tick: 3 Lines | Tích ẩn | TKCN: Live | Năm tạo: 2008-2022"
                                        class="category-description">Green tick: 3 Lines | Tích ẩn | TKCN:
                                        Live | Năm tạo: 2008-2022</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">189,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/philippines.svg"
                                        alt="" height="15"></td>
                                <td class="td-category-name"><span>Via Philippines Kháng 902 Die Ads</span>
                                    <span title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span>
                                </td>
                                <td class="col-description">
                                    <div title="Green tick: 3 Lines | Tích ẩn | TKCN: Die | Năm tạo: 2008-2022"
                                        class="category-description">Green tick: 3 Lines | Tích ẩn | TKCN:
                                        Die | Năm tạo: 2008-2022</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">99,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/philippines.svg"
                                        alt="" height="15"></td>
                                <td class="td-category-name"><span>Via Philippines Kháng 902 Live
                                        Ads</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Green tick: 3 Lines | Tích ẩn | TKCN: Live | Năm tạo: 2008-2022"
                                        class="category-description">Green tick: 3 Lines | Tích ẩn | TKCN:
                                        Live | Năm tạo: 2008-2022</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">149,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img
                                        src="/images/stores/random-removebg-preview.png" alt="" height="15">
                                </td>
                                <td class="td-category-name"><span>Via Ngoại Cổ Kháng 902 Die Ads</span>
                                    <span title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span>
                                </td>
                                <td class="col-description">
                                    <div title="Green tick: 3 Lines | Tích ẩn | TKCN: Die | Năm tạo: 2008-2022"
                                        class="category-description">Green tick: 3 Lines | Tích ẩn | TKCN:
                                        Die | Năm tạo: 2008-2022</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">59,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img
                                        src="/images/stores/random-removebg-preview.png" alt="" height="15">
                                </td>
                                <td class="td-category-name"><span>Via Ngoại Cổ Kháng 902 Live Ads</span>
                                    <span title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span>
                                </td>
                                <td class="col-description">
                                    <div title="Green tick: 3 Lines | Tích ẩn | TKCN: Live | Năm tạo: 2008-2022"
                                        class="category-description">Green tick: 3 Lines | Tích ẩn | TKCN:
                                        Live | Năm tạo: 2008-2022</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">119,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-accounts mb-3">
                        <thead>
                            <tr data-toggle="collapse" href="#collapseParent7">
                                <th style="text-align: center; width: 40px;">#</th>
                                <th class="col-category-name">TKQC Limit 50$</th>
                                <th class="col-description">Mô tả</th>
                                <th style="text-align: center; width: 70px;">Còn</th>
                                <th style="width: 100px;">Giá</th>
                                <th style="width: 50px;"></th>
                            </tr>
                        </thead>
                        <tbody id="collapseParent7" class="collapse show">
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Limit 2M5 (No2FA)</span> <span
                                        title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Bao đổi quốc gia | Live Ads | Checkpoint Mail"
                                        class="category-description">Bao đổi quốc gia | Live Ads |
                                        Checkpoint Mail</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">55,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/indonesia.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Indonesia Limit 100$ (No2FA)</span>
                                    <span title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span>
                                </td>
                                <td class="col-description">
                                    <div title="Bao đổi tiền, múi giờ, quốc gia | Live Ads | Checkpoint Mail"
                                        class="category-description">Bao đổi tiền, múi giờ, quốc gia |
                                        Live Ads | Checkpoint Mail</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">55,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/philippines.svg"
                                        alt="" height="15"></td>
                                <td class="td-category-name"><span>Via Philippines Limit 100$ (No2FA)</span>
                                    <span title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span>
                                </td>
                                <td class="col-description">
                                    <div title="Bao đổi tiền, múi giờ, quốc gia | Live Ads | Checkpoint Mail"
                                        class="category-description">Bao đổi tiền, múi giờ, quốc gia |
                                        Live Ads | Checkpoint Mail</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">55,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Limit 1M2 Có TKQC Cổ</span>
                                    <span title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span>
                                </td>
                                <td class="col-description">
                                    <div title="Bao đổi quốc gia | Add thẻ lên camp tỉ lệ cao | TKQC Cổ tạo từ 2010-2023"
                                        class="category-description">Bao đổi quốc gia | Add thẻ lên camp
                                        tỉ lệ cao | TKQC Cổ tạo từ 2010-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">89,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img
                                        src="/images/stores/random-removebg-preview.png" alt="" height="15">
                                </td>
                                <td class="td-category-name"><span>Via Ngoại Limit 50$ Có TKQC Cổ Tiền
                                        VNĐ</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Bao đổi quốc gia | Add thẻ lên camp tỉ lệ cao | TKQC Cổ tạo từ 2010-2023"
                                        class="category-description">Bao đổi quốc gia | Add thẻ lên camp
                                        tỉ lệ cao | TKQC Cổ tạo từ 2010-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">69,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img
                                        src="/images/stores/random-removebg-preview.png" alt="" height="15">
                                </td>
                                <td class="td-category-name"><span>Via Ngoại Limit 50$ Có TKQC Cổ</span>
                                    <span title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span>
                                </td>
                                <td class="col-description">
                                    <div title="Bao đổi tiền, múi giờ, quốc gia | Add thẻ lên camp tỉ lệ cao | TKQC Cổ tạo từ 2010-2023"
                                        class="category-description">Bao đổi tiền, múi giờ, quốc gia |
                                        Add thẻ lên camp tỉ lệ cao | TKQC Cổ tạo từ 2010-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">79,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img
                                        src="/images/stores/random-removebg-preview.png" alt="" height="15">
                                </td>
                                <td class="td-category-name"><span>Via Ngoại Limit 50$ Có TKQC Cổ
                                        (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Bao đổi tiền, múi giờ, quốc gia | Add thẻ lên camp tỉ lệ cao | TKQC Cổ tạo từ 2010-2023 | Chưa dính IP Việt"
                                        class="category-description">Bao đổi tiền, múi giờ, quốc gia |
                                        Add thẻ lên camp tỉ lệ cao | TKQC Cổ tạo từ 2010-2023 | Chưa
                                        dính IP Việt</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">79,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img
                                        src="/images/stores/random-removebg-preview.png" alt="" height="15">
                                </td>
                                <td class="td-category-name"><span>Via Ngoại Cổ Có 10 TKQC Limit 50$
                                        (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Bao đổi tiền, múi giờ, quốc gia | Live Ads | Checkpoint Mail | Năm tạo: 2008-2022"
                                        class="category-description">Bao đổi tiền, múi giờ, quốc gia |
                                        Live Ads | Checkpoint Mail | Năm tạo: 2008-2022</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">149,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ Có 10 TKQC Limit
                                        50$</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Bao đổi tiền, múi giờ, quốc gia | Live Ads | Năm tạo: 2008-2022"
                                        class="category-description">Bao đổi tiền, múi giờ, quốc gia |
                                        Live Ads | Năm tạo: 2008-2022</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">149,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img
                                        src="/images/stores/Ads-removebg-preview.png" alt="" height="15">
                                </td>
                                <td class="td-category-name"><span>Full Via Limit 50$ -7 USD đã paid
                                        mồi</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="TKQC đã camp mồi, paid mồi | Đã kháng 273 | Tiền tệ: -7 USD | Quốc gia US | Phù hợp build BM to"
                                        class="category-description">TKQC đã camp mồi, paid mồi | Đã
                                        kháng 273 | Tiền tệ: -7 USD | Quốc gia US | Phù hợp build BM
                                        to</div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">20</span></td>
                                <td><span class="discount-price">250,000₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img
                                        src="/images/stores/Ads-removebg-preview.png" alt="" height="15">
                                </td>
                                <td class="td-category-name"><span>Full Via Limit 50$ +7 USD đã paid
                                        mồi</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="TKQC đã camp mồi, paid mồi | Đã kháng 273 | Tiền tệ: +7 USD | Quốc gia US | Phù hợp build BM to"
                                        class="category-description">TKQC đã camp mồi, paid mồi | Đã
                                        kháng 273 | Tiền tệ: +7 USD | Quốc gia US | Phù hợp build BM
                                        to</div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">18</span></td>
                                <td><span class="discount-price">250,000₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img
                                        src="/images/stores/Ads-removebg-preview.png" alt="" height="15">
                                </td>
                                <td class="td-category-name"><span>Full Via Limit 50$ +7 USD đã paid
                                        mồi</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="TKQC đã camp mồi, paid mồi | Đã kháng 273 | Tiền tệ: +7 USD | Quốc gia PH lách thuế | Phù hợp build BM to"
                                        class="category-description">TKQC đã camp mồi, paid mồi | Đã
                                        kháng 273 | Tiền tệ: +7 USD | Quốc gia PH lách thuế | Phù
                                        hợp build BM to</div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">34</span></td>
                                <td><span class="discount-price">250,000₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-accounts mb-3">
                        <thead>
                            <tr data-toggle="collapse" href="#collapseParent12">
                                <th style="text-align: center; width: 40px;">#</th>
                                <th class="col-category-name">TKQC Limit 250$</th>
                                <th class="col-description">Mô tả</th>
                                <th style="text-align: center; width: 70px;">Còn</th>
                                <th style="width: 100px;">Giá</th>
                                <th style="width: 50px;"></th>
                            </tr>
                        </thead>
                        <tbody id="collapseParent12" class="collapse show">
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Limit 5M8</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Bao đổi quốc gia | Không bao tụt Limit | Checkpoint Mail | Năm tạo: 2010-2022"
                                        class="category-description">Bao đổi quốc gia | Không bao tụt
                                        Limit | Checkpoint Mail | Năm tạo: 2010-2022</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">199,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/flags/european-union.svg"
                                        alt="" height="15"></td>
                                <td class="td-category-name"><span>Via Euro Cổ Limit 300€</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Bao đổi tiền, múi giờ, quốc gia | Không bao tụt Limit | Checkpoint Mail | Chưa dính IP Việt | TKQC Cổ tạo từ 2010-2019"
                                        class="category-description">Bao đổi tiền, múi giờ, quốc gia |
                                        Không bao tụt Limit | Checkpoint Mail | Chưa dính IP Việt | TKQC
                                        Cổ tạo từ 2010-2019</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">300,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img src="/images/flags/european-union.svg"
                                        alt="" height="15"></td>
                                <td class="td-category-name"><span>Via Euro Cổ Limit 300€ Bao Tụt</span>
                                    <span title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span>
                                </td>
                                <td class="col-description">
                                    <div title="Không bao đổi tiền, múi giờ, quốc gia | Bao tụt Limit | Checkpoint Mail | Chưa dính IP Việt | TKQC Cổ tạo từ 2010-2019"
                                        class="category-description">Không bao đổi tiền, múi giờ, quốc
                                        gia | Bao tụt Limit | Checkpoint Mail | Chưa dính IP Việt | TKQC
                                        Cổ tạo từ 2010-2019</div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">1</span></td>
                                <td><span class="discount-price">700,000₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img
                                        src="/images/stores/random-removebg-preview.png" alt="" height="15">
                                </td>
                                <td class="td-category-name"><span>Full Via Limit 250$</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Bao đổi tiền, múi giờ, quốc gia | Bao tụt Limit | TKQC Cổ tạo từ 2010-2023"
                                        class="category-description">Bao đổi tiền, múi giờ, quốc gia |
                                        Bao tụt Limit | TKQC Cổ tạo từ 2010-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">500,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-accounts mb-3">
                        <thead>
                            <tr data-toggle="collapse" href="#collapseParent5">
                                <th style="text-align: center; width: 40px;">#</th>
                                <th class="col-category-name">Via Ngoại Live Ads</th>
                                <th class="col-description">Mô tả</th>
                                <th style="text-align: center; width: 70px;">Còn</th>
                                <th style="width: 100px;">Giá</th>
                                <th style="width: 50px;"></th>
                            </tr>
                        </thead>
                        <tbody id="collapseParent5" class="collapse show">
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img
                                        src="/images/stores/random-removebg-preview.png" alt="" height="15">
                                </td>
                                <td class="td-category-name"><span>Via Ngoại New (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  | Checkpoint Mail | Năm tạo: 2024-2025"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Checkpoint
                                        Mail | Năm tạo: 2024-2025</div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">530</span></td>
                                <td><span class="discount-price">35,000₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img
                                        src="/images/stores/random-removebg-preview.png" alt="" height="15">
                                </td>
                                <td class="td-category-name"><span>Via Ngoại Cổ (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  | Checkpoint Mail | Năm tạo: 2008-2023"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Checkpoint
                                        Mail | Năm tạo: 2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">55,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img
                                        src="/images/stores/random-removebg-preview.png" alt="" height="15">
                                </td>
                                <td class="td-category-name"><span>Via Ngoại Cổ</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  | Năm tạo: 2008-2023"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Năm tạo:
                                        2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">50,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/an-do-india.svg"
                                        alt="" height="15"></td>
                                <td class="td-category-name"><span>Via India New (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  | Checkpoint Mail | Năm tạo: 2024-2025"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Checkpoint
                                        Mail | Năm tạo: 2024-2025</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">40,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/an-do-india.svg"
                                        alt="" height="15"></td>
                                <td class="td-category-name"><span>Via India Cổ (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  | Checkpoint Mail | Chưa dính IP Việt | Năm tạo: 2008-2023"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Checkpoint
                                        Mail | Chưa dính IP Việt | Năm tạo: 2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">60,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/pakistan.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Pakistan New (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  | Checkpoint Mail | Năm tạo: 2024-2025"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Checkpoint
                                        Mail | Năm tạo: 2024-2025</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">40,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/pakistan.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Pakistan Cổ (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  | Checkpoint Mail | Năm tạo: 2008-2023"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Checkpoint
                                        Mail | Năm tạo: 2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">55,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/bangladesh.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Bangladesh New (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  | Checkpoint Mail |  Năm tạo: 2024-2025"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Checkpoint
                                        Mail | Năm tạo: 2024-2025</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">40,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/bangladesh.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Bangladesh Cổ (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  | Checkpoint Mail |  Năm tạo: 2008-2023"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Checkpoint
                                        Mail | Năm tạo: 2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">55,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/indonesia.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Indonesia New (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  | Checkpoint Mail | Năm tạo: 2024-2025"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Checkpoint
                                        Mail | Năm tạo: 2024-2025</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">45,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/indonesia.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Indonesia Cổ (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  | Checkpoint Mail |  Chưa dính IP Việt |  Năm tạo: 2008-2023"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Checkpoint
                                        Mail | Chưa dính IP Việt | Năm tạo: 2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">60,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/philippines.svg"
                                        alt="" height="15"></td>
                                <td class="td-category-name"><span>Via Philippines New (No2FA)</span> <span
                                        title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  | Checkpoint Mail |  Năm tạo: 2024-2025"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Checkpoint
                                        Mail | Năm tạo: 2024-2025</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">45,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/philippines.svg"
                                        alt="" height="15"></td>
                                <td class="td-category-name"><span>Via Philippines Cổ (No2FA)</span> <span
                                        title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  | Checkpoint Mail | Chưa dính IP Việt | Năm tạo: 2008-2023"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Checkpoint
                                        Mail | Chưa dính IP Việt | Năm tạo: 2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">60,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/flags/madagascar.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Madagascar Cổ (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  | Checkpoint Mail |  Năm tạo: 2008-2022"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Checkpoint
                                        Mail | Năm tạo: 2008-2022</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">60,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/flags/turkey.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Turkey Cổ</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS | Chưa dính IP Việt | Năm tạo: 2008-2022"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Chưa dính
                                        IP Việt | Năm tạo: 2008-2022</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">149,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/unitedkingdom.svg"
                                        alt="" height="15"></td>
                                <td class="td-category-name"><span>Via United Kingdom Cổ</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  |  Chưa dính IP Việt |  Năm tạo: 2008-2021"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Chưa dính
                                        IP Việt | Năm tạo: 2008-2021</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">149,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/germany.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Germany Cổ</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  |  Chưa dính IP Việt |  Năm tạo: 2008-2021"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Chưa dính
                                        IP Việt | Năm tạo: 2008-2021</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">149,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/FR.png" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via France Cổ</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  |  Chưa dính IP Việt |  Năm tạo: 2008-2021"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Chưa dính
                                        IP Việt | Năm tạo: 2008-2021</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">149,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/spain.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Spain Cổ</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  |  Chưa dính IP Việt |  Năm tạo: 2008-2021"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Chưa dính
                                        IP Việt | Năm tạo: 2008-2021</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">149,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/italy.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Italia Cổ</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  |  Chưa dính IP Việt |  Năm tạo: 2008-2021"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Chưa dính
                                        IP Việt | Năm tạo: 2008-2021</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">149,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/PL.png" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Poland Cổ</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  |  Chưa dính IP Việt |  Năm tạo: 2008-2021"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Chưa dính
                                        IP Việt | Năm tạo: 2008-2021</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">149,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/flags/norway.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Norway Cổ</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  |  Chưa dính IP Việt |  Năm tạo: 2008-2021"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Chưa dính
                                        IP Việt | Năm tạo: 2008-2021</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">149,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/flags/switzerland.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Switzerland Cổ</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  |  Chưa dính IP Việt |  Năm tạo: 2008-2021"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Chưa dính
                                        IP Việt | Năm tạo: 2008-2021</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">149,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img src="/images/flags/belgium.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Belgium Cổ</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  |  Chưa dính IP Việt |  Năm tạo: 2008-2021"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Chưa dính
                                        IP Việt | Năm tạo: 2008-2021</div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">94</span></td>
                                <td><span class="discount-price">149,000₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/bulgaria.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Bulgaria Cổ</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  |  Chưa dính IP Việt |  Năm tạo: 2008-2021"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Chưa dính
                                        IP Việt | Năm tạo: 2008-2021</div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">89</span></td>
                                <td><span class="discount-price">149,000₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img src="/images/flags/croatia.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Croatia Cổ</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  |  Chưa dính IP Việt |  Năm tạo: 2008-2021"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Chưa dính
                                        IP Việt | Năm tạo: 2008-2021</div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">1</span></td>
                                <td><span class="discount-price">149,000₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/AT.png" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Austria Cổ</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  |  Chưa dính IP Việt |  Năm tạo: 2008-2021"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Chưa dính
                                        IP Việt | Năm tạo: 2008-2021</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">149,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/unitedstates.svg"
                                        alt="" height="15"></td>
                                <td class="td-category-name"><span>Via United States Cổ (No2FA)</span>
                                    <span title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span>
                                </td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  | Checkpoint Mail |  Chưa dính IP Việt |  Năm tạo: 2010-2019"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Checkpoint
                                        Mail | Chưa dính IP Việt | Năm tạo: 2010-2019</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">159,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/unitedstates.svg"
                                        alt="" height="15"></td>
                                <td class="td-category-name"><span>Via United States Siêu Cổ (No2FA)</span>
                                    <span title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span>
                                </td>
                                <td class="col-description">
                                    <div title="Friend: 30-5000 | LIVE ADS  | Checkpoint Mail |  Chưa dính IP Việt |  Năm tạo: 2004-2009"
                                        class="category-description">Friend: 30-5000 | LIVE ADS | Checkpoint
                                        Mail | Chưa dính IP Việt | Năm tạo: 2004-2009</div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">36</span></td>
                                <td><span class="discount-price">250,000₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-accounts mb-3">
                        <thead>
                            <tr data-toggle="collapse" href="#collapseParent11">
                                <th style="text-align: center; width: 40px;">#</th>
                                <th class="col-category-name">Via Ngoại Die Ads</th>
                                <th class="col-description">Mô tả</th>
                                <th style="text-align: center; width: 70px;">Còn</th>
                                <th style="width: 100px;">Giá</th>
                                <th style="width: 50px;"></th>
                            </tr>
                        </thead>
                        <tbody id="collapseParent11" class="collapse show">
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img
                                        src="/images/stores/random-removebg-preview.png" alt="" height="15">
                                </td>
                                <td class="td-category-name"><span>Via Ngoại New DIE ADS (No2FA)</span>
                                    <span title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span>
                                </td>
                                <td class="col-description">
                                    <div title="Thích hợp Seeding | DIE ADS | Friend : 30-5000 | Checkpoint Mail | Năm tạo: 2023-2024"
                                        class="category-description">Thích hợp Seeding | DIE ADS | Friend
                                        : 30-5000 | Checkpoint Mail | Năm tạo: 2023-2024</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">30,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img
                                        src="/images/stores/random-removebg-preview.png" alt="" height="15">
                                </td>
                                <td class="td-category-name"><span>Via Ngoại Cổ DIE ADS (No2FA)</span>
                                    <span title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span>
                                </td>
                                <td class="col-description">
                                    <div title="Thích hợp Seeding | DIE ADS | Friend : 30-5000 | Checkpoint Mail | Năm tạo: 2008-2022"
                                        class="category-description">Thích hợp Seeding | DIE ADS | Friend
                                        : 30-5000 | Checkpoint Mail | Năm tạo: 2008-2022</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">40,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img
                                        src="/images/stores/random-removebg-preview.png" alt="" height="15">
                                </td>
                                <td class="td-category-name"><span>Via Ngoại Cổ DIE ADS</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Thích hợp Seeding | DIE ADS | Friend : 0-5000 | Năm tạo: 2008-2022"
                                        class="category-description">Thích hợp Seeding | DIE ADS | Friend
                                        : 0-5000 | Năm tạo: 2008-2022</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">45,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/philippines.svg"
                                        alt="" height="15"></td>
                                <td class="td-category-name"><span>Via Philippines Cổ DIE ADS</span> <span
                                        title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Thích hợp Seeding | DIE ADS | Friend : 30-5000 | Checkpoint Mail | Năm tạo: 2008-2023"
                                        class="category-description">Thích hợp Seeding | DIE ADS | Friend
                                        : 30-5000 | Checkpoint Mail | Năm tạo: 2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">50,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/thailan.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Thailand Cổ DIE ADS</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Thích hợp Seeding | DIE ADS | Friend : 30-5000 | Năm tạo: 2008-2021"
                                        class="category-description">Thích hợp Seeding | DIE ADS | Friend
                                        : 30-5000 | Năm tạo: 2008-2021</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">50,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/germany.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Germany Cổ DIE ADS</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Thích hợp Seeding, Spy | DIE ADS | Friend : 30-5000 | Năm tạo: 2008-2019"
                                        class="category-description">Thích hợp Seeding, Spy | DIE ADS |
                                        Friend : 30-5000 | Năm tạo: 2008-2019</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">80,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/unitedstates.svg"
                                        alt="" height="15"></td>
                                <td class="td-category-name"><span>Via United States Cổ DIE ADS
                                        (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Thích hợp Seeding, Spy | DIE ADS | Friend : 30-5000 | Checkpoint Mail | Năm tạo: 2008-2019"
                                        class="category-description">Thích hợp Seeding, Spy | DIE ADS |
                                        Friend : 30-5000 | Checkpoint Mail | Năm tạo: 2008-2019</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">99,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-accounts mb-3">
                        <thead>
                            <tr data-toggle="collapse" href="#collapseParent6">
                                <th style="text-align: center; width: 40px;">#</th>
                                <th class="col-category-name">Via Việt Live Ads</th>
                                <th class="col-description">Mô tả</th>
                                <th style="text-align: center; width: 70px;">Còn</th>
                                <th style="width: 100px;">Giá</th>
                                <th style="width: 50px;"></th>
                            </tr>
                        </thead>
                        <tbody id="collapseParent6" class="collapse show">
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt New (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="LIVE ADS | Friend: 30-1000 | Checkpoint Mail | Năm tạo: 2023-2024"
                                        class="category-description">LIVE ADS | Friend: 30-1000 | Checkpoint
                                        Mail | Năm tạo: 2023-2024</div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">47</span></td>
                                <td><span class="discount-price">50,000₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt New</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="LIVE ADS | Friend: 30-1000 | Năm tạo: 2023-2024"
                                        class="category-description">LIVE ADS | Friend: 30-1000 | Năm tạo:
                                        2023-2024</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">45,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt New 1-3K Friend</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="LIVE ADS | Friend: 1000-3000 | Năm tạo: 2023-2024"
                                        class="category-description">LIVE ADS | Friend: 1000-3000 | Năm tạo:
                                        2023-2024</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">55,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="LIVE ADS | Friend: 30-1000 | Checkpoint Mail | Năm tạo: 2008-2022"
                                        class="category-description">LIVE ADS | Friend: 30-1000 | Checkpoint
                                        Mail | Năm tạo: 2008-2022</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">70,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="LIVE ADS | Friend: 30-1000 | Năm tạo: 2008-2023"
                                        class="category-description">LIVE ADS | Friend: 30-1000 | Năm tạo:
                                        2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">70,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ 1-3K Friend</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="LIVE ADS | Friend: 1000-3000 | Năm tạo: 2008-2023"
                                        class="category-description">LIVE ADS | Friend: 1000-3000 | Năm tạo:
                                        2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">90,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ 3-5K Friend</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="LIVE ADS | Friend: 3000-5000 | Năm tạo: 2008-2023"
                                        class="category-description">LIVE ADS | Friend: 3000-5000 | Năm tạo:
                                        2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">140,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ Tuổi 18+ Giới Tính
                                        Nam</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="LIVE ADS | Friend: 30-1000 | Năm tạo: 2008-2023"
                                        class="category-description">LIVE ADS | Friend: 30-1000 | Năm tạo:
                                        2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">80,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ Tuổi 18+ Giới Tính Nam
                                        1-3K Friend</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="LIVE ADS | Friend: 1000-3000 | Năm tạo: 2008-2023"
                                        class="category-description">LIVE ADS | Friend: 1000-3000 | Năm tạo:
                                        2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">100,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ Tuổi 18+ Giới Tính Nam
                                        3-5K Friend</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="LIVE ADS | Friend: 3000-5000 | Năm tạo: 2008-2023"
                                        class="category-description">LIVE ADS | Friend: 3000-5000 | Năm tạo:
                                        2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">145,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ Tuổi 18+ Giới Tính
                                        Nữ</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="LIVE ADS | Friend: 30-1000 | Năm tạo: 2008-2023"
                                        class="category-description">LIVE ADS | Friend: 30-1000 | Năm tạo:
                                        2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">85,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ Tuổi 18+ Giới Tính Nữ
                                        1-3K Friend</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="LIVE ADS | Friend: 1000-3000 | Năm tạo: 2008-2023"
                                        class="category-description">LIVE ADS | Friend: 1000-3000 | Năm tạo:
                                        2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">115,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ Tuổi 18+ Giới Tính Nữ
                                        3-5K Friend</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="LIVE ADS | Friend: 3000-5000 | Năm tạo: 2008-2022"
                                        class="category-description">LIVE ADS | Friend: 3000-5000 | Năm tạo:
                                        2008-2022</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">150,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-accounts mb-3">
                        <thead>
                            <tr data-toggle="collapse" href="#collapseParent13">
                                <th style="text-align: center; width: 40px;">#</th>
                                <th class="col-category-name">Via Việt Die Ads</th>
                                <th class="col-description">Mô tả</th>
                                <th style="text-align: center; width: 70px;">Còn</th>
                                <th style="width: 100px;">Giá</th>
                                <th style="width: 50px;"></th>
                            </tr>
                        </thead>
                        <tbody id="collapseParent13" class="collapse show">
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ DIE ADS (No2FA)</span>
                                    <span title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span>
                                </td>
                                <td class="col-description">
                                    <div title="Thích hợp Seeding | DIE ADS | Friend : 30-5000 | Năm tạo: 2008-2022"
                                        class="category-description">Thích hợp Seeding | DIE ADS | Friend
                                        : 30-5000 | Năm tạo: 2008-2022</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">50,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ DIE ADS</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Thích hợp Seeding | DIE ADS | Friend : 30-1000 | Năm tạo: 2008-2023"
                                        class="category-description">Thích hợp Seeding | DIE ADS | Friend
                                        : 30-1000 | Năm tạo: 2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">45,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ 1-3K Friend DIE ADS</span>
                                    <span title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span>
                                </td>
                                <td class="col-description">
                                    <div title="Thích hợp Seeding | DIE ADS | Friend : 1000-5000 | Năm tạo: 2008-2023"
                                        class="category-description">Thích hợp Seeding | DIE ADS | Friend
                                        : 1000-5000 | Năm tạo: 2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">75,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ 1-3K Friend DIE ADS
                                        (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Thích hợp Seeding | DIE ADS | Friend : 1000-5000 | Checkpoint Mail | Năm tạo: 2008-2023"
                                        class="category-description">Thích hợp Seeding | DIE ADS | Friend
                                        : 1000-5000 | Checkpoint Mail | Năm tạo: 2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">75,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ 1-3K Friend DIE ADS
                                        (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Thích hợp Seeding | DIE ADS | Friend : 1000-5000 | Checkpoint Mail | Năm tạo: 2008-2023"
                                        class="category-description">Thích hợp Seeding | DIE ADS | Friend
                                        : 1000-5000 | Checkpoint Mail | Năm tạo: 2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">75,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ 3-5K Friend DIE ADS</span>
                                    <span title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span>
                                </td>
                                <td class="col-description">
                                    <div title="Thích hợp Seeding | DIE ADS | Friend : 300-5000 | Năm tạo: 2008-2023"
                                        class="category-description">Thích hợp Seeding | DIE ADS | Friend
                                        : 300-5000 | Năm tạo: 2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">130,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ 3-5K Friend DIE ADS
                                        (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Thích hợp Seeding | DIE ADS | Friend : 300-5000 | Checkpoint Mail | Năm tạo: 2008-2023"
                                        class="category-description">Thích hợp Seeding | DIE ADS | Friend
                                        : 300-5000 | Checkpoint Mail | Năm tạo: 2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">130,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ Tuổi 18+ DIE ADS</span>
                                    <span title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span>
                                </td>
                                <td class="col-description">
                                    <div title="Thích hợp Seeding | DIE ADS | Friend : 30-5000 | Năm tạo: 2008-2023"
                                        class="category-description">Thích hợp Seeding | DIE ADS | Friend
                                        : 30-5000 | Năm tạo: 2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">60,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ Tuổi 18+ Giới Tính Nữ
                                        1-3K Friend DIE ADS</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Thích hợp Seeding | DIE ADS | Friend : 1000-5000 | Năm tạo: 2008-2023"
                                        class="category-description">Thích hợp Seeding | DIE ADS | Friend
                                        : 1000-5000 | Năm tạo: 2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">85,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Via Việt Cổ Tuổi 18+ Giới Tính Nữ
                                        3-5K Friend DIE ADS</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Thích hợp Seeding | DIE ADS | Friend : 3000-5000 | Năm tạo: 2008-2023"
                                        class="category-description">Thích hợp Seeding | DIE ADS | Friend
                                        : 3000-5000 | Năm tạo: 2008-2023</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">130,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div data-toggle="collapse" href="#collapseId1" class="table-intro text-center font-size-16"
                style="background: linear-gradient(to right, rgb(119, 32, 97), rgb(192, 58, 79));"><img
                    src="/images/tags/facebook.svg" alt=""> <span>Danh sách Clone</span></div>
            <div id="collapseId1" class="collapse show">
                <div class="table-responsive">
                    <table class="table table-bordered table-accounts mb-3">
                        <thead>
                            <tr data-toggle="collapse" href="#collapseParent8">
                                <th style="text-align: center; width: 40px;">#</th>
                                <th class="col-category-name">Clone Global</th>
                                <th class="col-description">Mô tả</th>
                                <th style="text-align: center; width: 70px;">Còn</th>
                                <th style="width: 100px;">Giá</th>
                                <th style="width: 50px;"></th>
                            </tr>
                        </thead>
                        <tbody id="collapseParent8" class="collapse show">
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img
                                        src="/images/stores/random-removebg-preview.png" alt="" height="15">
                                </td>
                                <td class="td-category-name"><span>Clone Ngoại Random Live 30P-1H (Up API
                                        24/24)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Trắng | Reg &amp; Verify Android | Hàng up API liên tục | Very Gmail"
                                        class="category-description">Trắng | Reg &amp; Verify Android |
                                        Hàng up API liên tục | Very Gmail</div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">103</span></td>
                                <td><span class="discount-price">1,800₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/germany.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Clone Germany (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Reg &amp; Verify Android | Created: > 5 day | Created Ads: > 5 day | Very Fviainboxes"
                                        class="category-description">Reg &amp; Verify Android | Created:
                                        &gt; 5 day | Created Ads: &gt; 5 day | Very Fviainboxes</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">3,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/mexico.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Clone Mexico (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Reg &amp; Verify Android | Created: > 6 day | Created Ads: > 6 day | Very Fviainboxes"
                                        class="category-description">Reg &amp; Verify Android | Created:
                                        &gt; 6 day | Created Ads: &gt; 6 day | Very Fviainboxes</div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">704</span></td>
                                <td><span class="discount-price">3,000₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/CA.jpg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Clone Canada (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Reg &amp; Verify Android | Created: > 6 day | Created Ads: > 6 day | Very Fviainboxes"
                                        class="category-description">Reg &amp; Verify Android | Created:
                                        &gt; 6 day | Created Ads: &gt; 6 day | Very Fviainboxes</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">3,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/unitedstates.svg"
                                        alt="" height="15"></td>
                                <td class="td-category-name"><span>Clone United States (No2FA)</span> <span
                                        title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Reg &amp; Verify Android | Created: > 6 day | Created Ads: > 6 day | Very Fviainboxes"
                                        class="category-description">Reg &amp; Verify Android | Created:
                                        &gt; 6 day | Created Ads: &gt; 6 day | Very Fviainboxes</div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">314</span></td>
                                <td><span class="discount-price">3,000₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/unitedstates.svg"
                                        alt="" height="15"></td>
                                <td class="td-category-name"><span>Clone United States</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Reg &amp; Verify Android | Created: > 8 day | Created Ads: > 8 day | Very Fviainboxes | Đã bật 2FA"
                                        class="category-description">Reg &amp; Verify Android | Created:
                                        &gt; 8 day | Created Ads: &gt; 8 day | Very Fviainboxes | Đã bật 2FA
                                    </div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">1,304</span></td>
                                <td><span class="discount-price">5,000₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-accounts mb-3">
                        <thead>
                            <tr data-toggle="collapse" href="#collapseParent9">
                                <th style="text-align: center; width: 40px;">#</th>
                                <th class="col-category-name">Clone Việt Nam</th>
                                <th class="col-description">Mô tả</th>
                                <th style="text-align: center; width: 70px;">Còn</th>
                                <th style="width: 100px;">Giá</th>
                                <th style="width: 50px;"></th>
                            </tr>
                        </thead>
                        <tbody id="collapseParent9" class="collapse show">
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Clone Việt Nam Verify Gmail
                                        (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Có Avatar + Cover + Info | Ngày tạo: > 3 ngày | Chưa bật 2FA | Very Gmail"
                                        class="category-description">Có Avatar + Cover + Info | Ngày tạo:
                                        &gt; 3 ngày | Chưa bật 2FA | Very Gmail</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">3,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Clone Việt Nam Verify Fvia
                                        (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Có Avatar + Cover + Info | Ngày tạo: > 6 ngày | Chưa bật 2FA | Very Fviainboxes + Gmail"
                                        class="category-description">Có Avatar + Cover + Info | Ngày tạo:
                                        &gt; 6 ngày | Chưa bật 2FA | Very Fviainboxes + Gmail</div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">2,517</span></td>
                                <td><span class="discount-price">4,000₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Clone Việt Nam Verify Fvia</span> <span
                                        title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Có Avatar + Cover + Info | Ngày tạo: > 7 ngày | Đã bật 2FA | Very Fviainboxes + Gmail"
                                        class="category-description">Có Avatar + Cover + Info | Ngày tạo:
                                        &gt; 7 ngày | Đã bật 2FA | Very Fviainboxes + Gmail</div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">4,887</span></td>
                                <td><span class="discount-price">5,000₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Clone Việt Nam Trên 50 Friend
                                        (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: > 50 | Có Avatar + Cover | Ngày tạo: > 1 tháng | Checkpoint Mail | Chưa Bật 2FA"
                                        class="category-description">Friend: &gt; 50 | Có Avatar + Cover |
                                        Ngày tạo: &gt; 1 tháng | Checkpoint Mail | Chưa Bật 2FA</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">7,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Clone Việt Nam Trên 100 Friend
                                        (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: > 100 | Có Avatar + Cover | Ngày tạo: > 1 tháng | Checkpoint Mail | Chưa Bật 2FA"
                                        class="category-description">Friend: &gt; 100 | Có Avatar + Cover |
                                        Ngày tạo: &gt; 1 tháng | Checkpoint Mail | Chưa Bật 2FA</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">8,500₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/stores/vietnamese.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Clone Việt Nam Trên 200 Friend
                                        (No2FA)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Friend: > 200 | Có Avatar + Cover | Ngày tạo: > 1 tháng | Checkpoint Mail | Chưa Bật 2FA"
                                        class="category-description">Friend: &gt; 200 | Có Avatar + Cover |
                                        Ngày tạo: &gt; 1 tháng | Checkpoint Mail | Chưa Bật 2FA</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">12,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div data-toggle="collapse" href="#collapseId2" class="table-intro text-center font-size-16"
                style="background: linear-gradient(to right, rgb(217, 46, 0), rgb(255, 69, 0));"><img
                    src="/images/tags/instagram.svg" alt=""> <span>Danh sách Instagram</span></div>
            <div id="collapseId2" class="collapse show">
                <div class="table-responsive">
                    <table class="table table-bordered table-accounts mb-3">
                        <thead>
                            <tr data-toggle="collapse" href="#collapseParent16">
                                <th style="text-align: center; width: 40px;">#</th>
                                <th class="col-category-name">Clone Instagram</th>
                                <th class="col-description">Mô tả</th>
                                <th style="text-align: center; width: 70px;">Còn</th>
                                <th style="width: 100px;">Giá</th>
                                <th style="width: 50px;"></th>
                            </tr>
                        </thead>
                        <tbody id="collapseParent16" class="collapse show">
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/tags/instagram.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Clone Instagram Việt</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Reg Android | Very Phone | Có Cookie | Đã Bật 2FA | Reg IP VN Name VN | Ngày tạo: > 3 ngày"
                                        class="category-description">Reg Android | Very Phone | Có Cookie |
                                        Đã Bật 2FA | Reg IP VN Name VN | Ngày tạo: &gt; 3 ngày</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">3,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img src="/images/tags/instagram.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Clone Instagram US</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Reg Android | Very Phone | Có Cookie | Đã Bật 2FA | Reg IP US Name US | Ngày tạo: > 10 ngày"
                                        class="category-description">Reg Android | Very Phone | Có Cookie |
                                        Đã Bật 2FA | Reg IP US Name US | Ngày tạo: &gt; 10 ngày</div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">6,585</span></td>
                                <td><span class="discount-price">3,000₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img src="/images/tags/instagram.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Clone Instagram US Ngâm 1 Tháng</span>
                                    <span title="Xem mô tả" class="icon-info anticon anticon-info-circle"></span>
                                </td>
                                <td class="col-description">
                                    <div title="Reg Android | Very Phone | Có Cookie | Đã Bật 2FA | Phù hợp spam, fishing..."
                                        class="category-description">Reg Android | Very Phone | Có Cookie |
                                        Đã Bật 2FA | Phù hợp spam, fishing...</div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">2,076</span></td>
                                <td><span class="discount-price">4,000₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div data-toggle="collapse" href="#collapseId3" class="table-intro text-center font-size-16"
                style="background: linear-gradient(to right, rgb(176, 48, 96), rgb(255, 102, 153));"><img
                    src="/images/tags/outlook.svg" alt=""> <span>Danh sách Hotmail</span></div>
            <div id="collapseId3" class="collapse show">
                <div class="table-responsive">
                    <table class="table table-bordered table-accounts mb-3">
                        <thead>
                            <tr data-toggle="collapse" href="#collapseParent10">
                                <th style="text-align: center; width: 40px;">#</th>
                                <th class="col-category-name">Hotmail Live V.V</th>
                                <th class="col-description">Mô tả</th>
                                <th style="text-align: center; width: 70px;">Còn</th>
                                <th style="width: 100px;">Giá</th>
                                <th style="width: 50px;"></th>
                            </tr>
                        </thead>
                        <tbody id="collapseParent10" class="collapse show">
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img src="/images/tags/outlook.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Hotmail Trusted Live for 6-12
                                        months</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Đã bật FULL POP3 + IMAP + Oauth2 | Không cần very SĐT | Recommend to use Oauth2 for access"
                                        class="category-description">Đã bật FULL POP3 + IMAP + Oauth2 |
                                        Không cần very SĐT | Recommend to use Oauth2 for access</div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">24,792</span></td>
                                <td><span class="discount-price">300₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img src="/images/tags/outlook.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Outlook Trusted Live for 6-12
                                        months</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Đã bật FULL POP3 + IMAP + Oauth2 | Không cần very SĐT | Recommend to use Oauth2 for access"
                                        class="category-description">Đã bật FULL POP3 + IMAP + Oauth2 |
                                        Không cần very SĐT | Recommend to use Oauth2 for access</div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">19,867</span></td>
                                <td><span class="discount-price">300₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/tags/outlook.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Hotmail Live Vĩnh Viễn</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Đã Verify Phone | Mail khôi khục Fviainboxes.com | Đã bật POP3 + IMAP | Recommend to use IMAP for access"
                                        class="category-description">Đã Verify Phone | Mail khôi khục
                                        Fviainboxes.com | Đã bật POP3 + IMAP | Recommend to use IMAP for
                                        access</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">1,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/tags/outlook.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Outlook Live Vĩnh Viễn</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Đã Verify Phone | Mail khôi khục Fviainboxes.com | Đã bật POP3 + IMAP | Recommend to use IMAP for access"
                                        class="category-description">Đã Verify Phone | Mail khôi khục
                                        Fviainboxes.com | Đã bật POP3 + IMAP | Recommend to use IMAP for
                                        access</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">1,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div data-toggle="collapse" href="#collapseId4" class="table-intro text-center font-size-16"
                style="background: linear-gradient(to right, rgb(255, 111, 0), rgb(255, 211, 0));"><img
                    src="/images/tags/gmail.svg" alt=""> <span>Danh sách Gmail</span></div>
            <div id="collapseId4" class="collapse show">
                <div class="table-responsive">
                    <table class="table table-bordered table-accounts mb-3">
                        <thead>
                            <tr data-toggle="collapse" href="#collapseParent14">
                                <th style="text-align: center; width: 40px;">#</th>
                                <th class="col-category-name">Gmail Việt</th>
                                <th class="col-description">Mô tả</th>
                                <th style="text-align: center; width: 70px;">Còn</th>
                                <th style="width: 100px;">Giá</th>
                                <th style="width: 50px;"></th>
                            </tr>
                        </thead>
                        <tbody id="collapseParent14" class="collapse show">
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/tags/gmail.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Gmail Việt New Reg Phone</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Chưa qua bất cứ dịch vụ nào | Không dính phone ẩn | Kèm mail khôi phục | Ngày tạo: > 6 ngày"
                                        class="category-description">Chưa qua bất cứ dịch vụ nào |
                                        Không dính phone ẩn | Kèm mail khôi phục | Ngày tạo: &gt; 6
                                        ngày</div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">7,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/tags/gmail.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Gmail Việt Cổ 2023 (Info US IP
                                        VN)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Chưa qua bất cứ dịch vụ nào | Không dính phone ẩn | Kèm mail khôi phục | Ngày tạo: 2023"
                                        class="category-description">Chưa qua bất cứ dịch vụ nào |
                                        Không dính phone ẩn | Kèm mail khôi phục | Ngày tạo: 2023
                                    </div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">20,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600">
                                <td style="text-align: center; width: 70px;"><img src="/images/tags/gmail.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Gmail Việt Cổ 2022 (Info US IP
                                        VN)</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Chưa qua bất cứ dịch vụ nào | Không dính phone ẩn | Kèm mail khôi phục | Ngày tạo: 2022"
                                        class="category-description">Chưa qua bất cứ dịch vụ nào |
                                        Không dính phone ẩn | Kèm mail khôi phục | Ngày tạo: 2022
                                    </div>
                                </td>
                                <td class="text-danger" style="text-align: center;"><span class="category-quantity">0</span>
                                </td>
                                <td><span class="discount-price">25,000₫</span></td>
                                <td style="text-align: center;"><!----></td>
                            </tr>
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img src="/images/tags/gmail.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Gmail Việt Cổ 2017-2019</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Chưa qua bất cứ dịch vụ nào | Không dính phone ẩn | Kèm mail khôi phục | Ngày tạo: 2017-2019"
                                        class="category-description">Chưa qua bất cứ dịch vụ nào |
                                        Không dính phone ẩn | Kèm mail khôi phục | Ngày tạo: 2017-2019
                                    </div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">33</span></td>
                                <td><span class="discount-price">40,000₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-accounts mb-3">
                        <thead>
                            <tr data-toggle="collapse" href="#collapseParent15">
                                <th style="text-align: center; width: 40px;">#</th>
                                <th class="col-category-name">Gmail US</th>
                                <th class="col-description">Mô tả</th>
                                <th style="text-align: center; width: 70px;">Còn</th>
                                <th style="width: 100px;">Giá</th>
                                <th style="width: 50px;"></th>
                            </tr>
                        </thead>
                        <tbody id="collapseParent15" class="collapse show">
                            <tr class="font-600 c_pointer">
                                <td style="text-align: center; width: 70px;"><img src="/images/tags/gmail.svg" alt=""
                                        height="15"></td>
                                <td class="td-category-name"><span>Gmail US Cổ 2023 Bất Tử</span> <span title="Xem mô tả"
                                        class="icon-info anticon anticon-info-circle"></span></td>
                                <td class="col-description">
                                    <div title="Có tương tác với google siêu trust | Không dính phone ẩn | Kèm mail khôi phục | Đã bật 2FA | Ngày tạo: 2023"
                                        class="category-description">Có tương tác với google siêu trust |
                                        Không dính phone ẩn | Kèm mail khôi phục | Đã bật 2FA | Ngày
                                        tạo: 2023</div>
                                </td>
                                <td class="" style="text-align: center;"><span class="category-quantity">81</span></td>
                                <td><span class="discount-price">25,000₫</span></td>
                                <td style="text-align: center;"><span
                                        class="category-action anticon anticon-shopping-cart"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> <!---->
        </div>
        <div class="row area-history">
            <div class="col-sm-12 col-lg-6">
                <div class="card">
                    <div class="card-header info-card-header">
                        Mua Hàng Gần Đây
                    </div>
                    <div class="card-body">
                        <div class="history-item">
                            <b>
                                <span style="color: green;"> <i class="fa fa-bell"></i>
                                    ave12****
                                </span>:
                                <span style="color: red; ">Đã mua 1 Clone Việt Nam Verify Fvia -
                                    5,000VND</span>
                            </b>
                            <span class="right">
                                <span class="badge badge-primary">
                                    <em>4 seconds ago</em>
                                </span>
                            </span>
                        </div>
                        <div class="history-item">
                            <b>
                                <span style="color: green;"> <i class="fa fa-bell"></i>
                                    manhcuo****
                                </span>:
                                <span style="color: red; ">Đã mua 1 Clone Ngoại Random Live 30P-1H (Up API
                                    24/24) - 1,800VND</span>
                            </b>
                            <span class="right">
                                <span class="badge badge-primary">
                                    <em>11 seconds ago</em>
                                </span>
                            </span>
                        </div>
                        <div class="history-item">
                            <b>
                                <span style="color: green;"> <i class="fa fa-bell"></i>
                                    Long081826****
                                </span>:
                                <span style="color: red; ">Đã mua 25 Clone Ngoại Random Live 30P-1H (Up API
                                    24/24) - 40,500VND</span>
                            </b>
                            <span class="right">
                                <span class="badge badge-primary">
                                    <em>15 minutes ago</em>
                                </span>
                            </span>
                        </div>
                        <div class="history-item">
                            <b>
                                <span style="color: green;"> <i class="fa fa-bell"></i>
                                    procy****
                                </span>:
                                <span style="color: red; ">Đã mua 1 Via United States Siêu Cổ (No2FA) [CP:
                                    1] - 250,000VND</span>
                            </b>
                            <span class="right">
                                <span class="badge badge-primary">
                                    <em>26 minutes ago</em>
                                </span>
                            </span>
                        </div>
                        <div class="history-item">
                            <b>
                                <span style="color: green;"> <i class="fa fa-bell"></i>
                                    ngov****
                                </span>:
                                <span style="color: red; ">Đã mua 1 Via Chat Support (No2FA) -
                                    89,100VND</span>
                            </b>
                            <span class="right">
                                <span class="badge badge-primary">
                                    <em>32 minutes ago</em>
                                </span>
                            </span>
                        </div>
                        <div class="history-item">
                            <b>
                                <span style="color: green;"> <i class="fa fa-bell"></i>
                                    vinhso****
                                </span>:
                                <span style="color: red; ">Đã mua 1 Clone Instagram US - 2,700VND</span>
                            </b>
                            <span class="right">
                                <span class="badge badge-primary">
                                    <em>36 minutes ago</em>
                                </span>
                            </span>
                        </div>
                        <div class="history-item">
                            <b>
                                <span style="color: green;"> <i class="fa fa-bell"></i>
                                    vinhso****
                                </span>:
                                <span style="color: red; ">Đã mua 1 Clone Instagram US - 2,700VND</span>
                            </b>
                            <span class="right">
                                <span class="badge badge-primary">
                                    <em>44 minutes ago</em>
                                </span>
                            </span>
                        </div>
                        <div class="history-item">
                            <b>
                                <span style="color: green;"> <i class="fa fa-bell"></i>
                                    Long081826****
                                </span>:
                                <span style="color: red; ">Đã mua 1 Clone Việt Nam Verify Fvia (No2FA) -
                                    3,600VND</span>
                            </b>
                            <span class="right">
                                <span class="badge badge-primary">
                                    <em>48 minutes ago</em>
                                </span>
                            </span>
                        </div>
                        <div class="history-item">
                            <b>
                                <span style="color: green;"> <i class="fa fa-bell"></i>
                                    ca****
                                </span>:
                                <span style="color: red; ">Đã mua 5 Clone Instagram US - 13,500VND</span>
                            </b>
                            <span class="right">
                                <span class="badge badge-primary">
                                    <em>53 minutes ago</em>
                                </span>
                            </span>
                        </div>
                        <div class="history-item">
                            <b>
                                <span style="color: green;"> <i class="fa fa-bell"></i>
                                    Long081826****
                                </span>:
                                <span style="color: red; ">Đã mua 1 Clone Mexico (No2FA) - 2,700VND</span>
                            </b>
                            <span class="right">
                                <span class="badge badge-primary">
                                    <em>55 minutes ago</em>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="card">
                    <div class="card-header info-card-header">
                        Nạp Tiền Gần Đây
                    </div>
                    <div class="card-body">
                        <div class="history-item">
                            <b>
                                <span style="color: green;"> <i class="fa fa-bell"></i>
                                    procy****
                                </span>:
                                <span style="color: red; ">Đã nạp 60,000 VND - Nạp tiền từ ACB</span>
                            </b>
                            <span class="right">
                                <span class="badge badge-primary">
                                    <em>26 minutes ago</em>
                                </span>
                            </span>
                        </div>
                        <div class="history-item">
                            <b>
                                <span style="color: green;"> <i class="fa fa-bell"></i>
                                    vumjhtan****
                                </span>:
                                <span style="color: red; ">Đã nạp 250,000 VND - Nạp tiền từ ACB</span>
                            </b>
                            <span class="right">
                                <span class="badge badge-primary">
                                    <em>31 minutes ago</em>
                                </span>
                            </span>
                        </div>
                        <div class="history-item">
                            <b>
                                <span style="color: green;"> <i class="fa fa-bell"></i>
                                    phong****
                                </span>:
                                <span style="color: red; ">Đã nạp 20,000 VND - Nạp tiền từ ACB</span>
                            </b>
                            <span class="right">
                                <span class="badge badge-primary">
                                    <em>4 hours ago</em>
                                </span>
                            </span>
                        </div>
                        <div class="history-item">
                            <b>
                                <span style="color: green;"> <i class="fa fa-bell"></i>
                                    truo****
                                </span>:
                                <span style="color: red; ">Đã nạp 70,000 VND - Nạp tiền từ ACB</span>
                            </b>
                            <span class="right">
                                <span class="badge badge-primary">
                                    <em>4 hours ago</em>
                                </span>
                            </span>
                        </div>
                        <div class="history-item">
                            <b>
                                <span style="color: green;"> <i class="fa fa-bell"></i>
                                    pha****
                                </span>:
                                <span style="color: red; ">Đã nạp 175,000 VND - Nạp tiền từ ACB</span>
                            </b>
                            <span class="right">
                                <span class="badge badge-primary">
                                    <em>5 hours ago</em>
                                </span>
                            </span>
                        </div>
                        <div class="history-item">
                            <b>
                                <span style="color: green;"> <i class="fa fa-bell"></i>
                                    long7****
                                </span>:
                                <span style="color: red; ">Đã nạp 99,000 VND - Nạp tiền từ ACB</span>
                            </b>
                            <span class="right">
                                <span class="badge badge-primary">
                                    <em>5 hours ago</em>
                                </span>
                            </span>
                        </div>
                        <div class="history-item">
                            <b>
                                <span style="color: green;"> <i class="fa fa-bell"></i>
                                    lam199****
                                </span>:
                                <span style="color: red; ">Đã nạp 50,000 VND - Nạp tiền từ ACB</span>
                            </b>
                            <span class="right">
                                <span class="badge badge-primary">
                                    <em>14 hours ago</em>
                                </span>
                            </span>
                        </div>
                        <div class="history-item">
                            <b>
                                <span style="color: green;"> <i class="fa fa-bell"></i>
                                    vinh****
                                </span>:
                                <span style="color: red; ">Đã nạp 100,000 VND - Nạp tiền từ ACB</span>
                            </b>
                            <span class="right">
                                <span class="badge badge-primary">
                                    <em>16 hours ago</em>
                                </span>
                            </span>
                        </div>
                        <div class="history-item">
                            <b>
                                <span style="color: green;"> <i class="fa fa-bell"></i>
                                    Thuy****
                                </span>:
                                <span style="color: red; ">Đã nạp 100,000 VND - Nạp tiền từ ACB</span>
                            </b>
                            <span class="right">
                                <span class="badge badge-primary">
                                    <em>17 hours ago</em>
                                </span>
                            </span>
                        </div>
                        <div class="history-item">
                            <b>
                                <span style="color: green;"> <i class="fa fa-bell"></i>
                                    huongthu5195gmai****
                                </span>:
                                <span style="color: red; ">Đã nạp 120,000 VND - Nạp tiền từ ACB</span>
                            </b>
                            <span class="right">
                                <span class="badge badge-primary">
                                    <em>17 hours ago</em>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="modalPurchase" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content" v-if="category">
                    <div class="modal-header">
                        <h4 class="modal-title" v-text="category.name"></h4>
                        <button class="close" data-dismiss="modal" type="button">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="font-600" style="color: rgb(63, 135, 245);">Mô tả:</div>
                                    <div class="font-600 category-content mb-2"
                                        v-text="formatTextContent(category.description)"></div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="font-600" style="color: rgb(136, 108, 255);">Lưu ý:</div>
                                    <div class="font-600 category-content" v-text="category.warranty"></div>
                                </div>
                            </div>

                            <p class="font-600 m-b-5">Xuất: <span v-text="getExportFormats()"></span></p>

                            <div>
                                <label style="color: tomato;">THÔNG TIN ĐƠN HÀNG</label>
                            </div>

                            <span class="row-acc">
                                <span class="m-r-20 text-left font-600">Số lượng Mua: </span>
                            </span>
                            <div class="row">
                                <div class="col-7">
                                    <input class="form-control" placeholder="Số Lượng Mua" type="number" v-model="quantity"
                                        v-bind:min="category.min_purchase || 0" v-bind:max="category.quantity">
                                </div>

                                <div class="col-5 text-center">
                                    <span class="via_quantity mgr-10 m-t-10"
                                        v-bind:class="{[category.quantity > 4 ? 'number_good' : 'number_out_of_stock']: true}">
                                        <span class="font-600">Còn</span>
                                        <span class="bold m-l-5" v-text="category.quantity"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="m-t-10" style="font-size: 18px;">
                                <span class="font-600">Tiền: </span>
                                <span v-text="formatMoney(quantity)"></span>
                                <span>x</span>
                                <span v-text="formatMoney(category.discount_price)"></span>
                                =
                                <span v-text="formatMoney(category.discount_price* quantity)"> đ</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-tone btn-primary" @click="onPurchase()"><i
                                class="anticon anticon-shopping-cart"></i> MUA NGAY
                        </button>
                        <button class="btn btn-default" data-dismiss="modal"><i class="anticon anticon-close"></i> ĐÓNG
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <div id="modalInfo" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content" v-if="category">
                    <div class="modal-header">
                        <h4 class="modal-title" v-text="category.name"></h4>
                        <button class="close" data-dismiss="modal" type="button">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="font-600" style="color: rgb(63, 135, 245);">Mô tả:</div>
                                    <div class="font-600 category-content mb-2"
                                        v-text="formatTextContent(category.description)"></div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="font-600" style="color: rgb(136, 108, 255);">Lưu ý:</div>
                                    <div class="font-600 category-content" v-text="category.warranty"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal"><i class="anticon anticon-close"></i> ĐÓNG
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
