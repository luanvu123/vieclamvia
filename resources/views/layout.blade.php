<!DOCTYPE html>
<html lang="vi">

<head>
    <title>VLclone.com - Hệ Thống Mua Bán VIA XMDT, VIA 902, BM, CLONE Giá Rẻ</title>


    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <meta name="description" content="VLCLONE.COM - Cung Cấp Via Người Dùng Thật Còn Tương Tác. Bảo Hành Lỗi 1-1" />
    <meta itemprop="description" content="VLCLONE.COM - Cung Cấp Via Người Dùng Thật Còn Tương Tác. Bảo Hành Lỗi 1-1" />
    <meta name=keyword content="vlclone" />

    <meta property="og:title" content="VLclone.com - Hệ Thống Mua Bán VIA XMDT, VIA 902, BM, CLONE Giá Rẻ" />
    <meta property="og:site_name"
        content="VLCLONE.COM - Cung Cấp Via Người Dùng Thật Còn Tương Tác. Bảo Hành Lỗi 1-1" />
    <meta property="og:description"
        content="VLCLONE.COM - Cung Cấp Via Người Dùng Thật Còn Tương Tác. Bảo Hành Lỗi 1-1" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="" />
    <meta property="og:keywords" content="" />






    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('imgs/LogoT11ab-removebg-preview.png')}}">


    <link href="{{asset('css/app.min.css')}}" media="all" type="text/css" rel="stylesheet" />
    <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css" />

    <!--- Multiple Language --->
    <link href="{{asset('css/language.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('plugins/vue/bootstrap-vue.min.css')}}" rel="stylesheet preload" as="style" />
    <link href="{{asset('css/shop.css')}}" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="app is-default">
        <div class="layout">
            <!-- Header START -->
            <div class="header">
                <div class="logo logo-dark">
                    <a href="/">
                        <img class="logo-primary" src="{{asset('imgs/LogoDashbrocccah.png')}}" alt="Logo">
                        <img class="logo-fold" src="{{asset('imgs/LogoT11ab-removebg-preview.png')}}" alt="Logo">
                    </a>
                </div>
                <div class="logo logo-white">
                    <a href="/">
                        <img src="{{asset('imgs/LogoDashbrocccah.png')}}" alt="Logo">
                        <img class="logo-fold" src="{{asset('imgs/LogoT11ab-removebg-preview.png')}}" alt="Logo">
                    </a>
                </div>
                <div class="nav-wrap">
                    <ul class="nav-left">
                        <li class="desktop-toggle">
                            <a href="javascript:void(0);" title="toggle">
                                <i class="anticon"></i>
                            </a>
                        </li>
                        <li class="mobile-toggle">
                            <a href="javascript:void(0);" title="toggle">
                                <i class="anticon"></i>
                            </a>

                        </li>
                        <li>
                            <a href="/" class="pl-0 pr-0 logo-fold-mobile">
                                <img class="logo-fold" src="{{asset('imgs/LogoT11ab-removebg-preview.png')}}" alt="Logo"
                                    height="60">
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">
                        <div id="google_translate_element" style="display: none;"></div>
                        <div class="dropdown dropdown-animated dropdown-language">
                            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-expanded="false">
                                <img src="{{ asset('imgs/vietnamese.svg') }}" style="border-radius: 5px" alt="" />
                                <span>Việt Nam</span>
                            </button>
                            <div class="dropdown-menu" style="cursor: pointer">
                                <span class="dropdown-item" onClick="resetTranslate()">
                                    <img src="{{ asset('imgs/vietnamese.svg') }}" style="border-radius: 5px" alt="" />
                                    Việt Nam
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('en')">
                                    <img src="{{ asset('imgs/unitedstates.svg') }}" style="border-radius: 5px" alt="" />
                                    Mỹ - English
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('tl')">
                                    <img src="{{ asset('imgs/philippines.svg') }}" style="border-radius: 5px" alt="" />
                                    Philippines - Filipino
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('id')">
                                    <img src="{{ asset('imgs/indonesia.svg') }}" style="border-radius: 5px" alt="" />
                                    Indonesia
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('zh-CN')">
                                    <img src="{{ asset('imgs/china.svg') }}" style="border-radius: 5px" alt="" />
                                    Trung Quốc - Giản Thể
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('zh-TW')">
                                    <img src="{{ asset('imgs/china.svg') }}" style="border-radius: 5px" alt="" />
                                    Trung Quốc - Phồn Thể
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('ja')">
                                    <img src="{{ asset('imgs/japan.svg') }}" style="border-radius: 5px" alt="" />
                                    Nhật Bản - Japan
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('ko')">
                                    <img src="{{ asset('imgs/korea.svg') }}" style="border-radius: 5px" alt="" />
                                    Hàn Quốc - Korea
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('th')">
                                    <img src="{{ asset('imgs/thailan.svg') }}" style="border-radius: 5px" alt="" />
                                    Thái Lan - ThaiLand
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('es')">
                                    <img src="{{ asset('imgs/spain.svg') }}" style="border-radius: 5px" alt="" />
                                    Tây Ban Nha - Spain
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('hi')">
                                    <img src="{{ asset('imgs/an-do-india.svg') }}" style="border-radius: 5px" alt="" />
                                    Ấn Độ - Hindi
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('pt')">
                                    <img src="{{ asset('imgs/brazil.svg') }}" style="border-radius: 5px" alt="" />
                                    Brazil - Bồ Đào Nha
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('ms')">
                                    <img src="{{ asset('imgs/malaysia.svg') }}" style="border-radius: 5px" alt="" />
                                    Malaysia - Mã Lai
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('it')">
                                    <img src="{{ asset('imgs/italy.svg') }}" style="border-radius: 5px" alt="" />
                                    Italy - Ý
                                </span>
                            </div>
                        </div>


                        @if (Auth::guard('customer')->check())
                            <!-- Menu thả xuống khi đã đăng nhập -->
