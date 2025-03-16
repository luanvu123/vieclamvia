@extends('layouts.app')

@section('title', 'Chỉnh sửa thông tin khách hàng')

@section('content')
    <div class="container">
        <div class="card-header">
            <h3 class="card-title">Chỉnh sửa thông tin khách hàng</h3>
            <div class="card-tools">
                <a href="{{ route('customer-manage.index') }}" class="btn btn-sm btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>

            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('customer-manage.update', $customerManage->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Tên khách hàng</label>
                            <input type="text" class="form-control" id="name" value="{{ $customerManage->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ $customerManage->email }}"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label for="idCustomer">Mã khách hàng</label>
                            <input type="text" class="form-control" id="idCustomer"
                                value="{{ $customerManage->idCustomer }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="idCustomer">Mã 2fa</label>
                            <input type="text" class="form-control" id="2faCustomer"
                                value="{{ $customerManage->google2fa_secret }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" value="{{ $customerManage->phone }}"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label for="url_facebook">URL Facebook</label>
                            <input type="text" class="form-control" id="url_facebook" name="url_facebook"
                                value="{{ old('url_facebook', $customerManage->url_facebook) }}">
                        </div>


                        <div class="form-group">
                            <label for="last_active_at">Thời gian hoạt động gần nhất</label>
                            <input type="text" class="form-control" id="last_active_at"
                                value="{{ $customerManage->last_active_at ? $customerManage->last_active_at->diffForHumans() : 'Chưa hoạt động' }}"
                                disabled>
                        </div>

                        <h4 class="mt-3">Lịch sử đăng nhập</h4>
                        <div style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Thời gian</th>
                                        <th>Thiết bị</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customerManage->loginHistories as $history)
                                        <tr>
                                            <td>{{ $history->created_at->format('d/m/Y H:i:s') }}</td>
                                            <td>{{ $history->device }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Balance">Số dư *</label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('Balance') is-invalid @enderror"
                                    id="Balance" name="Balance" value="{{ old('Balance', $customerManage->balance) }}"
                                    readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                                @error('Balance')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">Mật khẩu mới (để trống nếu không thay đổi)</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Status">Trạng thái *</label>
                            <select class="form-control @error('Status') is-invalid @enderror" id="Status" name="Status"
                                required>
                                <option value="1" {{ old('Status', $customerManage->Status) == 1 ? 'selected' : '' }}>
                                    Hoạt động</option>
                                <option value="0" {{ old('Status', $customerManage->Status) == 0 ? 'selected' : '' }}>
                                    Khóa</option>
                            </select>
                            @error('Status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="is2Fa">Xác thực hai yếu tố (2FA)</label>
                            <select class="form-control" id="is2Fa" name="is2Fa">
                                <option value="1" {{ $customerManage->is2Fa ? 'selected' : '' }}>Đã kích hoạt
                                </option>
                                <option value="0" {{ !$customerManage->is2Fa ? 'selected' : '' }}>Chưa kích hoạt
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
