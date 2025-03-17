@extends('layouts.app')

@section('title', 'Chi tiết Stock - ' . $product->name)

@section('content')
<div class="container-fluid">
    <style>
        .col-12 {
    background-color: #ffffff;
}
    </style>

    <div class="row">
        <div class="col-12">
            <!-- Product Info Card -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Chi tiết Stock - {{ $product->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('product.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addStockModal" data-id="{{ $product->id }}">
                            <i class="fas fa-plus"></i> Thêm số lượng
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h5>Thông tin sản phẩm:</h5>
                            <p><strong>Tên:</strong> {{ $product->name }}</p>
                            <p><strong>Số lượng trong hệ thống:</strong> {{ $product->quantity }}</p>
                            <p><strong>Số lượng thực tế:</strong> {{ $stocks->total() }}</p>
                        </div>
                        <div class="col-md-4 text-right">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="max-width: 150px;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stock List Card -->
            <div class="card card-info">
                <div class="card-header">
                    <h5 class="card-title">Danh sách Stock ({{ $stocks->total() }})</h5>
                    <div class="card-tools">
                        <form action="{{ route('stock.destroy-multiple') }}" method="POST" id="delete-multiple-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" id="delete-selected" disabled>
                                <i class="fas fa-trash"></i> Xóa đã chọn
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="30px"><input type="checkbox" id="select-all"></th>
                                <th>UUID</th>
                                <th>Value</th>

                                <th width="100px">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stocks as $stock)
                            <tr>
                                <td>
                                    <input type="checkbox" name="stock_ids[]" value="{{ $stock->id }}" class="stock-checkbox" form="delete-multiple-form">
                                </td>
                                <td>{{ $stock->uuid }}</td>
                                <td class="text-truncate" style="max-width: 400px;" title="{{ $stock->value }}">
                                    {{ $stock->value }}
                                </td>
                                <td>
                                    <form action="{{ route('stock.destroy', $stock->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Bạn có chắc muốn xóa?')">
                                            <i class="fas fa-trash"></i> Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                            @if(count($stocks) == 0)
                            <tr>
                                <td colspan="5" class="text-center">Không có dữ liệu</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <div class="float-right">
                        {{ $stocks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Thêm số lượng (giống như trước) -->
<div class="modal fade" id="addStockModal" tabindex="-1" role="dialog" aria-labelledby="addStockModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('stock.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addStockModalLabel">Thêm số lượng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                    <div class="form-group">
                        <label for="stockData">Dữ liệu (UUID|Value - mỗi dòng một sản phẩm):</label>
                        <textarea class="form-control" id="stockData" name="stockData" rows="10" required></textarea>
                        <small class="form-text text-muted">Ví dụ: 100088889215593|#0241115xsSo#A178|Y7YCJKR6TC5WCQ5OOFAU7Z42IX3RPLZU|ixktqxles24111517@vnetwork.io.vn|1T1855n4#3</small>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-info" id="parseDataBtn">Xem trước dữ liệu</button>
                    </div>
                    <div class="table-responsive" id="previewTable" style="display: none;">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>UUID</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody id="previewTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Xử lý modal thêm số lượng
        $('#parseDataBtn').on('click', function() {
            var data = $('#stockData').val();
            var lines = data.trim().split('\n');
            var tableBody = $('#previewTableBody');
            tableBody.empty();

            lines.forEach(function(line) {
                if (line.trim() !== '') {
                    var parts = line.split('|');
                    var uuid = parts[0];
                    var value = parts.slice(1).join('|');

                    var row = '<tr><td>' + uuid + '</td><td>' + value + '</td></tr>';
                    tableBody.append(row);
                }
            });

            $('#previewTable').show();
        });

        // Xử lý checkbox
        $('#select-all').on('change', function() {
            $('.stock-checkbox').prop('checked', $(this).prop('checked'));
            updateDeleteButtonState();
        });

        $('.stock-checkbox').on('change', function() {
            updateDeleteButtonState();
        });

        function updateDeleteButtonState() {
            var checkedCount = $('.stock-checkbox:checked').length;
            $('#delete-selected').prop('disabled', checkedCount === 0);
        }

        // Xác nhận xóa nhiều
        $('#delete-multiple-form').on('submit', function(e) {
            var checkedCount = $('.stock-checkbox:checked').length;
            if (checkedCount === 0) {
                e.preventDefault();
                return false;
            }

            return confirm('Bạn có chắc muốn xóa ' + checkedCount + ' stock đã chọn?');
        });
    });
</script>
@endsection
