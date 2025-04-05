<?php

namespace App\Observers;

use App\Models\LeaveBalance;
use App\Models\FinanceCalendar;
use App\Enum\LeaveBalanceStatus;

class FinanceCalendarObserver
{
    /**
     * Handle the FinanceCalendar "created" event.
     */
    public function created(FinanceCalendar $financeCalendar): void
    {
        //
    }

    /**
     * Handle the FinanceCalendar "updated" event.
     */
    public function updated(FinanceCalendar $financeCalendar): void
    {

        $leaveBalance = LeaveBalance::where('finance_calendar_id', $financeCalendar->id)->where('status', LeaveBalanceStatus::Open)->first();
        //السنه تم مؤرشفه
        if ($leaveBalance->status !== LeaveBalanceStatus::Archived) {

            dd($leaveBalance);
            $leaveBalance->update(['status' => LeaveBalanceStatus::Archived]);
        }
    }

    /**
     * Handle the FinanceCalendar "deleted" event.
     */
    public function deleted(FinanceCalendar $financeCalendar): void
    {
        //
    }

    /**
     * Handle the FinanceCalendar "restored" event.
     */
    public function restored(FinanceCalendar $financeCalendar): void
    {
        //
    }

    /**
     * Handle the FinanceCalendar "force deleted" event.
     */
    public function forceDeleted(FinanceCalendar $financeCalendar): void
    {
        //
    }
}