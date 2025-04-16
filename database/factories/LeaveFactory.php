<?php

namespace Database\Factories;

use App\Models\Leave;
use App\Models\Employee;
use App\Enum\StatusActive;
use App\Models\LeaveBalance;
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

        $lastLeaveCode = Leave::orderByDesc('leave_code')->value('leave_code');
        $newLeaveCode = $lastLeaveCode ? $lastLeaveCode + 1 : 100;

        $financial_year = FinanceCalendar::where('status', StatusActive::Active)->first();
        $startDate = fake()->dateTimeBetween('-11 months', 'now');
        $endDate = fake()->dateTimeBetween($startDate, 'now');

        $daysTaken = $startDate->diff($endDate)->days; // Get the number of days between startDate and endDate


        return [
            'leave_code' => fake()->unique()->numberBetween(200, 90000),
            'employee_id' => $employee = Employee::all()->random()->id,
            'finance_calendar_id' => $financial_year,
            'leave_balance_id' => leaveBalance::all()->random()->id,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'days_taken' => $daysTaken,
            'leave_type' => fake()->numberBetween(1, 4),
            'leave_status' => fake()->numberBetween(1, 3),
            'description' => fake()->paragraph(1),
            'reason_for_rejection' => fake()->paragraph(1),
            'created_by' => $employee,
        ];
    }
}