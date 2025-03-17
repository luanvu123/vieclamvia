@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h3>Chỉnh sửa Ngân Hàng</h3>
        <form action="{{ route('banks.update', $bank->id) }}" method="POST" enctype="multipart/form-data" class="mt-3">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Số tài khoản:</label>
                <input type="text" name="account_number" class="form-control" value="{{ $bank->account_number }}" required>
            </div>

            <div class="form-group">
                <label>Tên ngân hàng:</label>
                <input type="text" name="name" class="form-control" value="{{ $bank->name }}" required>
            </div>

            <div class="form-group">
                <label>Logo hiện tại:</label><br>
                @if($bank->logo)
                    <img src="{{ asset('storage/' . $bank->logo) }}" alt="Logo" style="max-width: 150px;"><br>
                @else
                    Không có logo
                @endif
                <input type="file" name="logo" class="form-control mt-2">
            </div>

            <div class="form-group">
                <label>Mã QR hiện tại:</label><br>
                @if($bank->qr_code)
                    <img src="{{ asset('storage/' . $bank->qr_code) }}" alt="QR Code" style="max-width: 150px;"><br>
                @else
                    Không có mã QR
                @endif
                <input type="file" name="qr_code" class="form-control mt-2">
            </div>

            <div class="form-group">
                <label>Nội dung:</label>
                <textarea name="content" class="form-control">{{ $bank->content }}</textarea>
            </div>

            <div class="form-group">
                <label>Trạng thái:</label>
                <select name="status" class="form-control">
                    <option value="active" {{ $bank->status == 'active' ? 'selected' : '' }}>Kích hoạt</option>
                    <option value="inactive" {{ $bank->status == 'inactive' ? 'selected' : '' }}>Ngưng hoạt động</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Cập Nhật</button>
            <a href="{{ route('banks.index') }}" class="btn btn-secondary mt-3">Quay Lại</a>
        </form>
    </div>
@endsection
