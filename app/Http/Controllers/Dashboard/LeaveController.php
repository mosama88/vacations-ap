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
use App\Models\Week;
use Carbon\Carbon;

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
        $other['weeks'] = Week::where('id', $emplyeeId)->get();
        $employees = Employee::with('leaveBalance')->where('id', $emplyeeId)->first();
        return view('front.leaves.create', compact('employees', 'other'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaveRequest $request)
    {
        $employeeId = Auth::user()->id;
        $lastLeave = Leave::orderByDesc('leave_code')->value('leave_code');
        $new_LeaveCode = $lastLeave ? $lastLeave + 1 : 5000;

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $daysTaken = $startDate->diffInDays($endDate) + 1;

        // dd($this->checkExists($employeeId, $request->start_date, $request->endDate));
        if ($this->checkExists($employeeId, $request->start_date, $request->endDate)) {
            return redirect()->back()->withErrors(['error' => 'عفوآ الأجازه موجود بالفعل ']);
        } else {
            $leavees = new Leave();
            $leavees->leave_code = $new_LeaveCode;
            $leavees->employee_id = $employeeId;
            $leavees->start_date = $startDate;
            $leavees->end_date = $endDate;
            $leavees->days_taken = $daysTaken;
            $leavees->leave_type = $request->leave_type;
            $leavees->leave_status = LeaveStatusEnum::Pending;
            $leavees->description = $request->description;
            $leavees->created_by  = $employeeId;

            $leavees->save();
            session()->flash('success', 'تم أضافة الأجازه بنجاح');

            return redirect()->route('leaves.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave $leave)
    {

        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $leaves = Leave::findOrFail($id);

        return view('front.leaves.edit', compact('leaves'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $leave = Leave::findOrFail($id);
        $leave->leave_status = $request->leave_status;
        $leave->updated_by = auth()->guard()->user()->id;
        $leave->update();
        session()->flash('success', 'تم تعديل الأجازه بنجاح');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave $leave)
    {
        //
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

    public function checkExists($employeeId, $dataRequestStart, $dataRequestEnd)
    {
        //
    }
}



// public function checkExists($employeeId, $dataRequestStart, $dataRequestEnd)
// {
//     // تحويل التواريخ إلى كائنات Carbon للتأكد من التنسيق الصحيح
//     $dataRequestStart = Carbon::parse($dataRequestStart);
//     $dataRequestEnd = Carbon::parse($dataRequestEnd);

//     // البحث عن الإجازات السابقة للموظف والتي تتداخل مع الإجازة الجديدة
//     $leave = Leave::where('employee_id', $employeeId)
//         ->where(function ($query) use ($dataRequestStart, $dataRequestEnd) {
//             $query->whereBetween('start_date', [$dataRequestStart, $dataRequestEnd])
//                 ->orWhereBetween('end_date', [$dataRequestStart, $dataRequestEnd])
//                 ->orWhere(function ($query) use ($dataRequestStart, $dataRequestEnd) {
//                     $query->where('start_date', '<=', $dataRequestEnd)
//                         ->where('end_date', '>=', $dataRequestStart);
//                 });
//         })
//         ->exists(); // التحقق إذا كانت توجد إجازة متداخلة

//     return $leave;
// }