@extends('layouts.app')

@section('title', 'Danh Sách Sản Phẩm')

@section('content')
    <div class="container">
        <h1>Danh Sách Sản Phẩm</h1>
        <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">Thêm Sản Phẩm</a>

        <table class="table table-bordered" id="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Ảnh</th>
                    <th>Số Lượng</th>
                    <th>Giá</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td><img src="{{ asset('storage/' . $product->image) }}" width="50"></td>
                        <td>
                            <a href="{{ route('product.stocks', $product->id) }}" class="badge badge-info">
                                {{ $product->stocks_count }}
                            </a>
                            @if($product->quantity != $product->stocks_count)
                                <span class="badge badge-warning" title="Số lượng hiển thị khác với số thực tế trong kho">
                                    {{ $product->quantity }}
                                </span>
                                <a href="{{ route('product.sync-quantity', $product->id) }}" class="btn btn-xs btn-default"
                                    title="Đồng bộ số lượng">
                                    <i class="fas fa-sync"></i>
                                </a>
                            @endif
                        </td>

                        <td>{{ number_format($product->price) }} VNĐ</td>
                        <td>{{ $product->status }}</td>
                        <td>
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                            </form>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addStockModal"
                                data-id="{{ $product->id }}">
                                Thêm số lượng
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Thêm số lượng -->
    <div class="modal fade" id="addStockModal" tabindex="-1" role="dialog" aria-labelledby="addStockModalLabel"
        aria-hidden="true">
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
                        <input type="hidden" name="product_id" id="product_id">
                        <div class="form-group">
                            <label for="stockData">Dữ liệu (UUID|Value - mỗi dòng một sản phẩm):</label>
                            <textarea class="form-control" id="stockData" name="stockData" rows="10" required></textarea>
                            <small class="form-text text-muted">Ví dụ:
                                100088889215593|#0241115xsSo#A178|Y7YCJKR6TC5WCQ5OOFAU7Z42IX3RPLZU|ixktqxles24111517@vnetwork.io.vn|1T1855n4#3</small>
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

    <script>
        $(document).ready(function () {
            $('#addStockModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var productId = button.data('id');
                var modal = $(this);
                modal.find('#product_id').val(productId);
            });

            $('#parseDataBtn').on('click', function () {
                var data = $('#stockData').val();
                var lines = data.trim().split('\n');
                var tableBody = $('#previewTableBody');
                tableBody.empty();

                lines.forEach(function (line) {
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
        });
    </script>
@endsection
