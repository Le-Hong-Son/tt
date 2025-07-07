<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderLookupController extends Controller
{
    // Hiển thị form tra cứu
    public function showForm()
    {
        return view('client.orders.lookup');
    }

    // Xử lý tra cứu
    public function lookup(Request $request)
    {
        $request->validate([
            'order_code' => 'required|numeric',
            'phone' => 'required',
        ]);

        $order = Order::where('id', $request->order_code)
            ->where('phone', $request->phone)
            ->with('orderItems.product')
            ->first();
        if (!$order) {
            return back()->with('error', 'Không tìm thấy đơn hàng. Vui lòng kiểm tra lại thông tin.');
        }

        return view('client.orders.result', compact('order'));
    }
}
