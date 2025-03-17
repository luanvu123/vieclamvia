@extends('layout')
@section('content')
    <div class="main-content" id="main-content">
        <div class="card card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="bold">Chi Tiết Đơn Hàng</h4>
                <a href="{{ route('customer.orders') }}" class="btn btn-primary">
                    <i class="anticon anticon-arrow-left"></i> Quay lại
                </a>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Thông tin đơn hàng</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Mã đơn hàng:</th>
                                    <td>{{ $order->order_key }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày mua:</th>
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái:</th>
                                    <td>
                                        @if($order->status == 'completed')
                                            <span class="badge badge-success">Hoàn thành</span>
                                        @elseif($order->status == 'pending')
                                            <span class="badge badge-warning">Đang xử lý</span>
                                        @elseif($order->status == 'cancelled')
                                            <span class="badge badge-danger">Đã hủy</span>
                                        @else
                                            <span class="badge badge-secondary">{{ $order->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Thông tin sản phẩm</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Tên sản phẩm:</th>
                                    <td>{{ $order->product->name }}</td>
                                </tr>
                                <tr>
                                    <th>Số lượng:</th>
                                    <td>{{ $order->quantity }}</td>
                                </tr>
                                <tr>
                                    <th>Tổng tiền:</th>
                                    <td>{{ number_format($order->total_price) }} VNĐ</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title">Chi tiết đơn hàng</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>UUID</th>
                                    <th>Giá trị</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orderDetails as $detail)
                                    <tr>
                                        <td>{{ $detail->id }}</td>
                                        <td>
                                            <span class="text-primary">{{ $detail->uuid }}</span>
                                            <button class="btn btn-sm btn-outline-secondary copy-btn" data-clipboard-text="{{ $detail->uuid }}">
                                                <i class="anticon anticon-copy"></i>
                                            </button>
                                        </td>
                                        <td>{{ $detail->value }}</td>
                                        <td>
                                            @if($detail->status == 'active')
                                                <span class="badge badge-success">Hoạt động</span>
                                            @elseif($detail->status == 'used')
                                                <span class="badge badge-warning">Đã sử dụng</span>
                                            @elseif($detail->status == 'expired')
                                                <span class="badge badge-danger">Hết hạn</span>
                                            @else
                                                <span class="badge badge-secondary">{{ $detail->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $detail->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Không có chi tiết đơn hàng</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if($order->status == 'completed')
                <div class="mt-4">
                    <a href="{{ route('customer.order.download', $order->id) }}" class="btn btn-success">
                        <i class="anticon anticon-download"></i> Tải xuống đơn hàng
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
    $(document).ready(function() {
        // Khởi tạo clipboard.js
        var clipboard = new ClipboardJS('.copy-btn');

        clipboard.on('success', function(e) {
            // Thông báo sao chép thành công
            $(e.trigger).tooltip({
                title: 'Đã sao chép!',
                trigger: 'manual'
            }).tooltip('show');

            setTimeout(function() {
                $(e.trigger).tooltip('hide');
            }, 1000);

            e.clearSelection();
        });

        clipboard.on('error', function(e) {
            // Thông báo khi có lỗi
            $(e.trigger).tooltip({
                title: 'Không thể sao chép, hãy thử lại',
                trigger: 'manual'
            }).tooltip('show');

            setTimeout(function() {
                $(e.trigger).tooltip('hide');
            }, 1000);
        });
    });
</script>
@endsection
