@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ isset($typeCustomer) ? route('type_customers.update', $typeCustomer->id) : route('type_customers.store') }}" method="POST">
                @csrf
                @if(isset($typeCustomer))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label>Tên:</label>
                    <input type="text" name="name" class="form-control" value="{{ $typeCustomer->name ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label>Tổng Số Dư:</label>
                    <input type="number" name="Total_Deposit" class="form-control" value="{{ $typeCustomer->Total_Deposit ?? 0 }}" required>
                </div>

                <div class="form-group">
                    <label>Phần Trăm Giảm Giá:</label>
                    <input type="number" name="Discount_percent" class="form-control" value="{{ $typeCustomer->Discount_percent ?? 0 }}" required>
                </div>

                <div class="form-group">
                    <label>Trạng Thái:</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ (isset($typeCustomer) && $typeCustomer->status === 'active') ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ (isset($typeCustomer) && $typeCustomer->status === 'inactive') ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">{{ isset($typeCustomer) ? 'Cập nhật' : 'Thêm mới' }}</button>
            </form>
        </div>
    </div>
@stop
