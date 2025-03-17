@extends('layouts.app')

@section('title', 'Chỉnh Sửa Bài Viết')

@section('content_header')
    <h1>Chỉnh Sửa Bài Viết</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Cập Nhật Bài Viết</h3>
    </div>
    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label>Tên Bài Viết</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $post->name) }}" required>
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Thể Loại Bài Viết</label>
                <select name="genre_post_id" class="form-control @error('genre_post_id') is-invalid @enderror" required>
                    <option value="">Chọn Thể Loại</option>
                    @foreach($genrePosts as $genrePost)
                        <option value="{{ $genrePost->id }}"
                            {{ old('genre_post_id', $post->genre_post_id) == $genrePost->id ? 'selected' : '' }}>
                            {{ $genrePost->name }}
                        </option>
                    @endforeach
                </select>
                @error('genre_post_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Mô Tả</label>
                <textarea name="description" id="summary2" class="form-control" rows="5">{{ old('description', $post->description) }}</textarea>
            </div>

            <div class="form-group">
                <label>Hình Ảnh Hiện Tại</label>
                <div>
                    @if($post->image)
                        <img src="{{ Storage::url($post->image) }}" alt="{{ $post->name }}"
                             style="max-width: 200px; max-height: 200px; object-fit: cover;">
                    @else
                        <span class="badge bg-secondary">Không có ảnh</span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label>Thay Đổi Hình Ảnh</label>
                <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror"
                           id="customFile">
                    <label class="custom-file-label" for="customFile">Chọn hình ảnh mới</label>
                </div>
                @error('image')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Trạng Thái</label>
                <select name="status" class="form-control">
                    <option value="active" {{ $post->status == 'active' ? 'selected' : '' }}>Hoạt Động</option>
                    <option value="inactive" {{ $post->status == 'inactive' ? 'selected' : '' }}>Ngừng Hoạt Động</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Quay Lại</a>
        </div>
    </form>
</div>
@stop

@section('js')
<script src="{{ asset('vendor/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>
@stop
