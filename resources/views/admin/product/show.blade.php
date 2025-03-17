@extends('layouts.app')

@section('title', 'Chi Tiết Sản Phẩm')

@section('content')
<div class="container">
    <h1>Chi Tiết Sản Phẩm</h1>

    <div>
        <strong>Tên:</strong> {{ $product->name }}
    </div>

    <div>
        <strong>Danh Mục:</strong> {{ $product->subcategory->name ?? 'Không có' }}
    </div>

    <div>
        <strong>Người Tạo:</strong> {{ $product->user->name ?? 'Không có' }}
    </div>

    <div>
        <strong>Số Lượng:</strong> {{ $product->quantity }}
    </div>

    <div>
        <strong>Giá:</strong> {{ $product->price }}
    </div>

    <div>
        <strong>Trạng Thái:</strong> {{ $product->status }}
    </div>

    <div>
        <strong>Mô Tả:</strong> {{ $product->description }}
    </div>

    <div>
        <strong>Mô Tả Ngắn:</strong> {{ $product->short_description }}
    </div>

    <div>
        <strong>Ảnh:</strong><br>
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" width="200">
        @else
            Không có ảnh
        @endif
    </div>

    <a href="{{ route('product.index') }}" class="btn btn-secondary mt-3">Quay Lại</a>
</div>
@endsection
