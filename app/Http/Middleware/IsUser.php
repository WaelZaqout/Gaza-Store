<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsUser
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('customer')->check()) {
            return $next($request);
        }
        return redirect('/login')->with('error', 'يجب تسجيل الدخول كعميل للوصول لهذه الصفحة.');
    }

}
