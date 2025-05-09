<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Week;
use App\Models\Leave;
use App\Models\Employee;
use App\Enum\EmployeeType;
use App\Enum\StatusActive;
use App\Enum\LeaveTypeEnum;
use App\Models\LeaveBalance;
use Illuminate\Http\Request;
use App\Enum\LeaveStatusEnum;
use App\Services\LeaveService;
use App\Models\FinanceCalendar;
use App\Enum\LeaveBalanceStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Dashboard\LeaveRequest;

class LeaveController extends Controller
{




    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $financial_year = FinanceCalendar::select('id', 'finance_yr', 'status')->where('status', StatusActive::Active)->first();

        return view('dashboard.leaves.index', compact('financial_year'));
    }


    public function leaveByBranch()
    {
        $financial_year = FinanceCalendar::select('id', 'finance_yr', 'status')->where('status', StatusActive::Active)->first();

        return view('dashboard.leaves.leaves-by-branch', compact('financial_year'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $checkLeaveBalance = LeaveBalance::orderByDesc('total_days')->value('total_days');
        if (!$checkLeaveBalance) {
            return redirect()->back()->withErrors(['error' => 'عفوا لا يوجد رصيد أجازات للموظف']);
        }
        $emplyeeId = Auth::user()->id;
        $other['weeks'] = Week::where('id', $emplyeeId)->get();
        $leave_balance = LeaveBalance::where('employee_id', $emplyeeId)
            ->where('status', LeaveBalanceStatus::Open)
            ->first();
        $employees = Employee::with(['leaveBalance' => function ($query) {
            $query->where('status', LeaveBalanceStatus::Open);
        }])->where('id', $emplyeeId)->first();
        return view('dashboard.leaves.create', compact('employees', 'other', 'leave_balance'));
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
        if ($financial_year instanceof RedirectResponse) {
            return $financial_year;
        }

        $leave_balance = LeaveBalance::where('id', $request->leave_balance_id)->where('status', LeaveBalanceStatus::Open)->where('employee_id', $employee->id)->first();
        // dd($leave_balance);
        if (!$leave_balance) {
            return redirect()->back()->withErrors(['error' => 'عفوآ لا يوجد رصيد اجازات'])->withInput();
        }


        // في دالة store
        try {
            $leaveService->validateLeaveBalance(
                $request->leave_type,
                (int)$request->days_taken,
                $leave_balance
            );
            // باقي الكود في حالة نجاح التحقق
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
        }

        $lastLeaveCode = Leave::orderByDesc('leave_code')->value('leave_code');
        $newLeaveCode = $lastLeaveCode ? $lastLeaveCode + 1 : 100;

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        if ($leaveService->hasOverlappingLeaves($employee->id, $startDate, $endDate)) {
            $existingLeave = $leaveService->getOverlappingLeave($employee->id, $startDate, $endDate);
            $message = 'عفواً يوجد إجازة مسجلة في هذه الفترة';

            if ($existingLeave) {
                $message .= ' من ' . $existingLeave->start_date->format('Y-m-d') .
                    ' إلى ' . $existingLeave->end_date->format('Y-m-d');
            }

            return redirect()->back()->withErrors(['error' => $message])->withInput();
        }

        // $daysTaken = $leaveService->calculateWorkingDays($startDate, $endDate, $employee->id);

        $check = $this->checkDateForLeaveType($request, $leaveService);
        if ($check instanceof RedirectResponse) {
            return $check; // وقف التنفيذ هنا
        }

        try {
            $leaveInsert =  Leave::create([
                'finance_calendar_id' => $financial_year['id'],
                'leave_code' => $newLeaveCode,
                'employee_id' => $employee->id,
                'leave_balance_id' => $leave_balance->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'days_taken' => $request->days_taken,
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
        $employees = Employee::with(['leaveBalance' => function ($query) {
            $query->where('status', LeaveBalanceStatus::Open);
        }])->where('id', $leave->employee_id)->first();
        return view('dashboard.leaves.show', compact('leave', 'employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $leave = Leave::with('employee')->findOrFail($id);
        $employees = Employee::with(['leaveBalance' => function ($query) {
            $query->where('status', LeaveBalanceStatus::Open);
        }])->where('id', $leave->employee_id)->first();

        return view('dashboard.leaves.edit', compact('leave', 'employees'));
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


        $leave_balance = LeaveBalance::where('id', $leave->leave_balance_id)->where('status', LeaveBalanceStatus::Open)->first();

        if (!$leave_balance) {
            return redirect()->back()->withErrors(['error' => 'عفوآ لا يوجد رصيد اجازات'])->withInput();
        }

        // في دالة store
        try {
            $leaveService->validateLeaveBalance(
                $request->leave_type,
                (int)$request->days_taken,
                $leave_balance
            );
            // باقي الكود في حالة نجاح التحقق
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
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


        if ($leaveService->hasOverlappingLeaves($employee->id, $startDate, $endDate, $leave->id)) {
            $existingLeave = $leaveService->getOverlappingLeave($employee->id, $startDate, $endDate, $leave->id);
            $message = 'عفواً يوجد إجازة مسجلة في هذه الفترة';

            if ($existingLeave) {
                $message .= ' من ' . $existingLeave->start_date->format('Y-m-d') .
                    ' إلى ' . $existingLeave->end_date->format('Y-m-d');
            }

            return redirect()->back()->withErrors(['error' => $message])->withInput();
        }

        // $daysTaken = $leaveService->calculateWorkingDays($startDate, $endDate, $employee->id);

        $check = $this->checkDateForLeaveType($request, $leaveService);
        if ($check instanceof RedirectResponse) {
            return $check; // وقف التنفيذ هنا
        }

        try {
            $leave->update([
                'finance_calendar_id' => $financial_year['id'],
                'employee_id' => $employee->id,
                'leave_balance_id' => $leave_balance->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'days_taken' => $request->days_taken,
                'leave_type' => $request->leave_type,
                'leave_status' => $request->leave_status,
                'description' => $request->description,
                'reason_for_rejection' => $request->reason_for_rejection,
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
        $financial_year = FinanceCalendar::select('id', 'finance_yr', 'status')->where('status', StatusActive::Active)->first();
        return view('dashboard.leaves.leaves-pending', compact('financial_year'));
    }



    private function checkDateForLeaveType(Request $request, LeaveService $leaveService)
    {
        // التحقق من صلاحية الإجازة العارضة
        $isLeaveValid = $leaveService->CheckLeaveEmergancy($request->leave_type, $request->start_date);

        // التأكد من التحقق بشكل صحيح
        if (!$isLeaveValid) {
            // إذا كانت الإجازة غير صحيحة، يتم إعادة التوجيه مع رسالة خطأ
            return redirect()->back()
                ->withErrors(['error' => 'الإجازة العارضة يجب أن تكون في نفس اليوم أو في وقت سابق.'])
                ->withInput();
        }

        // التحقق من صلاحية الإجازة الأعتيادى
        $isLeaveValidRegular = $leaveService->CheckLeaveRegular($request->leave_type, $request->start_date);

        // التأكد من التحقق بشكل صحيح
        if (!$isLeaveValidRegular) {
            // إذا كانت الإجازة غير صحيحة، يتم إعادة التوجيه مع رسالة خطأ
            return redirect()->back()
                ->withErrors(['error' => 'الإجازة الأعتيادى يجب أن تكون في  وقت لاحق.'])
                ->withInput();
        }
    }
    /**
     * Update the status of the leave.
     */

    public function updateStatusLeave(Request $request, $id, LeaveService $leaveService)
    {
        $leave = Leave::findOrFail($id);
        if ($leave->leave_status == LeaveStatusEnum::Approved) {
            return redirect()->back()->withErrors(['error' => 'لا يمكن تعديل الإجازة بعد الموافقة عليها'])->withInput();
        }

        try {
            $leave->update([
                'leave_status' => $request->leave_status,
                'reason_for_rejection' => $request->reason_for_rejection,
                'updated_by' => Auth::id(),
            ]);

            session()->flash('success', 'تم تعديل الإجازة بنجاح');
            if (Auth::check() && Auth::user()->type == EmployeeType::Manager) {
                return redirect()->route('dashboard.leaves.getLeavespending');
            } else {
                return redirect()->route('dashboard.employee-panel.index');
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'حدث خطأ أثناء حفظ الإجازة: ' . $e->getMessage()])
                ->withInput();
        }
    }


    /**
     * Print the leave details.
     */
    public function printLeave($id)
    {
        $leave = Leave::findOrFail($id);
        $emplyeeId = Auth::user()->id;
        $other['weeks'] = Week::where('id', $emplyeeId)->get();
        $employees = Employee::with('leaveBalance')->where('id', $emplyeeId)->first();
        if ($leave->leave_type === LeaveTypeEnum::Emergency) {
            return view('front.leaves.print-emergency',  compact('leave', 'other', 'employees'));
        } else {
            return view('front.leaves.print-regular',  compact('leave', 'other', 'employees'));
        }
    }
}
