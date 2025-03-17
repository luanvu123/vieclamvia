<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerAuthController extends Controller
{
 public function register(Request $request)
{
    $messages = [
        'name.required' => 'Họ và Tên là bắt buộc.',
        'email.required' => 'Email là bắt buộc.',
        'email.email' => 'Định dạng email không hợp lệ.',
        'email.unique' => 'Email này đã được sử dụng.',
        'phone.required' => 'Số điện thoại là bắt buộc.',
        'phone.unique' => 'Số điện thoại này đã được sử dụng.',
        'password.required' => 'Mật khẩu là bắt buộc.',
        'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
    ];

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:customers',
        'phone' => 'required|string|max:20|unique:customers',
        'password' => 'required|string|min:8|confirmed',
    ], $messages);

    if ($validator->fails()) {
        $errors = $validator->errors()->all();
        session()->flash('errors', $errors); // Truyền lỗi qua session
        return redirect()->back()->withInput();
    }

    $customer = Customer::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        'idCustomer' => Customer::generateUniqueId(),
        'Status' => 1,
    ]);

    Auth::guard('customer')->login($customer);

    session()->flash('success', 'Đăng ký thành công!'); // Flash message thành công
    return redirect()->back();
}




  public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('customer')->attempt($credentials)) {
        // Lưu lịch sử đăng nhập
        \App\Models\LoginHistory::create([
            'customer_id' => Auth::guard('customer')->id(),
            'device' => $request->header('User-Agent'),
        ]);

        session()->flash('success', 'Xin chào, ' . Auth::guard('customer')->user()->email); // Thông báo thành công
        return redirect()->route('profile.site');
    }

    session()->flash('error', 'Thông tin đăng nhập không chính xác!'); // Thông báo lỗi khi đăng nhập sai
    return redirect()->back();
}


    public function logout()
    {
        Auth::guard('customer')->logout();

         return redirect()->route('/')->with('success', 'Đã đăng xuất');
    }
}