<div class="user-details">
                                    Số dư: <span
                                        class="total-load">{{ number_format(Auth::guard('customer')->user()->Balance, 0, ',', '.') }}
                                        VND</span>
                                </div>
                            <li class="dropdown dropdown-animated scale-left">

                                <div class="pointer" data-toggle="dropdown">
                                    <div class="avatar avatar-image m-h-10 m-r-15">
                                        <img src="{{ asset('imgs/verify-user.svg') }}" width="48" height="48" alt="User" />
                                    </div>
                                </div>

                                <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                                    <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                                        <div class="d-flex m-r-50">
                                            <div class="avatar avatar-lg avatar-image">
                                                <img src="{{ asset('imgs/verify-user.svg') }}" width="48" height="48"
                                                    alt="User" />
                                            </div>
                                            <div class="m-l-10">
                                                <p class="m-b-0 text-dark font-weight-semibold">
                                                    {{ Auth::guard('customer')->user()->name ?? 'Tên người dùng' }}
                                                </p>
                                                <p class="m-b-0 opacity-07">KHÁCH HÀNG</p>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('profile.site') }}" class="dropdown-item d-block p-h-15 p-v-10">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <i class="anticon opacity-04 font-size-16 anticon-user"></i>
                                                <span class="m-l-10">Sửa hồ sơ</span>
                                            </div>
                                            <i class="anticon font-size-10 anticon-right"></i>
                                        </div>
                                    </a>
                                    <a href="{{route('checkout')}}" class="dropdown-item d-block p-h-15 p-v-10">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <i class="anticon opacity-04 font-size-16 anticon-lock"></i>
                                                <span class="m-l-10">Nạp tiền</span>
                                            </div>
                                            <i class="anticon font-size-10 anticon-right"></i>
                                        </div>
                                    </a>
                                    <a href="{{ route('profile.site') }}" class="dropdown-item d-block p-h-15 p-v-10">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <i class="anticon opacity-04 font-size-16 anticon-project"></i>
                                                <span class="m-l-10">Đổi mật khẩu</span>
                                            </div>
                                            <i class="anticon font-size-10 anticon-right"></i>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0);" onclick="onLogout()"
                                        class="dropdown-item d-block p-h-15 p-v-10">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                                                <span class="m-l-10">Đăng xuất</span>
                                            </div>
                                            <i class="anticon font-size-10 anticon-right"></i>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        @else
                            <button class="btn" id="registerBtn">Đăng ký</button>
                            <button class="btn" id="loginBtn">Đăng nhập</button>

                            <!-- Registration and Login Modal -->
                            <div id="modal" class="modal">
                                <div class="modal-content">
                                    <span class="close-btn">&times;</span>
                                    <h2 id="modalTitle">Đăng ký</h2>
                                    <form id="authForm" method="POST" action="/customer/register">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="form-group" id="fullNameGroup">
                                            <label for="fullName">Họ và Tên</label>
                                            <input type="text" id="fullName" name="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="email" required>
                                        </div>
                                        <div class="form-group" id="phoneGroup">
                                            <label for="phone">Số Điện Thoại</label>
                                            <input type="tel" id="phone" name="phone">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Mật Khẩu</label>
                                            <input type="password" id="password" name="password" required>
                                        </div>
                                        <div class="form-group" id="passwordConfirmGroup">
                                            <label for="password_confirmation">Xác Nhận Mật Khẩu</label>
                                            <input type="password" id="password_confirmation" name="password_confirmation">
                                        </div>
                                        <div class="form-group" id="agreeGroup">
                                            <input type="checkbox" id="agree">
                                            <label for="agree">Tôi đã đọc và đồng ý với điều khoản</label>
                                        </div>
                                        <button type="submit" class="btn">Gửi</button>
                                    </form>

                                    <p id="toggleText">Đã có tài khoản? <span id="toggleLink">Đăng nhập</span></p>
                                </div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const modal = document.getElementById('modal');
                                    const registerBtn = document.getElementById('registerBtn');
                                    const loginBtn = document.getElementById('loginBtn');
                                    const authForm = document.getElementById('authForm');
                                    const modalTitle = document.getElementById('modalTitle');
                                    const toggleText = document.getElementById('toggleText');
                                    const fullNameGroup = document.getElementById('fullNameGroup');
                                    const phoneGroup = document.getElementById('phoneGroup');
                                    const passwordConfirmGroup = document.getElementById('passwordConfirmGroup');
                                    const agreeGroup = document.getElementById('agreeGroup');
                                    const closeBtn = document.querySelector('.close-btn');

                                    function showModal(isRegister) {
                                        modal.style.display = 'block';
                                        if (isRegister) {
                                            modalTitle.innerText = 'Đăng ký';
                                            authForm.action = '/customer/register';
                                            fullNameGroup.style.display = 'block';
                                            phoneGroup.style.display = 'block';
                                            passwordConfirmGroup.style.display = 'block';
                                            agreeGroup.style.display = 'block';
                                            toggleText.innerHTML = 'Đã có tài khoản? <span id="toggleLink">Đăng nhập</span>';
                                        } else {
                                            modalTitle.innerText = 'Đăng nhập';
                                            authForm.action = '/customer/login';
                                            fullNameGroup.style.display = 'none';
                                            phoneGroup.style.display = 'none';
                                            passwordConfirmGroup.style.display = 'none';
                                            agreeGroup.style.display = 'none';
                                            toggleText.innerHTML = 'Chưa có tài khoản? <span id="toggleLink">Đăng ký</span>';
                                        }
                                        attachToggleEvent();
                                    }

                                    function hideModal() {
                                        modal.style.display = 'none';
                                        authForm.reset();
                                    }

                                    function attachToggleEvent() {
                                        document.getElementById('toggleLink').onclick = function () {
                                            if (modalTitle.innerText === 'Đăng ký') {
                                                showModal(false);
                                            } else {
                                                showModal(true);
                                            }
                                        };
                                    }

                                    registerBtn.onclick = function () {
                                        showModal(true);
                                    };

                                    loginBtn.onclick = function () {
                                        showModal(false);
                                    };

                                    window.onclick = function (event) {
                                        if (event.target === modal) {
                                            hideModal();
                                        }
                                    };

                                    closeBtn.onclick = function () {  // Thêm phần này để xử lý sự kiện nhấn nút đóng
                                        hideModal();
                                    };

                                    authForm.onsubmit = async function (e) {
                                        e.preventDefault();
                                        const url = authForm.action;
                                        const formData = new FormData(authForm);

                                        try {
                                            const response = await fetch(url, {
                                                method: 'POST',
                                                headers: {
                                                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                                                },
                                                body: formData
                                            });
                                            const result = await response.json();

                                            if (response.ok) {
                                                alert(result.message);
                                                location.reload();
                                            } else {
                                                alert('Đã xảy ra lỗi! Vui lòng kiểm tra lại thông tin.');
                                            }
                                        } catch (error) {
                                            alert('Đã xảy ra lỗi kết nối!');
                                        }
                                    };
                                });

                            </script>
                        @endif

                    </ul>
                </div>
            </div>
            <!-- Side Nav START -->
            <div class="side-nav">
                <div class="side-nav-inner">
                    <ul class="side-nav-menu scrollable">
                        <li class="header-nav">Menu</li>
                        <li class="nav-item">
                            <a href="{{route('/')}}">
                                <span class="icon-holder">
                                    <i class="anticon anticon-home" style="color:tomato"></i>
                                </span>
                                <span class="title">Trang Chủ</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('customer.orders')}}" class="auth-required">
                                <span class="icon-holder">
                                    <i class="anticon anticon-ordered-list" style="color:tomato"></i>
                                </span>
                                <span class="title">Lịch Sử Mua Hàng</span>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-shopping-cart" style="color:tomato"></i>
                                </span>
                                <span class="title link-shop" data-link="">Mua Hàng</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($layout_categories as $category)
                                                                <li class="dropdown">
                                                                    <a class="dropdown-toggle" href="#">
                                                                        <img class="img menu goto-view" alt=""
                                                                            src="{{ asset('storage/' . $category->icon) }}" />
                                                                        <span class="goto-view">{{ $category->name }}</span>
                                                                        <span class="arrow"><i class="arrow-icon"></i></span>
                                                                    </a>

                                                                    @php
                                                                        $subcategories = $layout_subcategories->where('category_id', $category->id);
                                                                    @endphp

                                                                    @if ($subcategories->isNotEmpty())
                                                                        <ul class="dropdown-menu">
                                                                            @foreach ($subcategories as $subcategory)
                                                                                <li>
                                                                                    <a
                                                                                        href="{{ route('category.show', ['categoryId' => $category->id, 'subcategoryId' => $subcategory->id]) }}">
                                                                                        <img class="img menu" alt=""
                                                                                            src="{{ asset('storage/' . $subcategory->image) }}" />
                                                                                        <span>{{ $subcategory->name }}</span>
                                                                                    </a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    @endif
                                                                </li>
                                @endforeach
                            </ul>


                        </li>

                        <li class="nav-item">
                            <a href="{{route('warranty_policy')}}">
                                <span class="icon-holder">
                                    <i class="anticon anticon-paper-clip" style="color:tomato"></i>
                                </span>
                                <span class="title">Chính Sách Bảo Hành</span>
                            </a>
                        </li>

                        <li class="header-nav">TIỆN ÍCH</li>
                        <li class="nav-item">
                            <a href="{{route('checkout')}}" class="auth-required">
                                <span class="icon-holder">
                                    <i class="anticon anticon-bank" style="color:#008800"></i>
                                </span>
                                <span class="title">Nạp Tiền</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('customer.deposits.index')}}" class="auth-required">
                                <span class="icon-holder">
                                    <i class="anticon anticon-clock-circle" style="color:#FF6600"></i>
                                </span>
                                <span class="title">Lịch Sử Giao Dịch</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="https://dongvanfb.net/check_live_uid/">
                                <span class="icon-holder">
                                    <i class="anticon anticon-account-book" style="color:#FF6600"></i>
                                </span>
                                <span class="title">Check Live UID</span>
                            </a>
                        </li>
                        <li class="header-nav">HỖ TRỢ</li>


                        <li class="nav-item">
                            <a href="{{route('contact')}}">
                                <span class="icon-holder">
                                    <i class="anticon anticon-contacts" style="color:#888888"></i>
                                </span>
                                <span class="title">Liên Hệ - Support</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('post.site')}}">
                                <span class="icon-holder">
                                    <i class="anticon anticon-book" style="color:orange"></i>
                                </span>
                                <span class="title">Blogs</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Side Nav END -->

            <section class="page-container">
                @yield('content')
            </section>
        </div>
    </div>


    <a href="{{$layout_info->url_facebook}}" id="linkzalo" target="_blank" rel="noopener noreferrer">
        <div id="fcta-zalo-tracking" class="fcta-zalo-mess">
            <span id="fcta-zalo-tracking">Support Now</span>
        </div>
        <div class="fcta-zalo-vi-tri-nut">
            <div id="fcta-zalo-tracking" class="fcta-zalo-nen-nut">
                <div id="fcta-zalo-tracking" class="fcta-zalo-ben-trong-nut">
                    <img src="{{asset('imgs/facebook-logo.svg')}}" alt="">
                </div>
                <div id="fcta-zalo-tracking" class="fcta-zalo-text"></div>
            </div>
        </div>
    </a>

    <!-- alertModal -->
    <div id="alertModal" class="modal modal-fixed-top fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thông báo mới</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {!!$layout_info->notice_modal!!}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-md btn-nw m-r-5" id="btn-hide-notify">
                        <i class="anticon anticon-eye"></i>KHÔNG HIỆN LẠI
                    </button>
                    <button class="btn btn-danger btn-nw m-r-5" data-dismiss="modal">
                        <i class="anticon anticon-close-circle"></i>THOÁT
                    </button>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{asset('js/vendors.min.js')}}"></script>
    <script src="{{asset('js/common.js')}}"></script>
    <script src="{{asset('js/user.js')}}"></script>
    <script src="{{asset('js/language.js')}}"></script>
    <script src="{{asset('plugins/vue/vue.js')}}"></script>
    <script src="{{asset('plugins/vue/bootstrap-vue.min.js')}}"></script>
    <script src="{{asset('plugins/axios/axios.min.js')}}"></script>
    <script src="{{asset('js/shop.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

    <!-- Include DataTables JavaScript -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#user_log').DataTable();
        });
    </script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'vi', // Ngôn ngữ mặc định là Tiếng Việt
                autoDisplay: false
            }, 'google_translate_element');
        }

        function changeLanguage(lang) {
            var translateElement = document.querySelector('.goog-te-combo');
            if (translateElement) {
                translateElement.value = lang;
                translateElement.dispatchEvent(new Event('change'));
            }
        }

        function resetTranslate() {
            changeLanguage('vi');
        }
    </script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


</body>

</html>
