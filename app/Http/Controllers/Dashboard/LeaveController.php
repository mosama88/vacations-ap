<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Week;
use App\Models\Leave;
use App\Models\Employee;
use App\Enum\StatusActive;
use App\Models\LeaveBalance;
use Illuminate\Http\Request;
use App\Enum\LeaveStatusEnum;
use App\Models\FinanceCalendar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\LeaveRequest;
use App\Services\LeaveService;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $financial_year = FinanceCalendar::select('id', 'finance_yr')->where('status', StatusActive::Active)->first();

        $emplyeeId = Auth::user()->id;
        $other['weeks'] = Week::where('id', $emplyeeId)->get();
        $data = Leave::orderByDesc('id')->where('finance_calendar_id', $financial_year->id)->where('leave_status', "!=", LeaveStatusEnum::Pending)->paginate(10);
        return view('dashboard.leaves.index', compact('data', 'other', 'financial_year'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $emplyeeId = Auth::user()->id;
        $other['weeks'] = Week::where('id', $emplyeeId)->get();
        $employees = Employee::with('leaveBalance')->where('id', $emplyeeId)->first();
        return view('dashboard.leaves.create', compact('employees', 'other'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaveRequest $request, LeaveService $leaveService)
    {
        $authEmployeeAuth = Auth::user()->id;

        $employee = Employee::find($authEmployeeAuth);
        if (!$employee) {
            return redirect()->back()->withErrors(['error' => 'عفواً لا يوجد موظف بهذا ID'])->withInput();
        }

        $financial_year = $leaveService->checkFinanceCalendar($request);
        if ($financial_year instanceof \Illuminate\Http\RedirectResponse) {
            return $financial_year;
        }

        $lastLeaveCode = Leave::orderByDesc('leave_code')->value('leave_code');
        $newLeaveCode = $lastLeaveCode ? $lastLeaveCode + 1 : 100;

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        if ($startDate->gt($endDate)) {
            return redirect()->back()
                ->withErrors(['error' => 'تاريخ البداية يجب أن يكون قبل تاريخ النهاية'])
                ->withInput();
        }

        if ($leaveService->hasOverlappingLeaves($employee->id, $startDate, $endDate)) {
            $existingLeave = $leaveService->getOverlappingLeave($employee->id, $startDate, $endDate);
            $message = 'عفواً يوجد إجازة مسجلة في هذه الفترة';

            if ($existingLeave) {
                $message .= ' من ' . $existingLeave->start_date->format('Y-m-d') .
                    ' إلى ' . $existingLeave->end_date->format('Y-m-d');
            }

            return redirect()->back()->withErrors(['error' => $message])->withInput();
        }

        $daysTaken = $leaveService->calculateWorkingDays($startDate, $endDate, $employee->id);

        try {
            Leave::create([
                'finance_calendar_id' => $financial_year['id'],
                'leave_code' => $newLeaveCode,
                'employee_id' => $employee->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'days_taken' => $daysTaken,
                'leave_type' => $request->leave_type,
                'leave_status' => LeaveStatusEnum::Pending,
                'description' => $request->description,
                'created_by' => Auth::id(),
            ]);

            session()->flash('success', 'تمت إضافة الإجازة بنجاح');
            return redirect()->route('dashboard.employee-panel.index');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'حدث خطأ أثناء حفظ الإجازة: ' . $e->getMessage()])
                ->withInput();
        }
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $leave = Leave::with('employee')->findOrFail($id);
        return view('dashboard.leaves.show', compact('leave'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $leave = Leave::with('employee')->findOrFail($id);
        return view('dashboard.leaves.edit', compact('leave'));
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(LeaveRequest $request, $id, LeaveService $leaveService)
    {
        $leave = Leave::findOrFail($id);
        if ($leave->leave_status == LeaveStatusEnum::Approved) {
            return redirect()->back()->withErrors(['error' => 'لا يمكن تعديل الإجازة بعد الموافقة عليها'])->withInput();
        }

        
        $employee = Employee::find($leave->employee->id);

        if (!$employee) {
            return redirect()->back()->withErrors(['error' => 'عفواً لا يوجد موظف بهذا ID'])->withInput();
        }

        $financial_year = $leaveService->checkFinanceCalendar($request);
        if ($financial_year instanceof \Illuminate\Http\RedirectResponse) {
            return $financial_year;
        }

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        if ($startDate->gt($endDate)) {
            return redirect()->back()->withErrors(['error' => 'تاريخ البداية يجب أن يكون قبل تاريخ النهاية'])->withInput();
        }

        if ($leaveService->hasOverlappingLeaves($employee->id, $startDate, $endDate, $leave->id)) {
            $existingLeave = $leaveService->getOverlappingLeave($employee->id, $startDate, $endDate, $leave->id);
            $message = 'عفواً يوجد إجازة مسجلة في هذه الفترة';

            if ($existingLeave) {
                $message .= ' من ' . $existingLeave->start_date->format('Y-m-d') .
                    ' إلى ' . $existingLeave->end_date->format('Y-m-d');
            }

            return redirect()->back()->withErrors(['error' => $message])->withInput();
        }

        $daysTaken = $leaveService->calculateWorkingDays($startDate, $endDate, $employee->id);

        try {
            $leave->update([
                'finance_calendar_id' => $financial_year['id'],
                'employee_id' => $employee->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'days_taken' => $daysTaken,
                'leave_type' => $request->leave_type,
                'leave_status' => $request->leave_status,
                'description' => $request->description,
                'updated_by' => Auth::id(),
            ]);

            session()->flash('success', 'تم تعديل الإجازة بنجاح');
            return redirect()->route('dashboard.employee-panel.index');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'حدث خطأ أثناء حفظ الإجازة: ' . $e->getMessage()])
                ->withInput();
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave $leave, \App\Services\LeaveService $leaveService)
    {
        // التحقق من وجود الموظف
        $employee = Employee::find($leave->employee_id);
        if (!$employee) {
            return redirect()->back()->withErrors(['error' => 'عفواً لا يوجد موظف مرتبط بهذه الإجازة'])->withInput();
        }

        // التحقق من السنة المالية
        $request = new \Illuminate\Http\Request([
            'start_date' => $leave->start_date,
            'end_date' => $leave->end_date,
        ]);

        $financial_year = $leaveService->checkFinanceCalendar($request);
        if ($financial_year instanceof \Illuminate\Http\RedirectResponse) {
            return $financial_year;
        }

        // (اختياري) منع حذف الإجازة إذا كانت معتمدة
        if ($leave->leave_status == LeaveStatusEnum::Approved) {
            return redirect()->back()->withErrors(['error' => 'لا يمكن حذف الإجازة المعتمدة'])->withInput();
        }

        try {
            $leave->delete();

            session()->flash('success', 'تم حذف الإجازة بنجاح');
            return redirect()->route('dashboard.employee-panel.index');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'حدث خطأ أثناء حذف الإجازة: ' . $e->getMessage()])
                ->withInput();
        }
    }


    public function getLeavepending()
    {

        $emplyeeId = Auth::user()->id;
        $other['weeks'] = Week::where('id', $emplyeeId)->get();
        $employees = Employee::with('leaveBalance')->where('id', $emplyeeId)->first();
        $data = Leave::orderByDesc('id')->where('leave_status', LeaveStatusEnum::Pending)->paginate(10);
        return view('front.leaves.leaves-pending', compact('data', 'employees', 'other'));
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
                return response()->json(['dashboard.leave_balance' => null]);
            }
        }
    }
}