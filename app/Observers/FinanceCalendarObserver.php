<?php

namespace App\Observers;

use App\Models\Employee;
use App\Enum\StatusActive;
use App\Models\LeaveBalance;
use function Termwind\parse;
use App\Models\FinanceCalendar;
use App\Enum\LeaveBalanceStatus;
use Illuminate\Support\Facades\Auth;

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
        if ($financeCalendar->status == StatusActive::Archive) {

            $leaveBalances  = LeaveBalance::where('finance_calendar_id', $financeCalendar->id)->where('status', LeaveBalanceStatus::Open)->get();

            foreach ($leaveBalances as $leaveBalance) {
                $leaveBalance->update(['status' => LeaveBalanceStatus::Archived]);
            }
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