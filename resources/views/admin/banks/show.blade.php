@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h3>Thông tin Ngân Hàng</h3>
        <div class="card mt-3">
            <div class="card-body">
                <p><strong>Số tài khoản:</strong> {{ $bank->account_number }}</p>
                <p><strong>Tên ngân hàng:</strong> {{ $bank->name }}</p>

                @if($bank->logo)
                    <p><strong>Logo:</strong></p>
                    <img src="{{ asset('storage/' . $bank->logo) }}" alt="Logo" style="max-width: 150px;">
                @endif

                @if($bank->qr_code)
                    <p><strong>Mã QR:</strong></p>
                    <img src="{{ asset('storage/' . $bank->qr_code) }}" alt="QR Code" style="max-width: 150px;">
                @endif

                <p><strong>Nội dung:</strong> {{ $bank->content }}</p>
                <p><strong>Trạng thái:</strong> {{ ucfirst($bank->status) }}</p>

                <a href="{{ route('banks.index') }}" class="btn btn-secondary mt-3">Quay Lại</a>
            </div>
        </div>
    </div>
@endsection
