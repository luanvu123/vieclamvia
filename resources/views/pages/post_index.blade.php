@extends('layout')
@section('content')
    <style>
        /*css blog*/
        .container {
            max-width: 1400px;
        }

        .blog_name {
            border-radius: 30px;
            /*background: linear-gradient(261.99deg, rgba(226, 115, 216, 0.3) 1.23%, rgba(145, 154, 255, 0.3) 90.88%);*/
            padding: 10px 0;
        }

        .blog_cate_item img {
            border-radius: 30px;
        }

        .blog_cate_item a {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 40.28%, rgba(0, 0, 0, 0.7) 100%);
            border-radius: 30px;
            display: flex;
            align-items: flex-end;
            padding: 15px 20px;
        }

        .blog_cate_item a:hover {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 40.28%, rgba(0, 0, 0, 0.9) 100%);
        }

        .blog_cate_slider .swiper-button.swiper-button-circle.swiper-button-next {
            right: 0;
        }

        .blog_cate_slider .swiper-button.swiper-button-circle.swiper-button-prev {
            left: 0;
        }

        .blog_cover {
            border-radius: 30px;
            max-height: 200px;
        }

        .blog_cover img {
            border-radius: 30px;
            width: 100%;
        }

        .link_cate {
            background-color: #e3dff9;
            border-radius: 16px;
            min-height: 32px;
            color: #a66be1;
            padding: 0 15px;
        }

        .blog_item_1 h4 a {
            color: #3d3269;
            padding: 0 30px;
            text-align: center;
            display: block;
        }

        .blog_day {
            border-top: 1px dotted #ccc;
            margin-top: 15px;
            padding-top: 15px;
        }

        .blog_item_1 .blog_day {
            text-align: center;
        }

        .blog_day i,
        .blog_item h4 a:hover {
            color: #a66be1;
        }

        .blog_item_2 {
            display: flex;
        }

        .blog_item_2 .blog_cover {
            flex: 0 0 220px;
            max-width: 220px;
            height: 220px;
            margin-right: 20px;
        }

        .blog_cache h4 {
            min-height: 100px;
        }

        .blog_right .blog_item:not(:last-child) {
            margin-bottom: 20px;
        }

        .blog_list .col-md-6 {
            margin-bottom: 30px;
        }

        .blog_content .blog_cover.zoom-img:before {
            padding-bottom: 35%;
        }

        .border-radius-30,
        .border-radius-30 img {
            border-radius: 30px;
        }

        article p {
            color: #3d3269;
        }

        .blog_suggest:before {
            border-top: 1px dashed #ccc;
            content: '';
            height: 1px;
            width: 50%;
            position: absolute;
            left: 50%;
            transform: translate(-50%, 0);
            top: 0;
        }

        /*.border-radius-16, .border-radius-16 .card-body{*/
        /*  border-radius: 16px;*/
        /*}*/
        .box_check_all {
            background-color: #f7f6fc;
            border-bottom: solid 1px #e3dff9;
            padding: 15px 20px;
        }

        .manage_item {
            border-bottom: solid 1px #e3dff9;
            display: flex;
            align-items: center;
            padding: 13px 20px;
        }

        .manage_item .custom-control {
            flex: 0 0 20px;
            max-width: 20px;
        }

        .manage_item .manage_content {
            margin-right: auto;
        }

        .av {
            border-radius: 50%;
            flex: 0 0 40px;
            max-width: 40px;
            margin: 0 20px;
        }

        .av img {
            border-radius: 50%;
            height: 40px;
            width: 100%;
            object-fit: cover;
        }

        .manage_item .blog_day {
            border: none;
            padding: 0;
            margin: 10px 0;
        }

        .blog_day a {
            color: #2245e3;
        }

        .item-title>div {
            color: #3f87f5;
        }

        .manage_item.selected {
            background-color: #f2e9fb;
        }

        .frm_item_v {
            border-radius: 6px;
            background-color: #f7f6fc;
            height: 45px;
            padding: 0 15px;
            border: none;
            width: 100%;
        }

        .blog_create_title span {
            margin-right: 90px;
            white-space: nowrap;
        }

        .no-wrapper {
            white-space: nowrap;
        }

        .frm_item_select {
            height: 32px;
            padding: 3px 16px;
            border-radius: 6px;
            background-color: #f7f6fc;
            border: none;
            width: 200px;
            max-width: 100%;
        }

        .blog_config .row>div {
            margin-bottom: 10px;
        }

        .sb {
            border-top: 1px solid #eee;
            padding: 15px 0;
        }

        .blog_abs {
            position: absolute;
            right: 0;
            top: 0;
            background: rgba(240, 238, 251, 0.5);
            border-radius: 89px 0 0 0;
            padding: 30px;
        }

        .blog_sidebar>div {
            margin-bottom: 20px;
        }

        .control-container {
            margin-bottom: 20px;
            display: flex;
            display: -webkit-flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .table-total-items {
            padding-right: 8px;
        }

        .table-total-items::after {
            content: '|';
            font-weight: 700;
        }

        .table-total-items strong {
            margin-right: 5px;
        }

        .custom-table-top {
            margin-bottom: 10px;
        }

        .custom-table-top .per-page-select {
            padding-right: 27px;
            margin-right: 10px;
            border: none !important;
            outline: 0 !important;
            box-shadow: none !important;
            font-size: 15px !important;
            font-weight: 700;
        }

        .custom-table-top label {
            margin-bottom: 0 !important;
        }

        .custom-filter {
            position: relative;
        }

        .custom-filter input {
            padding: .55rem 1rem;
            background-color: #f7f6fc;
            line-height: 1.5;
            padding-right: 35px !important;
            font-size: 13px;
        }

        .custom-filter .icon-search {
            position: absolute;
            right: 12px;
            top: 12px;
            cursor: pointer;
        }

        .btn-icon .fa {
            margin-right: 0;
        }

        @media screen and (max-width: 768px) {
            .control-container>div {
                margin-bottom: 10px;
            }
        }

        @media screen and (min-width: 768px) and (max-width: 1700px) {
            .font-size-40 {
                font-size: 32px !important;
            }

            .font-size-24 {
                font-size: 18px !important;
            }

            .blog_abs {
                padding: 30px 10px;
            }
        }

        @media screen and (min-width: 768px) and (max-width: 1399px) {
            .font-size-40 {
                font-size: 25px !important;
            }

            .font-size-24 {
                font-size: 16px !important;
            }

            .col-md-10-cus {
                -ms-flex: 0 0 63.333333%;
                flex: 0 0 63.333333%;
                max-width: 63.333333%;
            }

            .blog_cover {
                max-height: 320px;
            }

            .blog_item_2 .blog_cover {
                height: 200px;
            }

            .blog_day {
                font-size: 14px;
            }
        }

        @media screen and (min-width: 768px) {
            .mb_2_relative {
                display: none;
            }
        }

        @media screen and (max-width: 767px) {
            .blog_abs {
                display: none;
            }

            .font-size-40 {
                font-size: 25px !important;
            }

            .font-size-24 {
                font-size: 16px !important;
            }

            .blog_cover {
                border-radius: 30px;
                max-height: 300px;
            }

            .blog_item_2 {
                margin-top: 30px;
            }

            .blog_item_2 .blog_cover {
                flex: 0 0 180px;
                max-width: 180px;
                height: 180px;
                margin-right: 10px;
            }

            .mb_2_relative {
                position: fixed;
                z-index: 9999;
                left: 0;
                right: 0;
                bottom: 0;
            }
        }

        header {
            padding: 30px 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 100;
            background-color: white;
        }

        .main_full {
            top: 103px;
        }

        .area-copyright {
            position: unset;
        }

        @media screen and (min-width: 1200px) {
            .landing_right {
                position: fixed;
                right: 0;
                width: 290px;
            }
        }

        @media screen and (max-width: 1199px) {
            .landing_banner {
                display: block !important;
            }

            header {
                padding: 15px 0;
                background: #e3dff9;
            }

            .landing_left {
                padding-bottom: 150px;
            }

            .landing_right {
                position: fixed;
                bottom: 0;
                width: 100%;
            }
        }

        .inflex-center-center {
            display: inline-flex;
            display: -webkit-inline-flex;
            align-items: center;
            justify-content: center;
        }

        .zoom {
            display: block;
            overflow: hidden;
        }

        .zoom:hover img {
            transform: scale(1.1);
            -webkit-transform: scale(1.1);
        }

        .zoom-img {
            position: relative;
        }

        .zoom-img:before {
            content: '';
            display: block
        }

        .zoom-img span {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 2
        }

        .zoom-img span img {
            object-fit: cover;
            height: 100%;
            width: 100%
        }


        .blog-card {
            background: #fff;
            margin-bottom: 30px;
            transition: 0.5s;
            border-color: #eee;
            border-radius: 0.55rem;
            position: relative;
            width: 100%;
        }

        .blog-type-header {
            padding: 10px;
            position: relative;
            box-shadow: none;
            background: #d262e3 linear-gradient(307deg, #086841 0, #61ab46 100%) !important;
        }

        .blog-type-header h2 {
            font-size: 15px;
            color: #757575;
            position: relative;
            margin-bottom: 0;
            line-height: 1;
        }

        .blog-type-header strong {
            color: white;
        }

        .blog-card .body {
            font-size: 14px;
            color: #424242;
            padding: 20px;
            font-weight: 400;
        }

        .list-unstyled {
            padding-left: 0;
            list-style: none;
        }

        .follow_us li {
            position: relative;
        }

        .media {
            margin-bottom: 20px;
        }

        .follow_us .media .media-object {
            width: 40px;
            -webkit-border-radius: 50px;
            -moz-border-radius: 50px;
            -ms-border-radius: 50px;
            border-radius: 50px;
            margin-right: 10px;
        }

        .media .media-body {
            color: #616161;
            font-size: 14px;
        }

        .follow_us .media .name {
            font-weight: 600;
            color: #424242;
            margin: 0;
            font-size: 15px;
            display: block;
        }

        .follow_us .media .message {
            font-size: 13px;
            color: #78909c;
            max-width: 180px;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            font-weight: 600;
        }

        .follow_us li.online .status {
            display: inline-block;
            position: absolute;
            left: 25px;
            top: 0;
            width: 11px;
            height: 11px;
            min-width: inherit;
            border: 2px solid #fff;
            -webkit-border-radius: 50px;
            -moz-border-radius: 50px;
            -ms-border-radius: 50px;
            border-radius: 50px;
            background: #8bc34a;
            padding: 0;
        }

        @media screen and (max-width: 500px) {
            #main-content>.container {
                padding: 0 5px 5px 5px;
            }

            .blog-type-header+.body {
                padding: 0 !important;
            }

            .blog-type-header+.body .body {
                padding: 10px;
            }
        }
    </style>
    <div class="main-content" id="main-content">

        <div class="container">
            <section class="blog relative">

                <div class="row clearfix">
                    <!-- Hiển thị DANH SÁCH HƯỚNG DẪN CƠ BẢN -->
                    <div class="col-lg-6">
                        <div class="blog-card">
                            <div class="blog-type-header">
                                <h2><strong>DANH SÁCH HƯỚNG DẪN CƠ BẢN</strong></h2>
                            </div>
                            <div class="body">
                                <ul class="follow_us list-unstyled m-b-0">
                                    @foreach ($basicGuides as $genre)
                                        @foreach ($genre->posts as $post)
                                            <li class="online">
                                                <a href="{{ url('blogs/' . $genre->slug . '/' . $post->slug) }}">
                                                    <div class="media">
                                                        <img class="media-object" src="{{ asset('storage/' . $post->image) }}"
                                                            width="40px" height="40px" alt="">
                                                        <div class="media-body">
                                                            <span class="name">{{ $post->name }}</span>
                                                            <a class="message"
                                                                href="{{ url('danh-muc/' . $genre->slug) }}">#{{ $genre->name }}</a>
                                                            <span class="badge badge-outline status"></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </div>

                    <!-- Hiển thị DANH SÁCH THỦ THUẬT KHÁC -->
                    <div class="col-lg-6">
                        <div class="blog-card">
                            <div class="blog-type-header">
                                <h2><strong>DANH SÁCH THỦ THUẬT KHÁC</strong></h2>
                            </div>
                            <div class="body">

                                <ul class="follow_us list-unstyled m-b-0">
                                    @foreach ($otherTutorials as $genre)
                                        @foreach ($genre->posts as $post)
                                            <li class="online">
                                                <a href="{{ url('blogs/' . $genre->slug . '/' . $post->slug) }}">
                                                    <div class="media">
                                                        <img class="media-object" src="{{ asset('storage/' . $post->image) }}"
                                                            width="40px" height="40px" alt="">
                                                        <div class="media-body">
                                                            <span class="name">{{ $post->name }}</span>
                                                            <span class="message">#{{ $genre->name }}</span>
                                                            <span class="badge badge-outline status"></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
