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
                                            <!-- Trong vòng lặp hiển thị sản phẩm -->
                                            <td>
                                                @if($product->quantity > 0)
                                                    <span class="category-action anticon anticon-shopping-cart" data-toggle="modal"
                                                        data-target="#modalPurchase" data-product-id="{{ $product->id }}"
                                                        data-product-name="{{ $product->name }}"
                                                        data-product-description="{!! $product->description !!}"
                                                        data-product-quantity="{{ $product->quantity }}"
                                                        data-product-price="{{ $product->price }}"></span>
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
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="productName"></h4>
                        <button class="close" data-dismiss="modal" type="button">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="font-600"></div>
                                    <div id="productDescription"></div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="font-600">Còn:</div>
                                    <div id="productQuantity"></div>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label for="quantityInput">Số lượng mua:</label>
                                <input type="number" id="quantityInput" class="form-control" min="1" value="1">
                            </div>

                            <div class="mt-3">
                                <div class="font-600">Giá:</div>
                                <div id="productPrice"></div>
                            </div>
                            <div class="mt-3">
                                <div class="font-600">Tổng tiền:</div>
                                <div id="totalPrice"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary"><i class="anticon anticon-shopping-cart"></i> MUA NGAY</button>
                        <button class="btn btn-default" data-dismiss="modal"><i class="anticon anticon-close"></i>
                            ĐÓNG</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let currentProductPrice = 0;

                // Hàm cập nhật tổng tiền
                function updateTotalPrice() {
                    const quantity = parseInt(document.getElementById('quantityInput').value) || 1;
                    const totalPrice = currentProductPrice * quantity;

                    document.getElementById('totalPrice').innerText = new Intl.NumberFormat().format(totalPrice) + '₫';
                }
                // Khi nhấn vào giỏ hàng
                document.querySelectorAll('.category-action').forEach(item => {
                    item.addEventListener('click', function () {
                        const productId = this.getAttribute('data-product-id');
                        const productName = this.getAttribute('data-product-name');
                        const productDescription = this.getAttribute('data-product-description');
                        const productQuantity = this.getAttribute('data-product-quantity');
                        const productPrice = this.getAttribute('data-product-price');
                        currentProductPrice = productPrice;
                        // Cập nhật dữ liệu trong modal
                        document.getElementById('productName').innerText = productName;
                        document.getElementById('productDescription').innerHTML = productDescription;
                        document.getElementById('productQuantity').innerText = productQuantity;
                        document.getElementById('productPrice').innerText = new Intl.NumberFormat().format(productPrice) + '₫';


                        // Cập nhật giá trị tối đa cho input số lượng
                        document.getElementById('quantityInput').setAttribute('max', productQuantity);
                        updateTotalPrice();
                    });
                });
                document.getElementById('quantityInput').addEventListener('input', updateTotalPrice);
                document.querySelector('.btn-primary').addEventListener('click', function () {
                    const quantity = document.getElementById('quantityInput').value;
                    const productId = document.querySelector('.category-action').getAttribute('data-product-id');

                    fetch('/order/store', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: quantity
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.success);
                                location.reload();
                            } else if (data.error) {
                                alert(data.error);
                            }
                        })
                        .catch(error => console.error('Lỗi:', error));
                });

            });
        </script>
    </div>
@endsection
