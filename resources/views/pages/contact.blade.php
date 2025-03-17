@extends('layout')
@section('content')
    <div class="card card-body">
        <h4 class="bold">Liên hệ</h4>

        <div class="row contact-wrapper-page">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-body row">
                        @foreach($supports as $support)
                            <div class="col-sm-12 col-md-6 col-lg-12 col-xl-6 mt-3 mb-3">
                                <div class="tag-wrapper row col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <a class="m-l-20 contact-icon telegram-contact-btn">
                                        @if($support->logo)
                                            <img src="{{ asset('storage/' . $support->logo) }}" alt="" class="rounded-circle">
                                        @else
                                            <img src="/images/contact/default-logo.svg" alt="" class="rounded-circle">
                                        @endif
                                    </a>
                                    <div class="text text-center">
                                        <h4 class="m-b--15">{{ $support->name }}</h4>
                                        @if($support->url)
                                            <a class="link" href="{{ $support->url }}" target="_blank">CHAT NGAY</a>
                                        @else
                                            <span class="text-muted">Không có đường dẫn</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

