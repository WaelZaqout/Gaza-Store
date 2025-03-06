<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */

        protected function redirectTo(Request $request): ?string
        {
            // إذا كان المستخدم مسجلاً دخوله، لا يحتاج إلى إعادة التوجيه
            if (Auth::check()) {
                return null;
            }

            // إذا كان المستخدم غير مسجل دخول، قم بتوجيهه إلى صفحة تسجيل الدخول
            return route('login');
        }

    }

