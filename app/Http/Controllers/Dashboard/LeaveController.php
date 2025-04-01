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

        $existingLeave = Leave::where('employee_id', $employeeId)
            ->where(function ($query) use ($request) {
                $startDate = Carbon::parse($request->start_date);
                $endDate = Carbon::parse($request->end_date);

                $query->where(function ($q) use ($startDate, $endDate) {
                    // الحالة 1: نفس تواريخ البداية والنهاية بالضبط
                    $q->where('start_date', $startDate)
                        ->where('end_date', $endDate);
                })
                    ->orWhere(function ($q) use ($startDate, $endDate) {
                        // الحالة 2: إجازة موجودة تبدأ ضمن الفترة الجديدة
                        $q->whereBetween('start_date', [$startDate, $endDate]);
                    })
                    ->orWhere(function ($q) use ($startDate, $endDate) {
                        // الحالة 3: إجازة موجودة تنتهي ضمن الفترة الجديدة
                        $q->whereBetween('end_date', [$startDate, $endDate]);
                    })
                    ->orWhere(function ($q) use ($startDate, $endDate) {
                        // الحالة 4: إجازة موجودة تحتوي الفترة الجديدة بالكامل
                        $q->where('start_date', '<', $startDate)
                            ->where('end_date', '>', $endDate);
                    });
            })
            ->first();
        if (!empty($existingLeave)) {
            return redirect()->back()->withErrors(['error' => 'عفواً يوجد إجازة مسجلة في هذه الفترة من ' . 
            $existingLeave->start_date . ' إلى ' . $existingLeave->end_date])->withInput();
        }



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
}