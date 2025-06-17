<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;  // nhớ import model Category

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(8)->get(); // lấy 8 sản phẩm mới nhất
        $categories = Category::all(); // lấy tất cả danh mục

        return view('client.home', compact('products', 'categories'));
    }
}
