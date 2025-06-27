<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function index() {
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order) {
        $order->load('items.product', 'user');
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order) {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order) {
        $request->validate(['status' => 'required']);
        $order->update(['status' => $request->status]);
        return redirect()->route('orders.index')->with('success', 'Cập nhật đơn hàng thành công!');
    }

    public function destroy(Order $order) {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Đã xóa đơn hàng!');
    }

    // Không cần store/create vì admin chỉ quản lý
}
