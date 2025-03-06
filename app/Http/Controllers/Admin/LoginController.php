<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('fron.index');
        }
    }

    return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة']);
}

    public function authenticated(Request $request, $user)
    {
        if ($user->type === 'admin') {
            return redirect()->route('admin.index'); // توجيه المشرف إلى لوحة التحكم
        }

        return redirect()->route('front.index'); // توجيه المستخدم العادي إلى المتجر
    }
}


