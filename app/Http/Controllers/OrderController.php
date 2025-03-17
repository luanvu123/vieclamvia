<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $customer = Auth::guard('customer')->user();
        $product = Product::findOrFail($request->product_id);

        if ($request->quantity > $product->quantity) {
            return response()->json(['error' => 'Số lượng mua vượt quá số lượng sản phẩm hiện có.'], 400);
        }

        $totalPrice = $product->price * $request->quantity;
        // Kiểm tra số dư của khách hàng
        if ($totalPrice > $customer->Balance) {
            return response()->json(['error' => 'Số dư tài khoản không đủ để thực hiện giao dịch này.'], 400);
        }

        // Trừ số tiền từ số dư của khách hàng
        $customer->Balance -= $totalPrice;
        $customer->save();

        // Tạo đơn hàng
        $order = Order::create([
            'customer_id' => $customer->id,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'status' => 'success',
        ]);

        // Lấy các stock cần thiết và tạo order_detail tương ứng
        $stocks = $product->stocks()->take($request->quantity)->get();

        foreach ($stocks as $stock) {
            OrderDetail::create([
                'order_id' => $order->id,
                'uuid' => $stock->uuid,
                'value' => $stock->value,
                'status' => 'success'
            ]);
            $stock->delete();
        }
        $product->updateQuantityFromStock();
        Deposit::create([
            'customer_id' => $customer->id,
            'money' => $totalPrice,
            'type' => 'mua hàng',
            'content' => 'Thanh toán thành công đơn hàng ' . $order->order_key,
            'status' => 'thành công',
        ]);

        return response()->json(['success' => 'Đơn hàng đã được tạo thành công!', 'order' => $order]);
    }
}
