<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOrEmployeeGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // التحقق من أن المستخدم إما مدير أو موظف مسجل دخوله
        if (Auth::guard('admin')->check() || Auth::guard('employee')->check()) {
            return $next($request);
        }

        // إذا لم يكن أي منهما، يتم إعادة توجيهه للصفحة الرئيسية
        return redirect('/')->with('error', 'غير مصرح بالوصول، يرجى تسجيل الدخول');
    }
}