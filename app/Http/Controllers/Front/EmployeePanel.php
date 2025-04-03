<?php

namespace App\Http\Controllers\Front;

use App\Models\Leave;
use Illuminate\Http\Request;
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
        $data = Leave::orderByDesc('id')->where('leave_status', "!=", LeaveStatusEnum::Pending)->paginate(10);
        return view('front.leaves.allLeaves', compact('data'));
    }


    public function getLeavepending()
    {
        $data = Leave::orderByDesc('id')->where('leave_status', LeaveStatusEnum::Pending)->paginate(10);
        return view('front.leaves.leaves-pending', compact('data'));
    }
}