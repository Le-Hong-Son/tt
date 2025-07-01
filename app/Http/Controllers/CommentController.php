<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['user', 'product'])->latest()->paginate(10);
        return view('admin.comments.index', compact('comments'));
    }

    // Form thêm bình luận
    public function create()
    {
        $products = Product::all();
        $users = User::all();
        return view('admin.comments.create', compact('products', 'users'));
    }

    // Lưu bình luận mới
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string|max:1000',
        ]);

        Comment::create($request->all());

        return redirect()->route('admin.comments.index')->with('success', 'Đã thêm bình luận.');
    }

    // Form sửa bình luận
    public function edit(Comment $comment)
    {
        $products = Product::all();
        $users = User::all();
        return view('admin.comments.edit', compact('comment', 'products', 'users'));
    }

    // Cập nhật bình luận
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string|max:1000',
        ]);

        $comment->update($request->all());

        return redirect()->route('admin.comments.index')->with('success', 'Đã cập nhật bình luận.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments.index')->with('success', 'Đã xóa bình luận thành công.');
    }
}
