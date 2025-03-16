@extends('layouts.app')

@section('title', 'Danh Sách Thể Loại Bài Viết')

@section('content_header')
    <h1>Danh Sách Thể Loại Bài Viết</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Quản Lý Thể Loại Bài Viết</h3>
        <div class="card-tools">
            <a href="{{ route('genre_posts.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Thêm Mới
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped" id="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Thể Loại</th>
                    <th>Trạng Thái</th>
                    <th>Loại</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($genrePosts as $genrePost)
                <tr>
                    <td>{{ $genrePost->id }}</td>
                    <td>{{ $genrePost->name }}</td>
                    <td>
                        <span class="badge {{ $genrePost->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                            {{ $genrePost->status }}
                        </span>
                    </td>
                    <td>{{ $genrePost->type }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('genre_posts.edit', $genrePost) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('genre_posts.destroy', $genrePost) }}" method="POST" class="d-inline">
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
