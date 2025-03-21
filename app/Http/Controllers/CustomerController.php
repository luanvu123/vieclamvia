<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Deposit;
use App\Models\Order;
use App\Models\TypeCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PragmaRX\Google2FA\Google2FA;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{


    /**
     * Display the user's profile
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        $customer = Auth::guard('customer')->user()->load('typeCustomer');
        $loginHistories = $customer->loginHistories()->orderBy('login_time', 'desc')->take(5)->get();


        return view('pages.profile', compact(
            'customer',
            'loginHistories',
        ));
    }

    /**
     * Check for transactions in Google Apps Script and process them
     *
     * @param Customer $customer
     * @return void
     */
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
        $order = Order::where('id', $id)->firstOrFail();

        if ($order->customer_id != $customer->id) {
            abort(403, 'Bạn không có quyền truy cập đơn hàng này.');
        }

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

    /**
     * Tìm kiếm đơn hàng
     */
    public function searchOrders(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $query = Order::where('customer_id', $customer->id);

        // Tìm theo mã đơn hàng
        if ($request->filled('orderKey')) {
            $query->where('order_key', 'like', '%' . $request->orderKey . '%');
        }

        // Tìm theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Tìm theo khoảng thời gian
        if ($request->filled('dateRange')) {
            $dates = explode(' - ', $request->dateRange);
            if (count($dates) == 2) {
                $startDate = Carbon::createFromFormat('d/m/Y', $dates[0])->startOfDay();
                $endDate = Carbon::createFromFormat('d/m/Y', $dates[1])->endOfDay();
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }
        }

        $orders = $query->orderBy('created_at', 'desc')->get();

        // Chuẩn bị dữ liệu để trả về dạng JSON
        $formattedOrders = [];
        foreach ($orders as $order) {
            $status_html = '';
            if ($order->status == 'completed') {
                $status_html = '<span class="badge badge-success">Hoàn thành</span>';
            } elseif ($order->status == 'pending') {
                $status_html = '<span class="badge badge-warning">Đang xử lý</span>';
            } elseif ($order->status == 'cancelled') {
                $status_html = '<span class="badge badge-danger">Đã hủy</span>';
            } else {
                $status_html = '<span class="badge badge-secondary">' . $order->status . '</span>';
            }

            $actions = '<a href="' . route('customer.order.detail', $order->id) . '" class="btn btn-primary btn-sm"><i class="anticon anticon-eye"></i> Chi tiết</a>';

            if ($order->status == 'completed') {
                $actions .= ' <a href="#" class="btn btn-info btn-sm download-order" data-id="' . $order->id . '"><i class="anticon anticon-download"></i> Tải xuống</a>';
            }

            $formattedOrders[] = [
                'order_key' => $order->order_key,
                'created_at' => $order->created_at->format('d/m/Y H:i'),
                'product_name' => $order->product->name,
                'quantity' => $order->quantity,
                'total_price_formatted' => number_format($order->total_price) . ' VNĐ',
                'status_html' => $status_html,
                'actions' => $actions
            ];
        }

        return response()->json(['orders' => $formattedOrders]);
    }

    /**
     * Tải xuống đơn hàng
     */
    /**
     * Tải xuống đơn hàng dưới dạng txt
     */
    public function downloadOrder($id)
    {
        $customer = Auth::guard('customer')->user();
        $order = Order::where('id', $id)
            ->where('customer_id', $customer->id)
            ->where('status', 'completed')
            ->firstOrFail();

        $orderDetails = $order->orderDetails()->get();

        // Tạo nội dung file txt với mỗi dòng là UUID|Giá trị
        $content = '';
        foreach ($orderDetails as $detail) {
            $content .= $detail->uuid . '|' . $detail->value . "\n";
        }

        // Tạo response và tải xuống file
        $filename = 'don-hang-' . $order->order_key . '.txt';
        $headers = [
            'Content-Type' => 'text/plain',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        return response($content, 200, $headers);
    }
}
