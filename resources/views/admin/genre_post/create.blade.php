@extends('layouts.app')

@section('title', 'Tạo Thể Loại Bài Viết')

@section('content_header')
    <h1>Tạo Thể Loại Bài Viết Mới</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Thêm Thể Loại Bài Viết</h3>
    </div>
    <form action="{{ route('genre_posts.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Tên Thể Loại</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}" required>
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Trạng Thái</label>
                <select name="status" class="form-control">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Hoạt Động</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Ngừng Hoạt Động</option>
                </select>
            </div>

            <div class="form-group">
                <label>Loại Thể Loại</label>
                <select name="type" class="form-control">
                    <option value="DANH SÁCH HƯỚNG DẪN CƠ BẢN" {{ old('type') == 'DANH SÁCH HƯỚNG DẪN CƠ BẢN' ? 'selected' : '' }}>
                        Danh Sách Hướng Dẫn Cơ Bản
                    </option>
                    <option value="DANH SÁCH THỦ THUẬT KHÁC" {{ old('type') == 'DANH SÁCH THỦ THUẬT KHÁC' ? 'selected' : '' }}>
                        Danh Sách Thủ Thuật Khác
                    </option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tạo Mới</button>
            <a href="{{ route('genre_posts.index') }}" class="btn btn-secondary">Quay Lại</a>
        </div>
    </form>
</div>
@stop
