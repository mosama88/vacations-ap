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
        $employees = Employee::with('leaveBalance')->where('id', $emplyeeId)->first();
        $data = Leave::orderByDesc('id')->where('finance_calendar_id', $financial_year->id)->where('leave_status', "!=", LeaveStatusEnum::Pending)->paginate(10);
        return view('dashboard.leaves.index', compact('data', 'employees', 'other'));
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
    public function store(LeaveRequest $request)
    {

        $financial_year = FinanceCalendar::select('id', 'finance_yr')->where('status', StatusActive::Active)->first();
        if (!$financial_year) {
            return redirect()->back()->withErrors(['error' => 'عفوآ لا يوجد سنه مالية مفتوحة!!'])->withInput();
        }

        $employeeId = Auth::id();
        $lastLeaveCode = Leave::orderByDesc('leave_code')->value('leave_code');
        $newnEwLeaveCode = $lastLeaveCode ? $lastLeaveCode + 1 : 100;

        // التحقق من صحة التواريخ
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        if ($startDate->gt($endDate)) {
            return redirect()->back()
                ->withErrors(['error' => 'تاريخ البداية يجب أن يكون قبل تاريخ النهاية'])
                ->withInput();
        }


        // التحقق من وجود إجازات متداخلة
        if ($this->hasOverlappingLeaves($employeeId, $startDate, $endDate)) {
            $existingLeave = $this->getOverlappingLeave($employeeId, $startDate, $endDate);
            $message = 'عفواً يوجد إجازة مسجلة في هذه الفترة';

            if ($existingLeave) {
                $message .= ' من ' . $existingLeave->start_date->format('Y-m-d') .
                    ' إلى ' . $existingLeave->end_date->format('Y-m-d');
            }

            return redirect()->back()
                ->withErrors(['error' => $message])
                ->withInput();
        }

        // حساب الأيام بدون الجمعة و اجازه الموظف
        $daysTaken = $this->calculateWorkingDays($startDate, $endDate, $employeeId);

        // إنشاء الإجازة
        try {
            Leave::create([
                'finance_calendar_id' => $financial_year['id'],
                'leave_code' => $newnEwLeaveCode,
                'employee_id' => $employeeId,
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


    public function update(LeaveRequest $request, $id)
    {
        $financial_year = FinanceCalendar::select('id', 'finance_yr')->where('status', StatusActive::Active)->first();
        if (!$financial_year) {
            return redirect()->back()->withErrors(['error' => 'السنه المالية غير مفعله'])->withInput();
        }

        $leave = Leave::findOrFail($id);
        $employeeId = Auth::id();

        // التحقق من صحة التواريخ
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        if ($startDate->gt($endDate)) {
            return redirect()->back()
                ->withErrors(['error' => 'تاريخ البداية يجب أن يكون قبل تاريخ النهاية'])
                ->withInput();
        }


        if ($this->hasOverlappingLeaves($employeeId, $startDate, $endDate, $leave->id)) {
            $existingLeave = $this->getOverlappingLeave($employeeId, $startDate, $endDate, $leave->id);
            $message = 'عفواً يوجد إجازة مسجلة في هذه الفترة';

            if ($existingLeave) {
                $message .= ' من ' . $existingLeave->start_date->format('Y-m-d') .
                    ' إلى ' . $existingLeave->end_date->format('Y-m-d');
            }
        }

        // حساب الأيام بدون الجمعة و اجازه الموظف
        $daysTaken = $this->calculateWorkingDays($startDate, $endDate, $employeeId);

        // إنشاء الإجازة
        try {

            // dd($request->all());

            $leave->update([
                'finance_calendar_id' => $financial_year['id'],
                'employee_id' => $employeeId,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'days_taken' => $daysTaken,
                'leave_type' => $request->leave_type,
                'leave_status' => $request->leave_status,
                'description' => $request->description,
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
    public function destroy(Leave $leave)
    {
        //
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



    private function hasOverlappingLeaves($employeeId, $startDate, $endDate, $excludeLeaveId = null): bool
    {
        $query = Leave::where('employee_id', $employeeId)
            ->where('leave_status', '<>', LeaveStatusEnum::Refused)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where(function ($q) use ($startDate, $endDate) {
                    $q->where('start_date', '<=', $endDate)
                        ->where('end_date', '>=', $startDate);
                });
            });

        if ($excludeLeaveId) {
            $query->where('id', '!=', $excludeLeaveId);
        }

        return $query->exists(); // تغيير first() إلى exists()
    }

    private function getOverlappingLeave($employeeId, $startDate, $endDate, $excludeLeaveId = null): ?Leave
    {
        $query = Leave::where('employee_id', $employeeId)
            ->where('leave_status', '<>', LeaveStatusEnum::Refused)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where(function ($q) use ($startDate, $endDate) {
                    $q->where('start_date', '<=', $endDate)
                        ->where('end_date', '>=', $startDate);
                });
            });

        if ($excludeLeaveId) {
            $query->where('id', '!=', $excludeLeaveId);
        }

        $leave = $query->first();

        if ($leave) {
            $leave->start_date = Carbon::parse($leave->start_date);
            $leave->end_date = Carbon::parse($leave->end_date);
        }

        return $leave;
    }


    private function calculateWorkingDays($startDate, $endDate, $employeeId): int
    {
        $employee = Employee::with('week')->find($employeeId);

        if (!$employee) {
            throw new \Exception("Employee not found");
        }

        // أيام العطلة الافتراضية (الجمعة)
        $weekendDays = [Carbon::FRIDAY];

        // إذا كان للموظف يوم عطلة أسبوعية مختلف
        // if ($employee->week) {
        //     // تحويل اسم اليوم إلى رقم اليوم في الأسبوع
        //     $dayName = $employee->week->name;
        //     $weekendDays[] = $this->convertArabicDayToNumber($dayName);
        // }

        $days = 0;
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        for ($date = $start; $date->lte($end); $date->addDay()) {
            if (!in_array($date->dayOfWeek, $weekendDays)) {
                $days++;
            }
        }

        return $days;
    }

    private function convertArabicDayToNumber($arabicDayName): int
    {
        $daysMap = [
            'السبت' => Carbon::SATURDAY,
            'الأحد' => Carbon::SUNDAY,
            'الأثنين' => Carbon::MONDAY,
            'الثلاثاء' => Carbon::TUESDAY,
            'الآربعاء' => Carbon::WEDNESDAY,
            'الخميس' => Carbon::THURSDAY,
            'الجمعه' => Carbon::FRIDAY,
        ];

        return $daysMap[$arabicDayName] ?? Carbon::FRIDAY;
    }
}