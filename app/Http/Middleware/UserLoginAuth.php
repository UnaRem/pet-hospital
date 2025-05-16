<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserLoginAuth
{
    public function handle(Request $request, Closure $next)
    {
        // 登录状态下访问黑名单
        $accessUrl = [
            'UserLoginForm',
            'UserRegisterForm',
            'UserLogin',
            'UserRegister'
        ];
        // 检查用户是否已经登录
        if (session()->has('user')) {
            // 用户已登录，检查访问的URL是否在黑名单中
            if (in_array($request->route()->getName(), $accessUrl)) {
                // 如果访问的是黑名单中的URL，则重定向到首页或其他页面
                return back();
            }
        } else {
            // 用户未登录，检查访问的URL是否在黑名单中
            if (!in_array($request->route()->getName(), $accessUrl)) {
                // 如果访问的不是黑名单中的URL，则重定向到登录页面
                return redirect()->route('index', ['tab'=>'profile']);
            }
        }

        return $next($request);
    }
}
