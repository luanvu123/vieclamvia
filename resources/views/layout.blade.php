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
                        <div id="google_translate_element"></div>
                        <div class="dropdown dropdown-animated dropdown-language">
                            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-expanded="false">
                                <img src="{{asset('imgs/vietnamese.svg')}}" style="border-radius: 5px" alt="" />
                                <span>Việt Nam</span>
                            </button>
                            <div class="dropdown-menu" style="cursor: pointer">
                                <span class="dropdown-item" onClick="resetTranslate()">
                                    <img src="/images/countries/vietnamese.svg" style="border-radius: 5px" alt="" />
                                    Việt Nam
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('en')">
                                    <img src="/images/countries/unitedstates.svg" style="border-radius: 5px" alt="" />
                                    Mỹ - English
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('tl')">
                                    <img src="/images/countries/philippines.svg" style="border-radius: 5px" alt="" />
                                    Philippines - Filipino
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('id')">
                                    <img src="/images/countries/indonesia.svg" style="border-radius: 5px" alt="" />
                                    Indonesia
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('zh-CN')">
                                    <img src="/images/countries/china.svg" style="border-radius: 5px" alt="" />
                                    Trung Quốc - Giản Thể
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('zh-TW')">
                                    <img src="/images/countries/china.svg" style="border-radius: 5px" alt="" />
                                    Trung Quốc - Phồn Thể
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('th')">
                                    <img src="/images/countries/thailan.svg" style="border-radius: 5px" alt="" />
                                    Thái Lan - ThaiLand
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('es')">
                                    <img src="/images/countries/spain.svg" style="border-radius: 5px" alt="" />
                                    Tây Ban Nha - Spain
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('ja')">
                                    <img src="/images/countries/japan.svg" style="border-radius: 5px" alt="" />
                                    Nhật Bản - Japan
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('ko')">
                                    <img src="/images/countries/korea.svg" style="border-radius: 5px" alt="" />
                                    Hàn Quốc - Korea
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('my')">
                                    <img src="/images/countries/myanmar.svg" style="border-radius: 5px" alt="" />
                                    Myanmar
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('ur')">
                                    <img src="/images/countries/pakistan.svg" style="border-radius: 5px" alt="" />
                                    Pakistan - Urdu
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('ms')">
                                    <img src="/images/countries/singapore.svg" style="border-radius: 5px" alt="" />
                                    Singapore - Mã Lai
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('ta')">
                                    <img src="/images/countries/singapore.svg" style="border-radius: 5px" alt="" />
                                    Singapore - Tamil
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('pt')">
                                    <img src="/images/countries/brazil.svg" style="border-radius: 5px" alt="" />
                                    Brazil - Bồ Đào Nha
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('hi')">
                                    <img src="/images/countries/an-do-india.svg" style="border-radius: 5px" alt="" />
                                    Ấn Độ - Hindi
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('ms')">
                                    <img src="/images/countries/malaysia.svg" style="border-radius: 5px" alt="" />
                                    Malaysia - Mã Lai
                                </span>
                                <span class="dropdown-item" onClick="changeLanguage('it')">
                                    <img src="/images/countries/italy.svg" style="border-radius: 5px" alt="" />
                                    Italy - Ý
                                </span>
                            </div>
                        </div>

                        @if (Auth::guard('customer')->check())
                            <!-- Menu thả xuống khi đã đăng nhập -->
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
                                                    {{ Auth::guard('customer')->user()->name ?? 'Tên người dùng' }}</p>
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
                                    <a href="https://vlclone.com/profile" class="dropdown-item d-block p-h-15 p-v-10">
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
                            <a href="https://vlclone.com">
                                <span class="icon-holder">
                                    <i class="anticon anticon-home" style="color:tomato"></i>
                                </span>
                                <span class="title">Trang Chủ</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="https://vlclone.com/orders" class="auth-required">
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
                                <span class="title link-shop" data-link="https://vlclone.com/shop">Mua Hàng</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown">
                                    <a class="dropdown-toggle" href="javascript:void(0);"
                                        data-link="https://vlclone.com/shop/4">
                                        <img class="img menu goto-view" alt="" src="/images/tags/fb-bm.png" />
                                        <span class="goto-view">Danh sách BM</span>
                                        <span class="arrow">
                                            <i class="arrow-icon"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="https://vlclone.com/shop/4/1">
                                                <img class="img menu" alt="" src="/images/stores/BM_Old.jpg" />
                                                <span>BM50$</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://vlclone.com/shop/4/2">
                                                <img class="img menu" alt="" src="/images/stores/BM_Old.jpg" />
                                                <span>BM350$</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://vlclone.com/shop/4/3">
                                                <img class="img menu" alt="" src="/images/stores/BM_Old.jpg" />
                                                <span>BM Limit 250$</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" href="javascript:void(0);"
                                        data-link="https://vlclone.com/shop/3">
                                        <img class="img menu goto-view" alt="" src="/images/tags/facebook.svg" />
                                        <span class="goto-view">Danh sách Via</span>
                                        <span class="arrow">
                                            <i class="arrow-icon"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="https://vlclone.com/shop/3/4">
                                                <img class="img menu" alt="" src="/images/stores/xmdttichxanh.svg" />
                                                <span>Via Kháng 902 | Chat Support</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://vlclone.com/shop/3/7">
                                                <img class="img menu" alt="" src="/images/tags/nolimit.svg" />
                                                <span>TKQC Limit 50$</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://vlclone.com/shop/3/12">
                                                <img class="img menu" alt="" src="/images/tags/nolimit.svg" />
                                                <span>TKQC Limit 250$</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://vlclone.com/shop/3/5">
                                                <img class="img menu" alt="" src="/images/stores/global1.svg" />
                                                <span>Via Ngoại Live Ads</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://vlclone.com/shop/3/11">
                                                <img class="img menu" alt="" src="/images/stores/global1.svg" />
                                                <span>Via Ngoại Die Ads</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://vlclone.com/shop/3/6">
                                                <img class="img menu" alt="" src="/images/stores/vietnamese.svg" />
                                                <span>Via Việt Live Ads</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://vlclone.com/shop/3/13">
                                                <img class="img menu" alt="" src="/images/stores/vietnamese.svg" />
                                                <span>Via Việt Die Ads</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" href="javascript:void(0);"
                                        data-link="https://vlclone.com/shop/2">
                                        <img class="img menu goto-view" alt="" src="/images/tags/facebook.svg" />
                                        <span class="goto-view">Danh sách Clone</span>
                                        <span class="arrow">
                                            <i class="arrow-icon"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="https://vlclone.com/shop/2/8">
                                                <img class="img menu" alt="" src="/images/stores/global1.svg" />
                                                <span>Clone Global</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://vlclone.com/shop/2/9">
                                                <img class="img menu" alt="" src="/images/stores/vietnamese.svg" />
                                                <span>Clone Việt Nam</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" href="javascript:void(0);"
                                        data-link="https://vlclone.com/shop/6">
                                        <img class="img menu goto-view" alt="" src="/images/tags/instagram.svg" />
                                        <span class="goto-view">Danh sách Instagram</span>
                                        <span class="arrow">
                                            <i class="arrow-icon"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="https://vlclone.com/shop/6/16">
                                                <img class="img menu" alt="" src="/images/tags/instagram2.svg" />
                                                <span>Clone Instagram</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" href="javascript:void(0);"
                                        data-link="https://vlclone.com/shop/1">
                                        <img class="img menu goto-view" alt="" src="/images/tags/outlook.svg" />
                                        <span class="goto-view">Danh sách Hotmail</span>
                                        <span class="arrow">
                                            <i class="arrow-icon"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="https://vlclone.com/shop/1/10">
                                                <img class="img menu" alt="" src="/images/tags/outlook.svg" />
                                                <span>Hotmail Live V.V</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" href="javascript:void(0);"
                                        data-link="https://vlclone.com/shop/5">
                                        <img class="img menu goto-view" alt="" src="/images/tags/gmail.svg" />
                                        <span class="goto-view">Danh sách Gmail</span>
                                        <span class="arrow">
                                            <i class="arrow-icon"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="https://vlclone.com/shop/5/14">
                                                <img class="img menu" alt="" src="/images/stores/vietnamese.svg" />
                                                <span>Gmail Việt</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://vlclone.com/shop/5/15">
                                                <img class="img menu" alt="" src="/images/stores/unitedstates.svg" />
                                                <span>Gmail US</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="https://vlclone.com/warranty_policy">
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
                            <a href="{{route('type')}}" class="auth-required">
                                <span class="icon-holder">
                                    <i class="anticon anticon-percentage" style="color:#FF6600"></i>
                                </span>
                                <span class="title">Ưu Đãi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="https://vlclone.com/histories" class="auth-required">
                                <span class="icon-holder">
                                    <i class="anticon anticon-clock-circle" style="color:#FF6600"></i>
                                </span>
                                <span class="title">Lịch Sử Giao Dịch</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="https://vlclone.com/check_live">
                                <span class="icon-holder">
                                    <i class="anticon anticon-account-book" style="color:#FF6600"></i>
                                </span>
                                <span class="title">Check Live UID</span>
                            </a>
                        </li>
                        <li class="header-nav">HỖ TRỢ</li>
                        <li class="nav-item">
                            <a href="https://vlclone.com/v1_api_docs">
                                <span class="icon-holder">
                                    <i class="anticon anticon-api" style="color:tomato"></i>
                                </span>
                                <span class="title">Tài Liệu API V1</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="https://vlclone.com/v2_api_docs">
                                <span class="icon-holder">
                                    <i class="anticon anticon-api" style="color:tomato"></i>
                                </span>
                                <span class="title">Tài Liệu API V2</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="https://vlclone.com/contact">
                                <span class="icon-holder">
                                    <i class="anticon anticon-contacts" style="color:#888888"></i>
                                </span>
                                <span class="title">Liên Hệ - Support</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="https://vlclone.com/blogs">
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


    <a href="https://www.facebook.com/hethongcloneviabm" id="linkzalo" target="_blank" rel="noopener noreferrer">
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
                    <p class="text-violet font-600 font-size-17">🔔 Update Tool Mua Hàng API</p>
                    <p><span style="color:#000000">Fix lỗi check balance</span><br />
                        <span style="color:#000000">Link dowload tool Auto Buy</span>: <a
                            href="https://www.dropbox.com/scl/fi/87ikyu1kryg4e3nqffzap/AutoBuy-VLclone.com.rar?rlkey=taiibv5qz6vycxyiokj55xzon&amp;st=fcpcsydz&amp;dl=0">Tải
                            ngay!</a><br />
                        -----------------------<br />
                        <span style="color:#ffffff"><span style="background-color:#3498db"><strong>️🎯 Update
                                    Clone:</strong></span></span><br />
                        <span style="font-family:Courier New,Courier,monospace">- Clone United States<br />
                            - Clone Australia<br />
                            - Clone Canada<br />
                            - Clone Germany&nbsp;</span><br />
                        <span style="font-family:Courier New,Courier,monospace">- Clone India</span><br />
                        Đ&atilde; load sẳn ads (ng&agrave;y tạo TKQC c&ugrave;ng ng&agrave;y reg)!
                    </p>
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

</body>

</html>
