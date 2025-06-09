<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'user') {
            return $next($request);
        }

        // Nếu không phải user thì chuyển hướng hoặc báo lỗi
        return redirect()->route('login')->with('error', 'Bạn phải đăng nhập trước.');
    }
}
