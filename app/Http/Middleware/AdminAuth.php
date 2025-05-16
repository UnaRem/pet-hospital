<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // 检查用户是否已登录
        if (!session()->has('admin')) {
            return redirect()->route('AdminLoginForm');
        }
        return $next($request);
    }
}
