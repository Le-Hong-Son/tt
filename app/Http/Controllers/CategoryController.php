<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::latest()->paginate(5);
        return view('admin.categories.index', compact('categories'));
    }

    public function create() {
        return view('admin.categories.create');
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required']);
        Category::create($request->only('name', 'description'));
        return redirect()->route('categories.index')->with('success', 'Thêm danh mục thành công!');
    }

    public function show(Category $category) {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category) {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category) {
        $request->validate(['name' => 'required']);
        $category->update($request->only('name', 'description'));
        return redirect()->route('categories.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Category $category) {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Đã xóa danh mục!');
    }
}
