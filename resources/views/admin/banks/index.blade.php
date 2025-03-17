@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <a href="{{ route('banks.create') }}" class="btn btn-primary mb-3">Thêm Ngân Hàng</a>

        <table class="table table-bordered" id="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Số tài khoản</th>
                    <th>Tên ngân hàng</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banks as $bank)
                    <tr>
                        <td>{{ $bank->id }}</td>
                        <td>{{ $bank->account_number }}</td>
                        <td>{{ $bank->name }}</td>
                        <td>{{ $bank->status }}</td>
                        <td>
                            <a href="{{ route('banks.edit', $bank->id) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('banks.destroy', $bank->id) }}" method="POST" style="display:inline;">
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
@endsection
