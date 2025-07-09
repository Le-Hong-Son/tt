<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'items.product')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('client.order-history', compact('orders'));
    }
    public function show($id)
    {
        $order = Order::with('items.product', 'user')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('client.order-detail', compact('order'));
    }
    public function cancel(Order $order)
    {
        // if ($order->user_id !== auth()->id()) {
        //     abort(403);
        // }
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        if ($order->status !== 'pending') {
            return back()->with('error', 'Không thể hủy đơn hàng này.');
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->route('orders.history')->with('success', 'Đơn hàng đã được hủy.');
    }
    public function reorder(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if (!in_array($order->status, ['cancelled', 'shipped'])) {
            return back()->with('error', 'Chỉ có thể đặt lại đơn hàng đã hủy hoặc đã giao.');
        }

        // Đưa các sản phẩm vào giỏ hàng
        $cart = [];
        foreach ($order->items as $item) {
            $cart[$item->product_id] = [
                'name' => $item->product->name,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'image' => $item->product->image,
            ];
        }
        session()->put('cart', $cart);

        // Điều hướng đến trang thanh toán
        return redirect()->route('cart.checkout.form')->with('success', 'Vui lòng xác nhận lại đơn hàng.');
    }

}

