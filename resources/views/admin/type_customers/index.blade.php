@extends('layouts.app')

@section('title', 'Loại khách hàng')

@section('content_header')
    <h1>Danh sách Loại Khách Hàng</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('type_customers.create') }}" class="btn btn-success">Thêm Mới</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Tổng Số Dư</th>
                        <th>Phần Trăm Giảm Giá</th>
                        <th>Trạng Thái</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($typeCustomers as $typeCustomer)
                        <tr>
                            <td>{{ $typeCustomer->id }}</td>
                            <td>{{ $typeCustomer->name }}</td>
                            <td>{{ $typeCustomer->Total_Deposit }}</td>
                            <td>{{ $typeCustomer->Discount_percent }}%</td>
                            <td>{{ $typeCustomer->status }}</td>
                            <td>
                                <a href="{{ route('type_customers.edit', $typeCustomer->id) }}" class="btn btn-warning">Sửa</a>
                               
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
