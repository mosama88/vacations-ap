<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Leave;
use App\Models\Employee;
use App\Models\LeaveBalance;
use Illuminate\Http\Request;
use App\Enum\LeaveStatusEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\LeaveRequest;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Leave::orderByDesc('id')->paginate(10);
        return view('dashboard.leaves.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $emplyeeId = Auth::user()->id;
        $employees = Employee::with('leaveBalance')->where('id', $emplyeeId)->first();
        return view('front.leaves.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaveRequest $request)
    {
        $leavees = $request->validated();
        $data = array_merge($leavees, [
            'employee_id' => Auth::user()->id,
            'leave_status' => LeaveStatusEnum::Pending,
            'created_by' => Auth::user()->id,
        ]);
        Leave::create($data);
        session()->flash('success', 'تم أضافة الأجازه بنجاح');

        return redirect()->route('leaves.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave $leave)
    {

        return view('dashboard.leaves.show', compact('leave', 'other'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave $leave)
    {

        return view('dashboard.leaves.edit', compact('leave', 'other'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeaveRequest $request, Leave $leave)
    {
        $leave->fill($request->validated());
        $leave->updated_by = auth()->guard('admin')->user()->id;

        $leave->update();
        session()->flash('success', 'تم تعديل الأجازه بنجاح');

        return redirect()->route('dashboard.leaves.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave $leave)
    {
        $leave->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف الأجازه بنجاح!'
        ]);
    }

    public function getLeaveBalance(Request $request)
    {
        if ($request->ajax()) {
            $employee_id = $request->employee_id;
            $leave_balance = LeaveBalance::select('total_days', 'used_days', 'remainig_days')
                ->where('employee_id', $employee_id)
                ->orderBy('id', 'desc')
                ->first();  // فقط أول سجل للحصول على البيانات المطلوبة

            // التأكد من أن البيانات موجودة وإرجاعها بتنسيق JSON
            if ($leave_balance) {
                return response()->json([
                    'leave_balance' => $leave_balance
                ]);
            } else {
                return response()->json(['leave_balance' => null]);
            }
        }
    }
}
