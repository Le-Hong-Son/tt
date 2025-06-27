<?php

namespace App\Http\Controllers;

use App\Models\Order;

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += 1;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng.');
    }
    public function index()
    {
        $cart = session('cart', []);
        return view('client.cart', compact('cart'));
    }

    public function update(Request $request)
    {
        // Lấy dữ liệu đúng cho cả form-data và JSON
        $quantities = $request->input('quantities', []);
        if (empty($quantities) && $request->isJson()) {
            $quantities = $request->json('quantities', []);
        }

        $cart = session()->get('cart', []);
        foreach ($quantities as $id => $qty) {
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = max(1, (int) $qty);
            }
        }
        session()->put('cart', $cart);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Cập nhật số lượng thành công.');
    }

    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);

            if (empty($cart)) {
                session()->forget('cart'); // Giỏ hàng rỗng, xóa key 'cart'
            } else {
                session()->put('cart', $cart); // Cập nhật lại giỏ hàng
            }
        }

        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }
    public function checkout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'payment_method' => 'required|in:cod,bank,momo',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        // Tính tổng tiền
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        // Tạo đơn hàng mới
        $order = Order::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'total' => $total,
            'status' => 'pending', // hoặc 'chờ xác nhận'
        ]);

        // Tạo các dòng order_items
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Xóa giỏ hàng
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Đặt hàng thành công!');
    }

    public function showCheckoutForm()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống, không thể đặt hàng!');
        }

        return view('client.checkout', compact('cart'));
    }


}
