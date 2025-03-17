@extends('layout')
@section('content')
    <div class="main-content" id="main-content">
        <div class="card card-body">
            <div class="custom_notify" data-id="8">
                <div class="notify-content">
                    <img src="{{asset('imgs/notify.svg')}}" alt="" />
                    <div class="notify-content-html">
                        <p class="text-violet font-600 font-size-17">LƯU Ý</p>
                        <p><span style="color:#000000"><strong>Lịch sử mua hàng sẽ tự đ&ocirc;̣ng xóa sau 30 ngày
                                    k&ecirc;̉ từ ngày mua.</strong></span><br />
                            *Quý khách vui lòng tải đơn hàng v&ecirc;̀ máy trước thời hạn đ&ecirc;̉ bảo quản!</p>
                    </div>
                    <span class="icon-close-notify anticon anticon-close"></span>
                </div>
            </div>
        </div>
        <div class="card card-body">
            <h4 class="bold">Lịch Sử Mua Hàng</h4>
            <button class="btn btn-success" data-toggle="modal" data-target="#modalAdvanceSearch">Tìm Đơn Hàng</button>
            <div class="table-responsive m-t-30">
                <table id="table-datatable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Ngày mua</th>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $order->order_key }}</td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ number_format($order->total_price) }} VNĐ</td>
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
                                <td>
                                    <a href="{{ route('customer.order.detail', $order->id) }}" class="btn btn-primary btn-sm">
                                        <i class="anticon anticon-eye"></i> Chi tiết
                                    </a>
                                    @if($order->status == 'completed')
                                        <a href="#" class="btn btn-info btn-sm download-order" data-id="{{ $order->id }}">
                                            <i class="anticon anticon-download"></i> Tải xuống
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Không có đơn hàng nào</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal tìm kiếm nâng cao -->
    <div class="modal fade" id="modalAdvanceSearch" tabindex="-1" role="dialog" aria-labelledby="modalAdvanceSearchLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAdvanceSearchLabel">Tìm kiếm đơn hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAdvanceSearch">
                        <div class="form-group">
                            <label for="orderKey">Mã đơn hàng</label>
                            <input type="text" class="form-control" id="orderKey" placeholder="Nhập mã đơn hàng">
                        </div>
                        <div class="form-group">
                            <label for="dateRange">Khoảng thời gian</label>
                            <input type="text" class="form-control" id="dateRange">
                        </div>
                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select class="form-control" id="status">
                                <option value="">Tất cả</option>
                                <option value="completed">Hoàn thành</option>
                                <option value="pending">Đang xử lý</option>
                                <option value="cancelled">Đã hủy</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="btnSearch">Tìm kiếm</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Khởi tạo date range picker
        $('#dateRange').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY'
            }
        });

        // DataTable
        var table = $('#table-datatable').DataTable({
            language: {
                url: '{{ asset("js/datatable-vietnamese.json") }}'
            },
            responsive: true,
            order: [[1, 'desc']]
        });

        // Tìm kiếm nâng cao
        $('#btnSearch').click(function() {
            var orderKey = $('#orderKey').val();
            var status = $('#status').val();
            var dateRange = $('#dateRange').val();

            // Gửi request AJAX để tìm kiếm
            $.ajax({
                url: '{{ route("customer.orders.search") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    orderKey: orderKey,
                    status: status,
                    dateRange: dateRange
                },
                success: function(response) {
                    // Cập nhật bảng với kết quả tìm kiếm
                    table.clear().draw();
                    if (response.orders.length > 0) {
                        response.orders.forEach(function(order) {
                            table.row.add([
                                order.order_key,
                                order.created_at,
                                order.product_name,
                                order.quantity,
                                order.total_price_formatted,
                                order.status_html,
                                order.actions
                            ]).draw();
                        });
                    }
                    $('#modalAdvanceSearch').modal('hide');
                },
                error: function(error) {
                    console.error('Lỗi khi tìm kiếm:', error);
                }
            });
        });

        // Xử lý tải xuống đơn hàng
        $('.download-order').click(function(e) {
            e.preventDefault();
            var orderId = $(this).data('id');
            window.location.href = '{{ url("customer/orders") }}/' + orderId + '/download';
        });

        // Đóng thông báo
        $('.icon-close-notify').click(function() {
            $(this).closest('.custom_notify').fadeOut();
        });
    });
</script>
@endsection
