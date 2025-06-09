<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Chưa đăng nhập => chuyển đến login
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập trước.');
        }

        if (Auth::user()->role !== 'admin') {
            // Nếu không phải admin => báo lỗi
            return redirect('/')->with('error', 'Bạn không có quyền truy cập vào trang admin.');
        }

        return $next($request);
    }
}
