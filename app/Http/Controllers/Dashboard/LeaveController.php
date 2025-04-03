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
        $employeeId = Auth::id();

        // التحقق من صحة التواريخ
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        if ($startDate->gt($endDate)) {
            return redirect()->back()
                ->withErrors(['error' => 'تاريخ البداية يجب أن يكون قبل تاريخ النهاية'])
                ->withInput();
        }

        // توليد كود الإجازة
        $newLeaveCode = Leave::max('leave_code') + 1 ?? 5000;

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
            $leave = Leave::create([
                'leave_code' => $newLeaveCode,
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
            return redirect()->route('dashboard.leaves.create');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'حدث خطأ أثناء حفظ الإجازة: ' . $e->getMessage()])
                ->withInput();
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
        $leave->updated_by = Auth::id();
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
                return response()->json(['dashboard.leave_balance' => null]);
            }
        }
    }

    private function hasOverlappingLeaves($employeeId, $startDate, $endDate): bool
    {
        return Leave::where('employee_id', $employeeId)
            ->where('leave_status', '<>', LeaveStatusEnum::Refused)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where(function ($q) use ($startDate, $endDate) {
                    $q->where('start_date', '<=', $endDate)
                        ->where('end_date', '>=', $startDate);
                });
            })
            ->exists();
    }

    private function getOverlappingLeave($employeeId, $startDate, $endDate)
    {
        $leave = Leave::where('employee_id', $employeeId)
            ->where('leave_status', '<>', LeaveStatusEnum::Refused)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where(function ($q) use ($startDate, $endDate) {
                    $q->where('start_date', '<=', $endDate)
                        ->where('end_date', '>=', $startDate);
                });
            })
            ->first();

        // تحويل التواريخ إلى كائن Carbon إذا كانت نصوصاً
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
        if ($employee->week) {
            // تحويل اسم اليوم إلى رقم اليوم في الأسبوع
            $dayName = $employee->week->name;
            $weekendDays[] = $this->convertArabicDayToNumber($dayName);
        }
    
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