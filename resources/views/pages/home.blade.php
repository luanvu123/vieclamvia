@extends('layout')
@section('content')

    <div class="main-content" id="main-content">
        <div class="card card-body">
            <div class="custom_notify" data-id="5">
                <div class="notify-content">
                    <img src="{{asset('imgs/notify.svg')}}" alt="" />
                    <div class="notify-content-html">
                        <p class="text-violet font-600 font-size-17">Thông báo</p>
                        {!! $layout_info->notice!!}
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
                                        <th style="text-align: center; width: 40px;">#</th>
                                        <th class="col-category-name">{{ $subcategory->name }}</th>
                                        <th class="col-description">Mô Tả</th>
                                        <th style="text-align: center; width: 70px;">Còn</th>
                                        <th style="width: 100px;">Giá</th>
                                        <th style="width: 50px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subcategory->products as $product)
                                        <tr class="{{ $product->quantity > 0 ? 'c_pointer' : '' }}">
                                            <td> <img src="{{ asset('storage/' . $product->image) }}" alt="" height="15"></td>
                                            <td>

                                                {{ $product->name }}
                                            </td>
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
            <!-- Lịch sử mua hàng -->
            <div class="col-sm-12 col-lg-6">
                <div class="card">
                    <div class="card-header info-card-header">
                        Mua Hàng Gần Đây
                    </div>
                    <div class="card-body">
                        @foreach ($orders as $order)
                            <div class="history-item">
                                <b>
                                    <span style="color: green;"> <i class="fa fa-bell"></i>
                                        {{ Str::limit($order->customer->username, 2, '****') }}
                                    </span>:
                                    <span style="color: red;">Đã mua {{ $order->quantity }} {{ $order->product->name }} -
                                        {{ number_format($order->total_price) }} VND</span>
                                </b>
                                <span class="right">
                                    <span class="badge badge-primary">
                                        <em>{{ $order->created_at->diffForHumans() }}</em>
                                    </span>
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Lịch sử nạp tiền -->
            <div class="col-sm-12 col-lg-6">
                <div class="card">
                    <div class="card-header info-card-header">
                        Nạp Tiền Gần Đây
                    </div>
                    <div class="card-body">
                        @foreach ($deposits as $deposit)
                            <div class="history-item">
                                <b>
                                    <span style="color: green;"> <i class="fa fa-bell"></i>
                                        {{ Str::limit($deposit->customer->username, 6, '****') }}
                                    </span>:
                                    <span style="color: red;">Đã nạp {{ number_format($deposit->money) }} VND -
                                        {{ $deposit->content }}</span>
                                </b>
                                <span class="right">
                                    <span class="badge badge-primary">
                                        <em>{{ $deposit->created_at->diffForHumans() }}</em>
                                    </span>
                                </span>
                            </div>
                        @endforeach
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
