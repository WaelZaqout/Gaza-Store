<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('customer')->attempt($credentials)) {
        session()->regenerate();
        return redirect()->route('front.index'); // توجيه للمتجر
    }

    return back()->withErrors(['email' => 'بيانات تسجيل الدخول غير صحيحة']);
}
public function logout(Request $request)
{
    Auth::guard('customer')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
}


}
