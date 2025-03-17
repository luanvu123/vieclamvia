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
@foreach ($categories as $index => $category)
    <div data-toggle="collapse" href="#collapse{{ $category->id }}" class="table-intro text-center font-size-16"
         style="background: {{ $gradients[$index % count($gradients)] }};">
        @if($category->icon)
            <img src="{{ $category->icon }}" alt="">
        @else
            <img src="/images/tags/instagram.svg" alt="">
        @endif
        <span>{{ $category->name }}</span>
    </div>

    <div id="collapse{{ $category->id }}" class="collapse show">
        @foreach($category->subcategories as $subcategory)
            <div class="table-responsive mt-3">

                <table class="table table-bordered table-accounts mb-3">
                    <thead>
                        <tr>
                            <th>{{ $subcategory->name }}</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Mô Tả</th>
                            <th>Còn</th>
                            <th>Giá</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subcategory->products as $product)
                            <tr class="{{ $product->quantity > 0 ? 'c_pointer' : '' }}">
                                <td>
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="" height="15">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->short_description ?? 'Không có mô tả' }}</td>
                                <td class="{{ $product->quantity <= 0 ? 'text-danger' : '' }}">
                                    {{ $product->quantity }}
                                </td>
                                <td>{{ number_format($product->price, 0) }}₫</td>
                                <td>
                                    @if($product->quantity > 0)
                                        <span class="category-action anticon anticon-shopping-cart"></span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
@endforeach






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
