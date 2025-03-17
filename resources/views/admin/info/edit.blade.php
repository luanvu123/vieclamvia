@extends('layouts.app')

@section('title', 'Chỉnh sửa Thông Tin')

@section('content')
 <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="box-title">Thông Tin Website</h3>
            </div>
            <form action="{{ route('info.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="box-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="form-group">
                        <label>Logo Lớn</label>
                        <input type="file" name="big_logo" class="form-control">
                        @if($info->big_logo)
                            <img src="{{ asset('storage/' . $info->big_logo) }}" alt="Big Logo" width="100" class="mt-2">
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Logo Nhỏ</label>
                        <input type="file" name="small_logo" class="form-control">
                        @if($info->small_logo)
                            <img src="{{ asset('storage/' . $info->small_logo) }}" alt="Small Logo" width="50" class="mt-2">
                        @endif
                    </div>

                    <div class="form-group">
                        <label>URL Facebook</label>
                        <input type="url" name="url_facebook" class="form-control" value="{{ $info->url_facebook }}">
                    </div>

                    <div class="form-group">
                        <label>Thông Báo</label>
                        <textarea name="notice" id="summary1" class="form-control" rows="3">{!! $info->notice !!}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Thông Báo Modal</label>
                        <textarea name="notice_modal"  id="summary4" class="form-control" rows="3">{!!$info->notice_modal !!}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Chính Sách Bảo Hành (Thành Công)</label>
                        <textarea name="warranty_policy_success"  id="summary5" id="summary1" class="form-control" rows="3">{!! $info->warranty_policy_success !!}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Chính Sách Bảo Hành (Thất Bại)</label>
                        <textarea name="warranty_policy_error"  id="summary6" class="form-control" rows="3">{!! $info->warranty_policy_error !!}</textarea>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                </div>
            </form>
        </div>
</div>
@endsection
