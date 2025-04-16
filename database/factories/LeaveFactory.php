<?php

namespace Database\Factories;

use App\Models\Leave;
use App\Models\Employee;
use App\Enum\StatusActive;
use App\Enum\LeaveTypeEnum;
use App\Models\LeaveBalance;
use App\Enum\LeaveStatusEnum;
use App\Models\FinanceCalendar;
use App\Enum\LeaveBalanceStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Leave>
 */
class LeaveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $leave  = new Leave();
        // الحصول على السنة المالية النشطة
        $financial_year = FinanceCalendar::where('status', StatusActive::Active)->first();

        // إنشاء تواريخ البداية والنهاية
        $startDate = fake()->dateTimeBetween('-11 months', 'now');
        $endDate = clone $startDate;
        $endDate->modify('+4 days');  // تعديل endDate ليكون 4 أيام بعد startDate

        // حساب الأيام
        $daysTaken = $startDate->diff($endDate)->days;

        // اختيار موظف عشوائي
        $employee = Employee::all()->random();

        // الحصول على سجل رصيد الإجازة للموظف
        $leaveBalance = LeaveBalance::where('employee_id', $employee->id)
            ->where('status', LeaveBalanceStatus::Open)
            ->first();

        // إذا وجد رصيد الإجازة
        if ($leaveBalance) {
            // تحديد نوع الخصم حسب نوع الإجازة
            if ($leave->leave_type == LeaveTypeEnum::Emergency) {
                // خصم الأيام من الإجازات الطارئة
                $leaveBalance->remainig_days_emergency -= $daysTaken;
                $leaveBalance->used_days_emergency += $daysTaken;
            } else {
                // خصم الأيام من الإجازات العادية
                $leaveBalance->remainig_days -= $daysTaken;
                $leaveBalance->used_days += $daysTaken;
            }

            // حفظ التعديلات في رصيد الإجازات
            $leaveBalance->save();
        }


        // إرجاع بيانات الإجازة
        return [
            'leave_code' => fake()->unique()->numberBetween(200, 90000),
            'employee_id' => $employee->id,
            'finance_calendar_id' => $financial_year ? $financial_year->id : null,
            'leave_balance_id' => $leaveBalance ? $leaveBalance->id : null,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'days_taken' => $daysTaken,
            'leave_type' => fake()->numberBetween(1, 4),
            'leave_status' => fake()->numberBetween(1, 3),
            'description' => fake()->paragraph(1),
            'reason_for_rejection' => fake()->paragraph(1),
            'created_by' => $employee->id,
        ];
    }
}