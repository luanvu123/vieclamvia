@extends('layout')
@section('content')

<div class="main-content" id="main-content">
    <div class="card card-body">
        <div class="custom_notify" data-id="12">
            <div class="notify-content">
                <img src="/images/svg/notify.svg" alt="">
                <div class="notify-content-html">
                    <p class="text-violet font-600 font-size-17">
                    </p>
                </div>
                <span class="icon-close-notify anticon anticon-close"></span>
            </div>
        </div>
    </div>

    <div class="card-body">
        <h4 class="bold"></h4>

        <p class="text-center m-b-30 dark_p">Hệ thống Nâng Cấp Tự Động, chỉ cần <span style="color:red;"> NẠP TỔNG
                THÁNG</span> đủ
            mốc.</p>

        <div id="vue_app">
            <div class="text-center">
                @foreach ($typeCustomers as $typeCustomer)
                    <div class="item-percent">
                        <div class="user-item bg-1">
                            <div class="user-item-lv">
                                <h4 class="m-b-0 font-weight-bold text-uppercase m-t-5">{{ $typeCustomer->name }}</h4>
                                <div class="text-capitalize">
                                    <span class="font-size-13 font-weight-semibold">Tổng Nạp Tháng:
                                        {{ number_format($typeCustomer->Total_Deposit) }} VNĐ</span>
                                </div>
                                <div class="price_star font-size-16 w-100 mgt-10 flex-center-center">
                                    @for ($i = 0; $i < 3; $i++)
                                        <i class="anticon anticon-star"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div class="rule-customer">
                            <div class="upgrade">
                                <div class="left"> Tổng Nạp Tháng</div>
                                <div class="right full-width">
                                    <div class="value">{{ number_format($typeCustomer->Total_Deposit) }} VNĐ</div>
                                </div>
                            </div>
                            <div class="discount-level">
                                <div class="left"> Ưu đãi Hạng Giảm</div>
                                <div class="right">
                                    <div class="value">-{{ $typeCustomer->Discount_percent }}</div> <span>%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

</section>
