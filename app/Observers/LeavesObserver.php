<?php

namespace App\Observers;

use App\Models\Leave;
use App\Models\LeaveBalance;

class LeavesObserver
{
    /**
     * Handle the Leave "created" event.
     */
    public function created(Leave $leave): void
    {
        $employeeId = $leave->employee_id;
        $leaveBalance = LeaveBalance::where('employee_id', $employeeId)->first();
    
        if ($leaveBalance) {
            $leaveBalance->remainig_days -= $leave->days_taken;
            $leaveBalance->used_days += $leave->days_taken;
    
            $leaveBalance->save();
        }
    }
    

    /**
     * Handle the Leave "updated" event.
     */
    public function updated(Leave $leave): void
    {
        //
    }

    /**
     * Handle the Leave "deleted" event.
     */
    public function deleted(Leave $leave): void
    {
        //
    }

    /**
     * Handle the Leave "restored" event.
     */
    public function restored(Leave $leave): void
    {
        //
    }

    /**
     * Handle the Leave "force deleted" event.
     */
    public function forceDeleted(Leave $leave): void
    {
        //
    }
}