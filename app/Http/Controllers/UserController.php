<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Danh sách user
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Hiển thị form tạo mới
    public function create()
    {
        return view('admin.users.create');
    }

    // Lưu user mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        return redirect()->route('users.index')->with('success', 'Tạo user thành công!');
    }

    // Hiển thị chi tiết
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    // Hiển thị form sửa
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Lưu sửa user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required'
        ]);
        $user->update([
            'name' => $request->name,
            'role' => $request->role
        ]);
        return redirect()->route('users.index')->with('success', 'Cập nhật thành công!');
    }

    // Xóa user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Đã xóa user!');
    }
}
