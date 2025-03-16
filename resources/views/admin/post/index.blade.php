@extends('layouts.app')

@section('title', 'Danh Sách Bài Viết')

@section('content_header')
    <h1>Danh Sách Bài Viết</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Quản Lý Bài Viết</h3>
        <div class="card-tools">
            <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Thêm Mới
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped" id="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Hình Ảnh</th>
                    <th>Tên Bài Viết</th>
                    <th>Thể Loại</th>
                    <th>Trạng Thái</th>
                    <th>Lượt Xem</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>
                        @if($post->image)
                            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->name }}"
                                 style="max-width: 80px; max-height: 80px; object-fit: cover;">
                        @else
                            <span class="badge bg-secondary">Không có ảnh</span>
                        @endif
                    </td>
                    <td>{{ $post->name }}</td>
                    <td>{{ $post->genrePost->name ?? 'Không xác định' }}</td>
                    <td>
                        <span class="badge {{ $post->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                            {{ $post->status }}
                        </span>
                    </td>
                    <td>{{ $post->view }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-confirm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  
</div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('.delete-confirm').on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Bạn chắc chắn muốn xóa?',
                text: "Dữ liệu sẽ không thể phục hồi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý xóa!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).closest('form').submit();
                }
            });
        });
    });
</script>
@stop
