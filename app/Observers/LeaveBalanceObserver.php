<?php

namespace App\Observers;

use App\Models\Employee;
use App\Enum\StatusActive;
use App\Models\LeaveBalance;
use App\Models\FinanceCalendar;
use App\Enum\LeaveBalanceStatus;
use Illuminate\Support\Facades\Auth;

class LeaveBalanceObserver
{
    /**
     * Handle the LeaveBalance "created" event.
     */
    public function created(LeaveBalance $leaveBalance): void
    {

        $financeCalendar = FinanceCalendar::select('id', 'finance_yr')->where('status', StatusActive::Active)->first();

        // احضار جميع الموظفين النشطين
        $employees = Employee::where('status', 1)->get();


            $total_days = 30;
            $total_days_emergency = 7;


            foreach ($employees as $employee) {
                LeaveBalance::create([
                    'employee_id' => $employee->id,
                    'total_days' => $total_days,
                    'finance_calendar_id' => $financeCalendar->id,
                    'remainig_days' => $total_days,
                    'used_days' => 0,
                    'total_days_emergency' => $total_days_emergency,
                    'remainig_days_emergency' => $total_days_emergency,
                    'used_days_emergency' => 0,
                    'status' => LeaveBalanceStatus::Open,
                    'created_by' => Auth::id(),
                ]);
            }
        
    }

    /**
     * Handle the LeaveBalance "updated" event.
     */
    public function updated(LeaveBalance $leaveBalance): void
    {
        // // Check if the related FinanceCalendar is archived
        // $isCalendarArchived = FinanceCalendar::where('id', $leaveBalance->finance_calendar_id)
        //     ->where('status', StatusActive::Archive)
        //     ->exists(); // Using exists() is more efficient than first() for this check

        // if ($isCalendarArchived && $leaveBalance->status !== LeaveBalanceStatus::Archived) {
        //     // Use updateQuietly to prevent recursive observer calls
        //     $leaveBalance->updateQuietly(['status' => LeaveBalanceStatus::Archived]);
        // }
    }

    /**
     * Handle the LeaveBalance "deleted" event.
     */
    public function deleted(LeaveBalance $leaveBalance): void
    {
        //
    }

    /**
     * Handle the LeaveBalance "restored" event.
     */
    public function restored(LeaveBalance $leaveBalance): void
    {
        //
    }

    /**
     * Handle the LeaveBalance "force deleted" event.
     */
    public function forceDeleted(LeaveBalance $leaveBalance): void
    {
        //
    }
}