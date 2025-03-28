<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectEmployeePanel
{
    public function handle(Request $request, Closure $next): Response
    {
        // إذا كان المستخدم موظفاً مسجلاً دخوله
        if (Auth::guard('employee')->check()) {
            // إذا حاول الوصول إلى صفحة الدخول أو الصفحة الرئيسية
            if ($request->is('login') || $request->is('/')) {
                return redirect()->route('employee-panel.index');
            }
        }
        // إذا كان زائراً ويحاول الوصول إلى لوحة الموظفين
        elseif ($request->is('employee-panel*') || $request->is('/')) {
            return redirect()->route('employees.login');
        }

        return $next($request);
    }
}