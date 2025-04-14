<?php

namespace App\Observers;

use App\Models\Employee;
use App\Enum\StatusActive;
use App\Models\LeaveBalance;
use function Termwind\parse;
use Illuminate\Http\Request;
use App\Enum\LeaveBalanceStatus;

class EmployeeObserver
{
    /**
     * Handle the Employee "created" event.
     */
    public function created(Employee $employee): void
    {
        //
    }

    /**
     * Handle the Employee "updated" event.
     */
    public function updated(Employee $employee): void
    {
        $totalDaysBalance = request()->input('total_days_balance');

        if ($employee->isDirty('total_days_balance')) {
            $leaveBalance = LeaveBalance::where('employee_id', $employee->id)->where('finance_calendar_id', StatusActive::Active)->where('status', LeaveBalanceStatus::Open)
                ->latest('id')
                ->first();

            if ($leaveBalance) {
                $leaveBalance->total_days = $employee->total_days_balance;
                $leaveBalance->remainig_days = $employee->total_days_balance;
                $leaveBalance->save();
            }
        }
    }

    /**
     * Handle the Employee "deleted" event.
     */
    public function deleted(Employee $employee): void
    {
        //
    }

    /**
     * Handle the Employee "restored" event.
     */
    public function restored(Employee $employee): void
    {
        //
    }

    /**
     * Handle the Employee "force deleted" event.
     */
    public function forceDeleted(Employee $employee): void
    {
        //
    }
}