<?php

namespace App\Http\Controllers\Front;

use App\Models\Week;
use App\Models\Leave;
use App\Models\Employee;
use App\Enum\StatusActive;
use App\Enum\LeaveStatusEnum;
use App\Models\FinanceCalendar;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;

class EmployeePanel extends Controller
{

    protected array $middleware = [
        'permission: الموظفين الأجازات' => ['only' => ['index']],
        'permission: طباعة الأجازات' => ['only' => ['showLeave']],
    ];



    public function index()
    {
        $financial_year = FinanceCalendar::select('id', 'finance_yr', 'status')->where('status', StatusActive::Active)->first();
        $employee = Auth::user()->id;
        $other['weeks'] = Week::where('id', $employee)->get();
        $data = Leave::where('employee_id', $employee)->orderByDesc('id')->paginate(10);
        return view('front.index', compact('data'), compact('data', 'other', 'financial_year'));
    }



    public function printLeave($id)
    {
        $leave = Leave::findOrFail($id);
        $emplyeeId = Auth::user()->id;
        $other['weeks'] = Week::where('id', $emplyeeId)->get();
        $employees = Employee::with('leaveBalance')->where('id', $emplyeeId)->first();
        return view('front.leaves.print',  compact('leave', 'other', 'employees'));
    }
}