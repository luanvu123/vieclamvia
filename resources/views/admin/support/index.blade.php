@extends('layouts.app')

@section('title', 'Danh sách Hỗ trợ')

@section('content_header')
    <h1>Danh sách Hỗ trợ</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('support.create') }}" class="btn btn-primary">Thêm Hỗ trợ</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="user-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Logo</th>
                        <th>URL</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($supports as $key=> $support)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $support->name }}</td>
                            <td>
                                @if($support->logo)
                                    <img src="{{ asset('storage/' . $support->logo) }}" alt="" width="50">
                                @endif
                            </td>
                            <td>{{ $support->url ?? 'Không có URL' }}</td>
                            <td>{{ $support->status }}</td>
                            <td>
                                <a href="{{ route('support.edit', $support->id) }}" class="btn btn-warning">Sửa</a>
                                <form action="{{ route('support.destroy', $support->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
