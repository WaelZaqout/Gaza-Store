<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check() || Auth::user()->type !== $role) {
            return redirect('/login')->with('error', 'ليس لديك الصلاحية للوصول لهذه الصفحة.');
        }

        return $next($request);
    }
}
