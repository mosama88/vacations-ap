<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\FinanceCalendar;
use App\Models\Leave;
use App\Enum\LeaveStatusEnum;
use App\Enum\LeaveTypeEnum;
use App\Enum\StatusActive;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeaveService
{


    public function hasOverlappingLeaves($employeeId, $startDate, $endDate, $excludeLeaveId = null): bool
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

    public function getOverlappingLeave($employeeId, $startDate, $endDate, $excludeLeaveId = null): ?Leave
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


    public function calculateWorkingDays($startDate, $endDate, $employeeId): int
    {
        $employee = Employee::with('week')->find($employeeId);

        if (!$employee) {
            throw new \Exception("Employee not found");
        }

        // أيام العطلة الافتراضية (الجمعة)
        // $weekendDays = [Carbon::FRIDAY];

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
            if ($date->dayOfWeek) {
                $days++;
            }
        }

        return $days;
    }

    public function convertArabicDayToNumber($arabicDayName): int
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

    // تعديل function:
    public function checkFinanceCalendar(Request $request)
    {
        $financial_year = FinanceCalendar::where('status', StatusActive::Active)->first();

        if (!$financial_year) {
            return redirect()->back()->withErrors(['error' => 'عفوآ لا يوجد سنة مالية مفتوحة!!'])->withInput();
        }

        if (
            $request->start_date < $financial_year->start_date ||
            $request->end_date > $financial_year->end_date
        ) {
            return redirect()->back()->withErrors(['error' => 'عفواً، الإجازة خارج نطاق السنة المالية المفعلة'])->withInput();
        }

        return $financial_year; // يرجّع السنة المالية لو كل حاجة تمام
    }



    public function validateLeaveBalance($leaveType, $requestedDays, $leaveBalance)
    {
        if (!$leaveBalance) {
            throw new \Exception('لا يوجد رصيد إجازات متاح');
        }
        $balances = [
            LeaveTypeEnum::Annual->value => ['field' => 'remainig_days', 'name' => 'الإجازة السنوية'],
            LeaveTypeEnum::Sick->value => ['field' => 'remainig_days_sick', 'name' => 'الإجازة المرضية'],
            LeaveTypeEnum::Emergency->value => ['field' => 'remainig_days_emergency', 'name' => 'الإجازة العارضة'],
        ];


        $field = $balances[$leaveType]['field'] ?? 'remainig_days';
        $name = $balances[$leaveType]['name'] ?? 'الإجازة';

        $remaining = $leaveBalance->$field;

        if ($remaining <= 0 || $requestedDays > $remaining) {
            throw new \Exception("لا يوجد رصيد كافي من $name. الرصيد المتبقي: $remaining");
        }

        return true;
    }


    public function CheckLeaveEmergancy($leaveType, $startDate)
    {
        // تحقق إذا كانت الإجازة العارضة وتاريخ البدء في المستقبل
        if ($leaveType == 1 && Carbon::parse($startDate)->gt(Carbon::now()->endOfDay())) {
            return false; // إرجاع false يعني أن التاريخ في المستقبل
        }
        return true; // التاريخ صحيح (في نفس اليوم أو في تاريخ سابق)
    }


    public function CheckLeaveRegular($leaveType, $startDate)
    {
        // تحقق إذا كانت الإجازة العارضة وتاريخ البدء في المستقبل
        if ($leaveType == 2 && Carbon::parse($startDate)->gt(Carbon::now()->endOfDay())) {
            return true; // إرجاع false يعني أن التاريخ في المستقبل
        }
        return false; // التاريخ صحيح (في نفس اليوم أو في تاريخ سابق)
    }
    
}