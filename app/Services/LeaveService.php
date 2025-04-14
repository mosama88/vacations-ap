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

    // تعديل الفنكشن:
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

        switch ($leaveType) {
            case LeaveTypeEnum::Annual:
                if ($leaveBalance->remainig_days <= 0 || $requestedDays > $leaveBalance->remainig_days) {
                    throw new \Exception('لا يوجد رصيد كافي من الإجازة السنوية. الرصيد المتبقي: ' . $leaveBalance->remainig_days);
                }
                break;

            case LeaveTypeEnum::Sick:
                if ($leaveBalance->remainig_days_sick <= 0 || $requestedDays > $leaveBalance->remainig_days_sick) {
                    throw new \Exception('لا يوجد رصيد كافي من الإجازة المرضية. الرصيد المتبقي: ' . $leaveBalance->remainig_days_sick);
                }
                break;

            case LeaveTypeEnum::Emergency:
                if ($leaveBalance->remainig_days_emergency <= 0 || $requestedDays > $leaveBalance->remainig_days_emergency) {
                    throw new \Exception('لا يوجد رصيد كافي من الإجازة العارضة. الرصيد المتبقي: ' . $leaveBalance->remainig_days_emergency);
                }
                break;

            default:
                if ($leaveBalance->remainig_days <= 0 || $requestedDays > $leaveBalance->remainig_days) {
                    throw new \Exception('لا يوجد رصيد كافي من الإجازة. الرصيد المتبقي: ' . $leaveBalance->remainig_days);
                }
        }

        return true;
    }
}