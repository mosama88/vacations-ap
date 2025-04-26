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
        //Count Branch Employees
        $branchId = Auth::user()->branch_id;
        $branch_employees = Employee::where('branch_id', $branchId)->where('status', StatusActive::Active)->count();
        //Count Pending Leaves For All Employees               
        $pendingLeaves = Leave::whereHas('employee', function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        })->where('leave_status', LeaveStatusEnum::Pending)->where('finance_calendar_id', $financial_year->id)->count();




        //Count Approved Leaves For All Employees        
        $approvedLeaves = Leave::whereHas('employee', function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        })->where('leave_status', LeaveStatusEnum::Approved)->where('finance_calendar_id', $financial_year->id)->count();


        return view('front.index',  compact('data', 'other', 'financial_year', 'branch_employees', 'pendingLeaves', 'approvedLeaves'));
    }




}