@extends('layouts.app')

@section('title', 'Thêm Hỗ trợ')

@section('content')
    <div class="card card-primary">
        <div class="card-body">
            <form action="{{ isset($support) ? route('support.update', $support->id) : route('support.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($support))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" name="name" class="form-control" value="{{ $support->name ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label>Logo</label>
                    <input type="file" name="logo" class="form-control">
                    @if(isset($support) && $support->logo)
                        <img src="{{ asset('storage/' . $support->logo) }}" alt="" width="100">
                    @endif
                </div>

                <div class="form-group">
                    <label>URL</label>
                    <input type="url" name="url" class="form-control" value="{{ $support->url ?? '' }}">
                </div>

                <div class="form-group">
                    <label>Trạng thái</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ (isset($support) && $support->status == 'active') ? 'selected' : '' }}>Hoạt động</option>
                        <option value="inactive" {{ (isset($support) && $support->status == 'inactive') ? 'selected' : '' }}>Không hoạt động</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">{{ isset($support) ? 'Cập nhật' : 'Thêm mới' }}</button>
            </form>
        </div>
    </div>
@stop
