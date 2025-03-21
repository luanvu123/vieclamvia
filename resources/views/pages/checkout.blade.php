@extends('layout')
@section('content')


    <div class="main-content" id="main-content">

        <div class="card card-body">
            <h4 class="mb-3 bold">Nạp Tiền Tự Động 24/7</h4>

            <div class="row">
                <div class="col-md-7">
                    <div class="tab-money">
                        <ul class="nav nav-pills pd-20 nav-banks" role="tablist">
                            @foreach ($banks as $key => $bank)
                                <li class="nav-item">
                                    <a class="nav-link {{ $key === 0 ? 'active' : '' }}" data-toggle="pill"
                                        href="#payment_{{ $key }}" role="tab">
                                        <img height="25px" src="{{ asset('storage/' . $bank->logo) }}" alt="{{ $bank->name }}">
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content">
                            @foreach ($banks as $key => $bank)
                                <div class="tab-pane fade {{ $key === 0 ? 'show active' : '' }}" id="payment_{{ $key }}"
                                    role="tabpanel">
                                    <div class="col-12">
                                        <div class="row">
                                            <!-- Thông tin thanh toán -->
                                            <div class="col-sm-12 col-md-6 col-lg-7 text-center">
                                                <div class="card">
                                                    <div class="card-header text-center pb-2">
                                                        <h6>THÔNG TIN THANH TOÁN</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <h4 class="text-primary">
                                                            <img height="50px" src="{{ asset('storage/' . $bank->logo) }}"
                                                                alt="{{ $bank->name }}">
                                                        </h4>
                                                        <h5 class="py-2">{{ $bank->account_number }}</h5>
                                                        <h5>{{ $bank->name }}</h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Mã QR -->
                                            <div class="col-sm-12 col-md-6 col-lg-5 text-center">
                                                <div class="card">
                                                    <div class="card-body">
                                                        @if ($bank->qr_code)
                                                            <img src="{{ asset('storage/' . $bank->qr_code) }}" alt="QR Code"
                                                                class="qr-code" style="max-width: 150px;">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Nội dung chuyển khoản -->
                                            <div class="col-12 text-center">
                                                <div class="card">
                                                    <div class="card-body text-center">
                                                        <h5>NỘI DUNG CHUYỂN KHOẢN</h5>
                                                        <div class="alert alert-info alert-dismissible fade show">
                                                            <strong style="font-size: 20px">
                                                                {{ $customer->idCustomer }}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>


                <div class="col-md-5">
                    <div class="tab-money height-full">
                        <div class="wallet pd-20">
                            <div class="text-center">
                                <span>Tổng Nạp Tháng</span>
                            </div>
                            <div class="text-center">
                                <span class="wallet-my">{{ number_format($customer->Balance, 0, ',', '.') }} VND
                                </span>
                                <p class="m-b-5 m-t-10">Cấp Bậc: <span class="account-level bg-user-level bg-1"> {{ $customer->typeCustomer->name ?? 'Chưa được phân loại' }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="money-note pd-20">
                            <h5 class="text-uppercase mb-3"><i class="anticon anticon-info-circle"></i> Lưu ý</h5>
                            <div class="alert alert-success">
                                + Mẹo: Quét Mã QR để Chuyển tiền nhanh với nội dung đã có sẵn!
                            </div>
                            <div class="alert alert-primary">
                                + Vui lòng chuyển khoản ĐÚNG nội dung để được nạp tiền tự động trong vòng 30s giây. Không
                                HOÀN TIỀN khi đã NẠP vào!
                            </div>
                            <div class="alert alert-danger">
                                + Chuyển SAI nội dung hoặc sau 2 phút không cộng tiền vui lòng liên hệ admin ở phần Liên
                                hệ.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 m-t-30">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-area mb-3" style="display: none">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Lịch sử Nạp thẻ</h5>
                                </div>

                                <div class="table-responsive m-t-30">
                                    <table id="table-phone-cards" class="table table-hover" style="width: 100%"></table>
                                </div>

                                <hr />
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Lịch sử Nạp tiền</h5>
                            </div>

                            <div class="table-responsive m-t-30">
                                <table id="table-datatable" class="table table-hover"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
