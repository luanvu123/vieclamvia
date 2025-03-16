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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'phone' => 'required|string|max:20|unique:customers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
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

        return response()->json(['message' => 'Đăng ký thành công!']);
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {

              // Lưu lịch sử đăng nhập
            \App\Models\LoginHistory::create([
                'customer_id' => Auth::guard('customer')->id,
                'device' => $request->header('User-Agent'),
            ]);
           return redirect()->route('profile.site')->with('success', 'Xin chào, ' . Auth::guard('customer')->email);
        }

        return response()->json(['message' => 'Thông tin đăng nhập không chính xác!'], 401);
    }

    public function logout()
    {
        Auth::guard('customer')->logout();

        return response()->json(['message' => 'Đăng xuất thành công!']);
    }
}
