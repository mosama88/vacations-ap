<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\StatusOpen;
use App\Models\Employee;
use App\Models\LeaveBalance;
use function Termwind\parse;
use Illuminate\Http\Request;
use App\Models\FinanceCalendar;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LeaveBalanceRequest;

class LeaveBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = LeaveBalance::orderByDesc('id')->paginate(10);
        return view('dashboard.leaveBalances.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $other['employees'] = Employee::get();
        return view('dashboard.leaveBalances.create', compact('other'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaveBalanceRequest $request)
    {
        $financial_year = FinanceCalendar::select('id', 'finance_yr')->where('status', StatusOpen::Open)->first();
        $leaveBalancees = $request->validated();
        $data = array_merge($leaveBalancees, [
            'finance_calendar_id' => $financial_year['id'],
            'remainig_days' => $remainig_days = $request->total_days,
            'used_days' => parse($remainig_days - $request->total_days),
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
        $other['finance_calendars'] = FinanceCalendar::get();
        return view('dashboard.leaveBalances.show', compact('leaveBalance', 'other'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveBalance $leaveBalance)
    {
        $other['employees'] = Employee::get();
        $other['finance_calendars'] = FinanceCalendar::get();

        return view('dashboard.leaveBalances.edit', compact('leaveBalance', 'other'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeaveBalanceRequest $request, LeaveBalance $leaveBalance)
    {
        $leaveBalance->fill($request->validated());
        $leaveBalance->updated_by = auth()->guard('admin')->user()->id;

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
