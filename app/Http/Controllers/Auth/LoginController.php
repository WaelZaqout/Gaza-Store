<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected function redirectTo()
    {
        if (Auth::check()) {
            if (Auth::user()->type == 'admin') {
                return route('admin.index'); // تأكد أن هذا المسار موجود في `web.php`
            } else {
                return route('front.index'); // تأكد أن هذا المسار موجود أيضًا
            }
        }
        return '/login';
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended($this->redirectTo('front.index')); // سيتم توجيه المستخدم بناءً على `redirectTo()`
        }

        return back()->withErrors(['email' => 'بيانات تسجيل الدخول غير صحيحة']);
    }

public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
}

}
