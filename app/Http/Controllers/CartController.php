<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
}
