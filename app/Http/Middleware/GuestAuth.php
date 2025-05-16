<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GuestAuth
{

    public function handle(Request $request, Closure $next)
    {
        if (session()->has('admin')) {
            return redirect()->route('AdminDashboard');
        }
        return $next($request);
    }
}
