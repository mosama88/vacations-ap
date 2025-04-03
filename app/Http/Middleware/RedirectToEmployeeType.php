<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Enum\EmployeeType;

class RedirectToEmployeeType
{
    public function handle(Request $request, Closure $next): Response
    {
        // إذا كان المستخدم موظفًا مسجل الدخول
        if (Auth::guard('employee')->check()) {
            $user = Auth::guard('employee')->user();

            // إذا كان المدير يحاول الوصول إلى صفحة موظف عادي
            if ($user->type == EmployeeType::Manager && $request->routeIs('dashboard.employee-panel.index')) {
                return redirect()->route('employee-panel.manager');
            }
            // إذا كان موظف عادي يحاول الوصول إلى صفحة المدير
            elseif ($user->type != EmployeeType::Manager && $request->routeIs('employee-panel.manager')) {
                return redirect()->route('dashboard.employee-panel.index');
            }
        }

        return $next($request);
    }
}
