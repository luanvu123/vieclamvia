@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <form action="{{ route('banks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Số tài khoản:</label>
                <input type="text" name="account_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tên ngân hàng:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Logo:</label>
                <input type="file" name="logo" class="form-control">
            </div>
            <div class="form-group">
                <label>Mã QR:</label>
                <input type="file" name="qr_code" class="form-control">
            </div>
            <div class="form-group">
                <label>Nội dung:</label>
                <textarea name="content" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Trạng thái:</label>
                <select name="status" class="form-control">
                    <option value="active">Kích hoạt</option>
                    <option value="inactive">Ngưng hoạt động</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Thêm Ngân Hàng</button>
        </form>
    </div>
@endsection
