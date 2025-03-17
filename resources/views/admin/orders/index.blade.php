@extends('layouts.app')

@section('title', 'Danh sách Đơn Hàng')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <table class="table table-hover" id="user-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã Đơn Hàng</th>
                            <th>Khách Hàng</th>
                            <th>Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Tổng Tiền</th>
                            <th>Trạng Thái</th>
                            <th>Ngày Tạo</th>
                            <th>Chi Tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $key => $order)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>
                                    <a href="{{ route('order-manage.show', $order->id) }}">{{ $order->order_key }}</a>
                                </td>
                                <td>

                                    <a href="{{ route('customer-manage.edit', $order->customer->id) }}">
                                        {{ $order->customer->name}}
                                    </a>
                                </td>
                                <td>{{ $order->product->name ?? 'N/A' }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ number_format($order->total_price, 0, ',', '.') }} VND</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->created_at->format('d/m/Y H:i:s') }}</td>
                                <td>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection
