<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Order;
use App\Models\TypeCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PragmaRX\Google2FA\Google2FA;
class CustomerController extends Controller
{
    public function profile()
    {
        $customer = Auth::guard('customer')->user()->load('typeCustomer');

        $loginHistories = $customer->loginHistories()->orderBy('login_time', 'desc')->take(5)->get();

        return view('pages.profile', compact(
            'customer',
            'loginHistories',
        ));
    }
    public function indexOrder()
    {
        $customer = Auth::guard('customer')->user();
        $orders = $customer->orders()->orderBy('created_at', 'desc')->get();

        return view('pages.order', compact('orders', 'customer'));
    }

    public function indexDeposit()
    {
        $customer = Auth::guard('customer')->user();
        $deposits = Deposit::where('customer_id', $customer->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.deposit', compact('deposits', 'customer'));
    }

    public function indexOrderDetail($id)
    {
        $customer = Auth::guard('customer')->user();
        $order = Order::where('id', $id)
            ->where('customer_id', $customer->id)
            ->firstOrFail();

        $orderDetails = $order->orderDetails()->get();

        return view('pages.order_detail', compact('order', 'orderDetails', 'customer'));
    }
    public function bank()
    {
        $customer = Auth::guard('customer')->user()->load('typeCustomer');
        $banks = \App\Models\Bank::where('status', 'active')->get();

        return view('pages.checkout', compact('customer', 'banks'));
    }
    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $customer = Auth::guard('customer')->user();
        $customer->name = $request->input('name');
        $customer->save();

        return redirect()->route('profile.site')->with('success', 'Cập nhật tên thành công!');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $customer = Auth::guard('customer')->user();

        if (!Hash::check($request->old_password, $customer->password)) {
            return back()->withErrors(['old_password' => 'Mật khẩu cũ không đúng.']);
        }

        $customer->password = Hash::make($request->new_password);
        $customer->save();

        return redirect()->route('profile.site')->with('success', 'Đổi mật khẩu thành công!');
    }

    // Phương thức tạo secret key cho 2FA
    public function generate2faSecret(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        // Kiểm tra nếu người dùng đã có secret key
        if ($customer->google2fa_secret) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn đã có secret key 2FA',
            ]);
        }

        // Tạo secret key mới
        $google2fa = new Google2FA();
        $secretKey = $google2fa->generateSecretKey();

        // Lưu secret key vào session
        $request->session()->put('2fa_secret', $secretKey);

        // Tạo QR code
        $qrCodeUrl = $google2fa->getQRCodeUrl(
            'CloneVia', // Tên ứng dụng của bạn
            $customer->email, // Email người dùng
            $secretKey // Secret key
        );

        return response()->json([
            'success' => true,
            'secret' => $secretKey,
            'qrCodeUrl' => $qrCodeUrl,
        ]);
    }

    // Phương thức bật 2FA
    public function enable2fa(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        // Validate dữ liệu
        $request->validate([
            'verification_code' => 'required|string|size:6',
        ]);

        // Lấy secret key từ session
        $secretKey = $request->session()->get('2fa_secret');

        if (!$secretKey) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy secret key, vui lòng tạo lại',
            ]);
        }

        // Xác nhận mã OTP
        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey($secretKey, $request->verification_code);

        if (!$valid) {
            return response()->json([
                'success' => false,
                'message' => 'Mã xác thực không đúng, vui lòng thử lại',
            ]);
        }

        // Cập nhật dữ liệu người dùng
        $customer->google2fa_secret = $secretKey;
        $customer->is2Fa = true;
        $customer->save();

        // Xóa secret key khỏi session
        $request->session()->forget('2fa_secret');

        return response()->json([
            'success' => true,
            'message' => 'Bảo mật 2 lớp đã được bật thành công',
        ]);
    }

    // Phương thức tắt 2FA
    public function disable2fa(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        // Validate dữ liệu
        $request->validate([
            'verification_code' => 'required|string|size:6',
        ]);

        // Xác nhận mã OTP
        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey($customer->google2fa_secret, $request->verification_code);

        if (!$valid) {
            return response()->json([
                'success' => false,
                'message' => 'Mã xác thực không đúng, vui lòng thử lại',
            ]);
        }

        // Cập nhật dữ liệu người dùng
        $customer->google2fa_secret = null;
        $customer->is2Fa = false;
        $customer->save();

        return response()->json([
            'success' => true,
            'message' => 'Bảo mật 2 lớp đã được tắt thành công',
        ]);
    }
    // Add these methods to your CustomerController class
    public function show2faVerify()
    {
        return view('pages.2fa_verify');
    }

    public function verify2fa(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|string|size:6',
        ]);

        $customer = Auth::guard('customer')->user();
        $google2fa = new Google2FA();

        $valid = $google2fa->verifyKey($customer->google2fa_secret, $request->verification_code);

        if ($valid) {
            $request->session()->put('2fa_verified', true);
            return redirect()->intended(route('profile.site'));
        }

        return back()->withErrors(['verification_code' => 'Mã xác thực không đúng']);
    }

    // PostController.php
    public function indexPost()
    {
        // Lấy các genre_post đã được phân loại theo type
        $basicGuides = \App\Models\GenrePost::where('type', 'DANH SÁCH HƯỚNG DẪN CƠ BẢN')
            ->where('status', 'active')
            ->with([
                'posts' => function ($query) {
                    $query->where('status', 'active');
                }
            ])
            ->get();

        $otherTutorials = \App\Models\GenrePost::where('type', 'DANH SÁCH THỦ THUẬT KHÁC')
            ->where('status', 'active')
            ->with([
                'posts' => function ($query) {
                    $query->where('status', 'active');
                }
            ])
            ->get();

        return view('pages.post_index', compact('basicGuides', 'otherTutorials'));
    }
    // PostController.php
    public function postDetail($genreSlug, $postSlug)
    {
        // Tìm post dựa trên slug và liên kết với genre
        $post = \App\Models\Post::where('slug', $postSlug)
            ->whereHas('genrePost', function ($query) use ($genreSlug) {
                $query->where('slug', $genreSlug);
            })
            ->where('status', 'active')
            ->first();

        if (!$post) {
            abort(404);
        }

        // Tăng số lượt xem
        $post->increment('view');

        // Lấy các bài viết liên quan cùng genre
        $relatedPosts = \App\Models\Post::where('genre_post_id', $post->genre_post_id)
            ->where('id', '!=', $post->id)
            ->where('status', 'active')
            ->limit(5)
            ->get();

        return view('pages.post_detail', compact('post', 'relatedPosts'));
    }
    // PostController.php
    public function genreShow($genreSlug)
    {
        $genre = \App\Models\GenrePost::where('slug', $genreSlug)
            ->where('status', 'active')
            ->firstOrFail();

        $posts = \App\Models\Post::where('genre_post_id', $genre->id)
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.genre_posts', compact('genre', 'posts'));
    }
}
