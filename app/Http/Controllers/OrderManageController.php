<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderManageController extends Controller
{
    /**
     * Hiển thị danh sách Order.
     */
    public function index()
    {
        $orders = Order::with(['customer', 'product', 'orderDetails'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Hiển thị chi tiết Order.
     */
    public function show($id)
    {
        $order = Order::with(['customer', 'product', 'orderDetails'])
            ->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }
}
