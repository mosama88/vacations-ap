<?php

namespace App\Http\Controllers\Front;

use App\Models\Week;
use App\Models\Leave;
use App\Models\Employee;
use App\Enum\LeaveStatusEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmployeePanel extends Controller
{
    public function index()
    {
        $employee = Auth::user()->id;
        $data = Leave::where('employee_id', $employee)->orderByDesc('id')->paginate(10);
        return view('front.index', compact('data'));
    }

    public function showLeave($id)
    {
        $leave = Leave::findOrFail($id);
        return view('front.leaves.show-leave',  compact('leave'));
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