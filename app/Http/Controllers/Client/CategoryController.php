<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $products = $category->products()->paginate(12);
        $categories = Category::all();

        return view('client.category.show', compact('category', 'products', 'categories'));
    }
}
