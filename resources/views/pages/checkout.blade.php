@extends('layout')
@section('content')


    <div class="main-content" id="main-content">

        <div class="card card-body">
            <h4 class="mb-3 bold">Nạp Tiền Tự Động 24/7</h4>

            <div class="row">
                <div class="col-md-7">
                    <div class="tab-money">
                        <ul class="nav nav-pills pd-20 nav-banks" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link  active " data-toggle="pill" href="#payment_0" role="tab"
                                    aria-controls="pills-home" aria-selected="true">
                                    <img height="25px" src="https://vlclone.com/images/banks/icon/ACB.png" alt="">
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " data-toggle="pill" href="#payment_1" role="tab"
                                    aria-controls="pills-home" aria-selected="true">
                                    <img height="25px" src="https://vlclone.com/images/banks/icon/USDT.png" alt="">
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " data-toggle="pill" href="#payment_2" role="tab"
                                    aria-controls="pills-home" aria-selected="true">
                                    <img height="25px" src="https://vlclone.com/images/banks/icon/BINANCE.png" alt="">
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " data-toggle="pill" href="#payment_3" role="tab"
                                    aria-controls="pills-home" aria-selected="true">
                                    <img height="25px" src="https://vlclone.com/images/banks/icon/PAYPAL.png" alt="">
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane fade  show active " id="payment_0" role="tabpanel" data-syntax="vlclone">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-12
                                                                                            col-md-6 col-lg-7
                                                                                            text-center">
                                            <div class="card">
                                                <div class="card-header text-center pb-2">
                                                    <h6>THÔNG TIN THANH TOÁN</h6>
                                                </div>
                                                <div class="card-body">
                                                    <h4 class="text-primary">
                                                        <img height="50px" src="https://vlclone.com/images/banks/icon/ACB.png" alt="">
                                                    </h4>
                                                    <h5 class="py-2">6679798686</h5>
                                                    <h5>Nguyễn Ngọc Hoàng Long</h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-5 text-center">

                                            <div class="card">
                                                <div class="card-body">
                                                    <img src="https://img.vietqr.io/image/ACB-6679798686-qr_only.png?accountName=Nguy%C3%AA%CC%83n+Ngo%CC%A3c+Hoa%CC%80ng+Long&amp;addInfo=vlclone+zrtbyybbj24100816"
                                                        alt="qr code" class="qr-code">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 text-center">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <h5>NỘI DUNG CHUYỂN KHOẢN</h5>
                                                    <div class="alert alert-info alert-dismissible fade show">
                                                        <strong style="font-size: 20px"><span class="bank-syntax"></span>
                                                            zrtbyybbj24100816</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="payment_1" role="tabpanel" data-syntax="1">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-12
                                                                                            col-md-6 col-lg-7
                                                                                            text-center">
                                            <div class="card">
                                                <div class="card-header text-center pb-2">
                                                    <h6>THÔNG TIN THANH TOÁN</h6>
                                                </div>
                                                <div class="card-body">
                                                    <h4 class="text-primary">
                                                        <img height="50px" src="https://vlclone.com/images/banks/icon/USDT.png" alt="">
                                                    </h4>
                                                    <label style="font-weight: bold">Select Chains</label>

                                                    <select class="form-control" id="usdt_chain">
                                                        <option value="BEP20"
                                                            data-address="0x0b43aa5ae2c47a2449bb96684e3c40d0028ae74d">BEP20
                                                        </option>
                                                        <option value="ERC20"
                                                            data-address="0x0b43aa5ae2c47a2449bb96684e3c40d0028ae74d">ERC20
                                                        </option>
                                                        <option value="TRC20"
                                                            data-address="TV5jV6B8TTL3K3cg5mHyUvyp9ofLM9A26G">TRC20</option>
                                                    </select>

                                                    <div class="custom-bank-line-sm" style="margin-top: 10px">Address:
                                                        <span class="copy-on-click" id="usdt_address"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-5 text-center">

                                            <div class="card">
                                                <div class="card-body">
                                                    <img id="usdt_image" src="https://vlclone.com/images/banks/others/usd_bep20.jpeg" alt=""
                                                        class="qr-code" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="payment_2" role="tabpanel" data-syntax="vlclone">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-12
                                                                                            col-md-6 col-lg-7
                                                                                            text-center">
                                            <div class="card">
                                                <div class="card-header text-center pb-2">
                                                    <h6>THÔNG TIN THANH TOÁN</h6>
                                                </div>
                                                <div class="card-body">
                                                    <h4 class="text-primary">
                                                        <img height="50px" src="https://vlclone.com/images/banks/icon/BINANCE.png" alt="">
                                                    </h4>
                                                    <h5 class="py-2">Binance ID: 251711073</h5>
                                                    <h5>Email: <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                            data-cfemail="2e6a4f404f4d4b405a4b5c4f4a5d6e49434f4742004d4143">[email&#160;protected]</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-5 text-center">

                                            <div class="card">
                                                <div class="card-body">
                                                    <img src="https://vlclone.com/images/banks/others/binance.jpg" alt="qr code"
                                                        class="qr-code">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 text-center">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <h5>NỘI DUNG CHUYỂN KHOẢN</h5>
                                                    <div class="alert alert-info alert-dismissible fade show">
                                                        <strong style="font-size: 20px"><span class="bank-syntax"></span>
                                                            zrtbyybbj24100816</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="payment_3" role="tabpanel" data-syntax="vlclone">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-12
                                                                                            col-md-12 col-lg-12
                                                                                            text-center">
                                            <div class="card">
                                                <div class="card-header text-center pb-2">
                                                    <h6>THÔNG TIN THANH TOÁN</h6>
                                                </div>
                                                <div class="card-body">
                                                    <h4 class="text-primary">
                                                        <img height="50px" src="https://vlclone.com/images/banks/icon/PAYPAL.png" alt="">
                                                    </h4>
                                                    <h5 class="py-2">Email: <a href="/cdn-cgi/l/email-protection"
                                                            class="__cf_email__"
                                                            data-cfemail="6307020d0200060d17061102071023040e020a0f4d000c0e">[email&#160;protected]</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12 text-center">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <h5>NỘI DUNG CHUYỂN KHOẢN</h5>
                                                    <div class="alert alert-info alert-dismissible fade show">
                                                        <strong style="font-size: 20px"><span class="bank-syntax"></span>
                                                            zrtbyybbj24100816</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                <span class="wallet-my">0
                                </span>
                                <p class="m-b-5 m-t-10">Cấp Bậc: <span class="account-level bg-user-level bg-1"> KHÁCH
                                        HÀNG</span>
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
