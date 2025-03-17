@extends('layouts.app')

@section('title', 'Thêm Sản Phẩm')

@section('content')
<div class="container">
    <h1>Thêm Sản Phẩm Mới</h1>

    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="subcategory_id">Danh Mục Con</label>
            <select name="subcategory_id" id="subcategory_id" class="form-control">
                @foreach($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">Tên Sản Phẩm</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="image">Ảnh Sản Phẩm</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-group">
            <label for="description">Mô Tả</label>
            <textarea name="description" id="summary4" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="short_description">Mô Tả Ngắn</label>
            <textarea name="short_description" class="form-control" rows="2"></textarea>
        </div>
<!-- Số Lượng (Ẩn) -->
<div class="form-group" style="display: none;">
    <label for="quantity">Số Lượng</label>
    <input type="number" name="quantity" class="form-control" value="1" required>
</div>


        <div class="form-group">
            <label for="price">Giá</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="status">Trạng Thái</label>
            <select name="status" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Thêm Sản Phẩm</button>
        <a href="{{ route('product.index') }}" class="btn btn-secondary">Quay Lại</a>
    </form>
</div>
@endsection
