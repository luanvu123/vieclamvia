@extends('layouts.app')

@section('title', 'Sửa Sản Phẩm')

@section('content')
<div class="container">
    <h1>Sửa Sản Phẩm</h1>

    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="subcategory_id">Danh Mục Con</label>
            <select name="subcategory_id" id="subcategory_id" class="form-control">
                @foreach($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}" {{ $product->subcategory_id == $subcategory->id ? 'selected' : '' }}>
                        {{ $subcategory->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">Tên Sản Phẩm</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
            <label for="image">Ảnh Sản Phẩm</label>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" width="100" class="mb-3">
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-group">
            <label for="description">Mô Tả</label>
            <textarea name="description" id="summary4" class="form-control" rows="3">{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="short_description">Mô Tả Ngắn</label>
            <textarea name="short_description" class="form-control" rows="2">{{ $product->short_description }}</textarea>
        </div>

        <div class="form-group">
            <label for="quantity">Số Lượng</label>
            <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}" required>
        </div>

        <div class="form-group">
            <label for="price">Giá</label>
            <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
        </div>

        <div class="form-group">
            <label for="status">Trạng Thái</label>
            <select name="status" class="form-control">
                <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật Sản Phẩm</button>
        <a href="{{ route('product.index') }}" class="btn btn-secondary">Quay Lại</a>
    </form>
</div>
@endsection
