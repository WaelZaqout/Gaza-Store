<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('admin')->attempt($credentials)) {
        session()->regenerate();
        return redirect()->route('admin.index'); // توجيه للوحة التحكم
    }

    return back()->withErrors(['email' => 'بيانات تسجيل الدخول غير صحيحة']);
}
public function logout(Request $request)
{
    Auth::guard('admin')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
}


}
