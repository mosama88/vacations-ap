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


    public function allLeaves()
    {

        $emplyeeId = Auth::user()->id;
        $other['weeks'] = Week::where('id', $emplyeeId)->get();
        $employees = Employee::with('leaveBalance')->where('id', $emplyeeId)->first();
        $data = Leave::orderByDesc('id')->where('leave_status', "!=", LeaveStatusEnum::Pending)->paginate(10);
        return view('front.leaves.allLeaves', compact('data', 'employees', 'other'));
    }


    public function getLeavepending()
    {
        $data = Leave::orderByDesc('id')->where('leave_status', LeaveStatusEnum::Pending)->paginate(10);
        return view('front.leaves.leaves-pending', compact('data'));
    }


    public function showLeave($id)
    {
        $leave = Leave::findOrFail($id);
        return view('front.leaves.show-leave',  compact('leave'));
    }
}
