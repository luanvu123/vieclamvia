@extends('layout')
@section('content')
    <style>
        .profile-section {
            display: flex;
            flex-wrap: wrap;
        }

        .user-info {
            width: 100%;
            padding: 20px;
            background-color: #fff;
            flex: 0 0 30%;
        }

        @media (min-width: 768px) {
            .user-info {
                width: 30%;
            }

            .tab-container {
                width: 70%;
            }
        }

        .user-name {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 15px;
        }

        .user-details {
            margin: 15px 0;
            font-size: 14px;
        }

        .account-level {
            background-color: #eaeaea;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: bold;
        }

        .nang-cap-btn {
            background-color: #4285f4;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 15px;
            text-decoration: none;
            display: inline-block;
        }

        .tab-container {
            width: 100%;
            flex: 0 0 70%;
            padding: 20px;
        }

        .tabs {
            display: flex;
            list-style: none;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .tabs li {
            margin-right: 5px;
        }

        .tabs a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #555;
            border-radius: 4px 4px 0 0;
            transition: all 0.3s ease;
        }

        .tabs a.active {
            color: #4285f4;
            border-bottom: 2px solid #4285f4;
            font-weight: bold;
        }

        .tab-content {
            display: none;
            padding: 15px 0;
        }

        .tab-content.active {
            display: block;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .form-group.row {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            width: 100%;
        }

        label {
            margin-bottom: 5px;
            font-weight: 600;
            flex: 0 0 25%;
        }

        .form-control {
            width: 100%;
            flex: 0 0 75%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #4285f4;
            color: white;
        }

        .btn-success {
            background-color: #0acf97;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .security-info {
            background-color: #fff8dd;
            padding: 20px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .security-info h4 {
            margin-bottom: 15px;
        }

        .text-right {
            text-align: right;
        }

        .m-t-10 {
            margin-top: 10px;
        }
    </style>
    <div class="main-content" id="main-content">
        <div class="card card-body">
            <div class="profile-section">
                <div class="user-info">
                    <div class="user-name">Mã khách hàng: {{$customer->idCustomer}}</div>
                    <div class="user-details">
                        Sớ dư: <span class="total-load">{{ number_format($customer->Balance, 0, ',', '.') }} VND</span>
                    </div>
                    <div class="user-details">
                        Cấp Bậc: <span class="account-level">{{ $customer->typeCustomer->name ?? 'Chưa được phân loại' }}</span>
                    </div>
                </div>

                <div class="tab-container">
                    <ul class="tabs">
                        <li><a href="#info" class="active">Thông Tin</a></li>
                        <li><a href="#change_pass">Đổi Mật Khẩu</a></li>
                        <li><a href="#user_log">Log Tài Khoản</a></li>
                        <li><a href="#two_fa">Bảo Mật 2 Lớp</a></li>
                    </ul>

                    <div class="tab-content active" id="info">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('profile.updateName') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group row">
                                    <label for="name">Họ và Tên</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        value="{{ $customer->name }}" placeholder="Họ Tên của Bạn">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" value="{{ $customer->email }}"
                                        readonly>
                                </div>

                                <div class="form-group row">
                                    <label for="phone">Số Điện Thoại</label>
                                    <input type="text" class="form-control" id="phone" value="{{ $customer->phone }}"
                                        readonly>
                                </div>

                                <div class="form-group" style="text-align: center; width: 100%;">
                                    <button type="submit" class="btn btn-primary">CẬP NHẬT</button>
                                </div>
                            </div>
                        </form>

                    </div>

                    <div class="tab-content" id="change_pass">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('profile.updatePassword') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group row">
                                    <label for="old_password">Mật khẩu cũ</label>
                                    <input type="password" name="old_password" class="form-control" id="old_password"
                                        placeholder="Mật khẩu cũ">
                                </div>

                                <div class="form-group row">
                                    <label for="new_password">Mật khẩu mới</label>
                                    <input type="password" name="new_password" class="form-control" id="new_password"
                                        placeholder="Mật khẩu mới">
                                </div>

                                <div class="form-group row">
                                    <label for="new_password_confirmation">Xác nhận mật khẩu mới</label>
                                    <input type="password" name="new_password_confirmation" class="form-control"
                                        id="new_password_confirmation" placeholder="Nhập lại mật khẩu mới">
                                </div>

                                <div class="form-group" style="text-align: center; width: 100%;">
                                    <button type="submit" class="btn btn-primary">THAY ĐỔI</button>
                                </div>
                            </div>
                        </form>

                    </div>

                    <div class="tab-content" id="user_log">
                        <table>
                            <thead>
                                <tr>
                                    <th>Hành Động</th>
                                    <th>IP</th>
                                    <th>Trình Duyệt</th>
                                    <th>Thời gian</th>
                                    <th>Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($loginHistories as $history)
                                    <tr>
                                        <td>Đăng Nhập</td>
                                        <td>{{ request()->ip() }}</td> <!-- Lấy IP của người dùng -->
                                        <td>{{ $history->device }}</td>
                                        <td>{{ $history->login_time->format('H:i:s d/m/Y') }}</td>
                                        <td>
                                            @if($loop->first)
                                                <span style="color: #0acf97;">Hiện tại</span>
                                            @else
                                                <span style="color: #ff6b6b;">Đăng xuất</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-content" id="two_fa">
                        <div class="security-info">
                            <h4>Bảo vệ Tài khoản của bạn bằng Xác minh 2 Bước</h4>
                            <div>
                                Mỗi khi bạn Đăng nhập vào Tài khoản, Bạn sẽ cần Mật khẩu và mã xác minh OTP
                                <p>* Điều này sẽ An toàn tránh rủi ro khi Bạn bị Lộ Mật khẩu!</p>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-label"></div>
                            <div class="form-input">
                                @if ($customer->is2Fa)
                                    <button class="action-btn-pop enabled" id="disable2faBtn">Tắt</button>
                                    <span class="status-badge active">Đang bật</span>
                                @else
                                    <button class="action-btn-pop" id="enable2faBtn">Bật</button>
                                    <span class="status-badge inactive">Đang tắt</span>
                                @endif
                            </div>
                        </div>
                        <style>
                            .tfa-popup-overlay {
                                position: fixed;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                                background-color: rgba(0, 0, 0, 0.6);
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                z-index: 1000;
                            }

                            .tfa-popup-container {
                                background-color: white;
                                border-radius: 8px;
                                width: 100%;
                                max-width: 500px;
                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                            }

                            .tfa-popup-header {
                                padding: 15px 20px;
                                border-bottom: 1px solid #eee;
                            }

                            .tfa-popup-header h3 {
                                margin: 0;
                                font-size: 18px;
                            }

                            .tfa-popup-content {
                                padding: 20px;
                            }

                            .tfa-qr-code {
                                text-align: center;
                                margin: 20px 0;
                            }

                            .tfa-qr-code img {
                                max-width: 200px;
                                height: auto;
                            }

                            .tfa-secret-code {
                                font-family: monospace;
                                background-color: #f5f5f5;
                                padding: 10px;
                                border-radius: 4px;
                                text-align: center;
                                font-size: 16px;
                                letter-spacing: 2px;
                                margin: 10px 0;
                            }

                            .tfa-download {
                                text-align: center;
                                margin: 15px 0;
                            }

                            .tfa-download-btn {
                                display: inline-block;
                                padding: 8px 15px;
                                background-color: #4CAF50;
                                color: white;
                                text-decoration: none;
                                border-radius: 4px;
                            }

                            .tfa-download-icon {
                                margin-right: 5px;
                            }

                            .tfa-warning {
                                color: #f44336;
                                font-size: 14px;
                                margin: 15px 0;
                            }

                            .tfa-verification {
                                margin: 20px 0;
                            }

                            .tfa-verification-input {
                                width: 100%;
                                padding: 10px;
                                font-size: 16px;
                                border: 1px solid #ccc;
                                border-radius: 4px;
                                text-align: center;
                                letter-spacing: 5px;
                            }

                            .tfa-buttons {
                                display: flex;
                                justify-content: space-between;
                                margin-top: 20px;
                            }

                            .tfa-cancel-btn,
                            .tfa-confirm-btn {
                                padding: 10px 20px;
                                border: none;
                                border-radius: 4px;
                                cursor: pointer;
                            }

                            .tfa-cancel-btn {
                                background-color: #f5f5f5;
                                color: #333;
                            }

                            .tfa-confirm-btn {
                                background-color: #2196F3;
                                color: white;
                            }

                            .action-btn-pop.enabled {
                                background-color: #f44336;
                            }
                        </style>
                    </div>
                </div>
            </div>


            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const tabLinks = document.querySelectorAll('.tabs a');
                    const tabContents = document.querySelectorAll('.tab-content');

                    tabLinks.forEach(link => {
                        link.addEventListener('click', function (e) {
                            e.preventDefault();

                            // Remove active class from all tabs
                            tabLinks.forEach(item => item.classList.remove('active'));
                            tabContents.forEach(item => item.classList.remove('active'));

                            // Add active class to clicked tab
                            this.classList.add('active');

                            // Show corresponding tab content
                            const tabId = this.getAttribute('href');
                            document.querySelector(tabId).classList.add('active');
                        });
                    });
                });
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Get the "Bật" button
                    const enableButton = document.querySelector('.form-input .action-btn-pop');

                    // Create the popup HTML structure
                    const popupHTML = `
            <div id="tfa-popup" class="tfa-popup-overlay" style="display:none;">
                <div class="tfa-popup-container">
                    <div class="tfa-popup-header">
                        <h3>Bật bảo mật 2 lớp</h3>
                    </div>
                    <div class="tfa-popup-content">
                        <p>Sử dụng app Google Authenticator trên điện thoại của bạn và quét mã này</p>
                        <div class="tfa-qr-code">
                            <img id="tfa-qr-code-img" src="" alt="QR Code">
                        </div>
                        <p>Hoặc sử dụng chuỗi code sau để lấy mã đăng nhập</p>
                        <p class="tfa-code">(Có thể lấy mã tại ứng dụng <a href="#">Taphoammo Authenticator</a>)</p>
                        <div id="tfa-secret-code" class="tfa-secret-code"></div>
                        <div class="tfa-download">
                            <a href="#" id="download-2fa-code" class="tfa-download-btn">
                                <span class="tfa-download-icon">↓</span> Tải code 2fa
                            </a>
                        </div>
                        <p class="tfa-warning">*Lưu ý: hãy lưu lại chuỗi mã này, nếu mất bạn sẽ không thể đăng nhập vào tài khoản.</p>

                        <div class="tfa-verification">
                            <p>Nhập vào mã đăng nhập trước khi xác nhận</p>
                            <input type="text" placeholder="Mã đăng nhập 6 số" maxlength="6" class="tfa-verification-input">
                        </div>

                        <div class="tfa-buttons">
                            <button class="tfa-cancel-btn">Đóng</button>
                            <button class="tfa-confirm-btn">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </div>
            `;

                    document.body.insertAdjacentHTML('beforeend', popupHTML);

                    // Get the popup elements
                    const tfaPopup = document.getElementById('tfa-popup');
                    const cancelButton = document.querySelector('.tfa-cancel-btn');
                    const confirmButton = document.querySelector('.tfa-confirm-btn');
                    const qrCodeImg = document.getElementById('tfa-qr-code-img');
                    const secretCodeElement = document.getElementById('tfa-secret-code');
                    const downloadButton = document.getElementById('download-2fa-code');

                    // Biến lưu trữ secret key
                    let secretKey = '';

                    // Add click event listener to the "Bật" button
                    if (enableButton) {
                        enableButton.addEventListener('click', function (e) {
                            e.preventDefault();

                            // Gọi API để tạo secret key
                            fetch('/profile/2fa/generate', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content'),
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Hiển thị thông tin 2FA
                                        secretKey = data.secret;
                                        secretCodeElement.textContent = secretKey;

                                        // Tạo QR code
                                        qrCodeImg.src =
                                            'https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=' +
                                            encodeURIComponent(data.qrCodeUrl);

                                        // Hiển thị popup
                                        tfaPopup.style.display = 'flex';

                                        // Thiết lập tải xuống secret key
                                        downloadButton.setAttribute('href', 'data:text/plain;charset=utf-8,' +
                                            encodeURIComponent(secretKey));
                                        downloadButton.setAttribute('download', 'your-2fa-secret.txt');
                                    } else {
                                        alert(data.message);
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('Đã xảy ra lỗi khi tạo secret key');
                                });
                        });
                    }

                    // Add click event listener to the "Đóng" button
                    if (cancelButton) {
                        cancelButton.addEventListener('click', function () {
                            tfaPopup.style.display = 'none';
                        });
                    }

                    // Add click event listener to the "Xác nhận" button
                    if (confirmButton) {
                        confirmButton.addEventListener('click', function () {
                            const verificationCode = document.querySelector('.tfa-verification-input').value;

                            if (!verificationCode || verificationCode.length !== 6) {
                                alert('Vui lòng nhập mã xác nhận 6 số!');
                                return;
                            }

                            // Gọi API để bật 2FA
                            fetch('/profile/2fa/enable', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content'),
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    verification_code: verificationCode
                                })
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        alert(data.message);
                                        tfaPopup.style.display = 'none';

                                        // Có thể cập nhật UI để hiển thị trạng thái 2FA đã bật
                                        if (enableButton) {
                                            enableButton.textContent = 'Tắt';
                                            enableButton.classList.add('enabled');
                                        }

                                        // Reload trang
                                        window.location.reload();
                                    } else {
                                        alert(data.message);
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('Đã xảy ra lỗi khi bật 2FA');
                                });
                        });
                    }

                    // Close the popup when clicking outside of it
                    tfaPopup.addEventListener('click', function (e) {
                        if (e.target === tfaPopup) {
                            tfaPopup.style.display = 'none';
                        }
                    });
                });
            </script>
            <div id="disable-tfa-popup" class="tfa-popup-overlay" style="display:none;">
                <div class="tfa-popup-container">
                    <div class="tfa-popup-header">
                        <h3>Tắt bảo mật 2 lớp</h3>
                    </div>
                    <div class="tfa-popup-content">
                        <p>Để tắt bảo mật 2 lớp, vui lòng nhập mã xác thực từ ứng dụng Authenticator của bạn</p>

                        <div class="tfa-verification">
                            <input type="text" placeholder="Mã đăng nhập 6 số" maxlength="6"
                                class="tfa-verification-input-disable">
                        </div>

                        <div class="tfa-buttons">
                            <button class="tfa-cancel-btn-disable">Đóng</button>
                            <button class="tfa-confirm-btn-disable">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                // Thêm vào JavaScript hiện tại
                const disableButton = document.getElementById('disable2faBtn');
                const disableTfaPopup = document.getElementById('disable-tfa-popup');
                const cancelDisableButton = document.querySelector('.tfa-cancel-btn-disable');
                const confirmDisableButton = document.querySelector('.tfa-confirm-btn-disable');

                if (disableButton) {
                    disableButton.addEventListener('click', function (e) {
                        e.preventDefault();
                        disableTfaPopup.style.display = 'flex';
                    });
                }

                if (cancelDisableButton) {
                    cancelDisableButton.addEventListener('click', function () {
                        disableTfaPopup.style.display = 'none';
                    });
                }

                if (confirmDisableButton) {
                    confirmDisableButton.addEventListener('click', function () {
                        const verificationCode = document.querySelector('.tfa-verification-input-disable').value;

                        if (!verificationCode || verificationCode.length !== 6) {
                            alert('Vui lòng nhập mã xác nhận 6 số!');
                            return;
                        }

                        // Gọi API để tắt 2FA
                        fetch('/profile/2fa/disable', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'),
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                verification_code: verificationCode
                            })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert(data.message);
                                    disableTfaPopup.style.display = 'none';

                                    // Cập nhật UI
                                    if (disableButton) {
                                        disableButton.textContent = 'Bật';
                                        disableButton.classList.remove('enabled');
                                        disableButton.id = 'enable2faBtn';
                                    }

                                    // Reload trang
                                    window.location.reload();
                                } else {
                                    alert(data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Đã xảy ra lỗi khi tắt 2FA');
                            });
                    });
                }

                disableTfaPopup.addEventListener('click', function (e) {
                    if (e.target === disableTfaPopup) {
                        disableTfaPopup.style.display = 'none';
                    }
                });
            </script>
        </div>
    </div>

   
@endsection
