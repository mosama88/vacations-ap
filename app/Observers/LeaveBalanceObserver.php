<?php

namespace App\Observers;

use App\Enum\StatusActive;
use App\Models\LeaveBalance;
use App\Models\FinanceCalendar;
use App\Enum\LeaveBalanceStatus;

class LeaveBalanceObserver
{
    /**
     * Handle the LeaveBalance "created" event.
     */
    public function created(LeaveBalance $leaveBalance): void
    {
        //
    }

    /**
     * Handle the LeaveBalance "updated" event.
     */
    public function updated(LeaveBalance $leaveBalance): void
    {
        // Check if the related FinanceCalendar is archived
        $isCalendarArchived = FinanceCalendar::where('id', $leaveBalance->finance_calendar_id)
            ->where('status', StatusActive::Archive)
            ->exists(); // Using exists() is more efficient than first() for this check

        if ($isCalendarArchived && $leaveBalance->status !== LeaveBalanceStatus::Archived) {
            // Use updateQuietly to prevent recursive observer calls
            $leaveBalance->updateQuietly(['status' => LeaveBalanceStatus::Archived]);
        }
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