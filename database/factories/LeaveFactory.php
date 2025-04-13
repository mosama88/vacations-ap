<?php

namespace Database\Factories;

use App\Models\Leave;
use App\Models\Employee;
use App\Enum\StatusActive;
use App\Models\FinanceCalendar;
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

        $lastLeaveCode = Leave::orderByDesc('leave_code')->value('leave_code');
        $newLeaveCode = $lastLeaveCode ? $lastLeaveCode + 1 : 100;

        $financial_year = FinanceCalendar::where('status', StatusActive::Active)->first();



        return [
            'leave_code' => $newLeaveCode,
            'employee_id' => Employee::all()->random()->id,
            'finance_calendar_id' => $financial_year,
        ];
    }
}
