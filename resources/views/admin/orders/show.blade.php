@extends('layouts.app')

@section('title', 'Chi Tiết Đơn Hàng')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="box-body">
                    <h4>Thông Tin Đơn Hàng</h4>
                    <p><strong>Khách Hàng:</strong> {{ $order->customer->name ?? 'N/A' }}</p>
                    <p><strong>Sản Phẩm:</strong> {{ $order->product->name ?? 'N/A' }}</p>
                    <p><strong>Số Lượng:</strong> {{ $order->quantity }}</p>
                    <p><strong>Tổng Tiền:</strong> {{ number_format($order->total_price, 0, ',', '.') }} VND</p>
                    <p><strong>Trạng Thái:</strong> {{ $order->status }}</p>
                    <p><strong>Ngày Tạo:</strong> {{ $order->created_at->format('d/m/Y H:i:s') }}</p>
                </div>

                <div class="box-body">
                    <h4>Chi Tiết Đơn Hàng</h4>
                    <table class="table table-bordered" id="user-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>UUID</th>
                                <th>Giá Trị</th>
                                <th>Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderDetails as $key => $detail)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $detail->uuid }}</td>
                                    <td>{{$detail->value}}</td>
                                    <td>{{ $detail->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
