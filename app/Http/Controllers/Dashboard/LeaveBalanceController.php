<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\StatusOpen;
use App\Models\Employee;
use App\Enum\StatusActive;
use App\Models\LeaveBalance;
use function Termwind\parse;
use Illuminate\Http\Request;
use App\Models\FinanceCalendar;
use App\Enum\LeaveBalanceStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\LeaveBalanceRequest;

class LeaveBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = LeaveBalance::where('status', LeaveBalanceStatus::Open)->orderByDesc('id')->paginate(10);
        return view('dashboard.leaveBalances.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $other['employees'] = Employee::whereDoesntHave('leaveBalance')->get();
        return view('dashboard.leaveBalances.create', compact('other'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaveBalanceRequest $request)
    {
        $financial_year = FinanceCalendar::select('id', 'finance_yr')->where('status', StatusActive::Active)->first();
        if (!$financial_year) {
            return redirect()->back()->withErrors(['error' => 'عفوآ لا يوجد سنه مالية مفتوحة!!'])->withInput();
        }
        $checkExists = LeaveBalance::where('employee_id', $request->employee_id)->exists();
        if ($checkExists) {
            return redirect()->back()->withErrors(['error' => 'الموظف مسجل من قبل'])->withInput();
        }
        $total_days_emergency = 7;
        $leaveBalancees = $request->validated();
        $data = array_merge($leaveBalancees, [
            'finance_calendar_id' => $financial_year['id'],
            'remainig_days' => $remainig_days = $request->total_days,
            'used_days' => parse($remainig_days - $request->total_days),
            'total_days_emergency' => $total_days_emergency,
            'remainig_days_emergency' => $remainig_days_emergency = $total_days_emergency,
            'used_days_emergency' => parse($remainig_days_emergency - $total_days_emergency),
            'status' => LeaveBalanceStatus::Open,
            'created_by' => Auth::user()->id,
        ]);

        LeaveBalance::create($data);
        session()->flash('success', 'تم أضافة رصيد أجازات الموظف بنجاح');

        return redirect()->route('dashboard.leaveBalances.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaveBalance $leaveBalance)
    {
        $other['employees'] = Employee::get();
        return view('dashboard.leaveBalances.show', compact('leaveBalance', 'other'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveBalance $leaveBalance)
    {
        $other['employees'] = Employee::get();
        return view('dashboard.leaveBalances.edit', compact('leaveBalance', 'other'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeaveBalanceRequest $request, LeaveBalance $leaveBalance)
    {
        $financial_year = FinanceCalendar::select('id', 'finance_yr')->where('status', StatusActive::Active)->first();
        if (!$financial_year) {
            return redirect()->back()->withErrors(['error' => 'السنه المالية غير مفعله'])->withInput();
        }
        $checkExists = LeaveBalance::where('employee_id', $request->employee_id)->where('id', "!=", $leaveBalance->id)->exists();
        if ($checkExists) {
            return redirect()->back()->withErrors(['error' => 'الموظف مسجل من قبل'])->withInput();
        }

        $leaveBalance->fill($request->validated());
        $leaveBalance->finance_calendar_id = $financial_year['id'];
        $leaveBalance->total_days = $request->total_days;
        $leaveBalance->remainig_days = parse($request->total_days - $request->used_days);
        $leaveBalance->used_days = parse($request->total_days - $request->remainig_days);

        $leaveBalance->update();
        session()->flash('success', 'تم تعديل رصيد أجازات الموظف بنجاح');

        return redirect()->route('dashboard.leaveBalances.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveBalance $leaveBalance)
    {
        $leaveBalance->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف رصيد أجازات الموظف بنجاح!'
        ]);
    }
}