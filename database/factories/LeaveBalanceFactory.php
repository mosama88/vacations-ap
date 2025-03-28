<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

use function Termwind\parse;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveBalance>
 */
class LeaveBalanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // تحديد الأيام الإجمالية
        $total_days = fake()->randomElement([21, 30, 45]);

        // حساب الأيام المتبقية والأيام المستخدمة
        $remainig_days = $total_days;
        $used_days = $total_days - $remainig_days; // الأيام المستخدمة هي الفرق بين الأيام الإجمالية والأيام المتبقية

        return [
            'employee_id' => Employee::inRandomOrder()->first()->id,
            'finance_calendar_id' => 1,
            'total_days' => $total_days,
            'remainig_days' => $remainig_days,
            'used_days' => $used_days, // لا نحتاج إلى دالة parse() هنا
        ];
    }
}
