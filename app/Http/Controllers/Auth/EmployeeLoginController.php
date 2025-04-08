<?php

namespace App\Http\Controllers\Auth;

use App\Models\Employee;
use Illuminate\View\View;
use App\Enum\EmployeeStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\EmployeeLoginRequest;

class EmployeeLoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('front.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(EmployeeLoginRequest $request)
    {
        $employee = Employee::where('username', $request->username)->first();

        if (!$employee) {
            return redirect()->back()->withErrors(['error' => 'يوجد خطأ فى أسم المستخدم او كلمة المرور']);
        }

        if ($employee->status != EmployeeStatus::Active) {
            return redirect()->back()->withErrors(['error' => 'حالة الحساب غير نشطة']);
        }


        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard.employee-panel.index', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('employee')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}