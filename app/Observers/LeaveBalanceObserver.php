<?php

namespace App\Observers;

use App\Models\Employee;
use App\Enum\StatusActive;
use App\Enum\EmployeeStatus;
use App\Models\LeaveBalance;
use App\Models\FinanceCalendar;
use App\Enum\LeaveBalanceStatus;
use Illuminate\Support\Facades\Auth;

class LeaveBalanceObserver
{
    /**
     * Handle the LeaveBalance "created" event.
     */
    public function creating(LeaveBalance $leaveBalance): void
    {
        //
    }

    /**
     * Handle the LeaveBalance "updated" event.
     */
    public function updated(LeaveBalance $leaveBalance): void
    {
        //
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