@extends('layout')
@section('content')


    <div class="main-content" id="main-content">

        <h4 class="bold">Chính Sách Bảo Hành</h4>

        <div class="row warranty-policy">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header card-bg-1">
                        Chấp nhận bảo hành
                    </div>
                    <div class="card-body">
                          {!! $layout_info->warranty_policy_success!!}
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header card-bg-2">
                           {!! $layout_info->warranty_policy_error!!}
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
