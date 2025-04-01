<?php

namespace App\Observers;

use App\Models\Leave;
use App\Enum\LeaveTypeEnum;
use App\Models\LeaveBalance;
use App\Enum\LeaveStatusEnum;

class LeavesObserver
{
    /**
     * Handle the Leave "created" event.
     */
    public function created(Leave $leave): void
    {
        //
    }


    /**
     * Handle the Leave "updated" event.
     */
    public function updated(Leave $leave): void
    {
        $employeeId = $leave->employee_id;
        $leaveBalance = LeaveBalance::where('employee_id', $employeeId)->first();
        if ($leave->leave_status == LeaveStatusEnum::Approved && $leave->leave_type !== LeaveTypeEnum::Emergency) {

            if ($leaveBalance) {
                $leaveBalance->remainig_days -= $leave->days_taken; //10-2 =8
                $leaveBalance->used_days += $leave->days_taken; //10+2=12

                $leaveBalance->save();
            }
        }

        if ($leave->leave_status == LeaveStatusEnum::Approved && $leave->leave_type == LeaveTypeEnum::Emergency) {

            if ($leaveBalance) {
                $leaveBalance->remainig_days_emergency -= $leave->days_taken; //10-2 =8
                $leaveBalance->used_days_emergency += $leave->days_taken; //10+2=12

                $leaveBalance->save();
            }
        }
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












// public function created(Leave $leave): void
//     {
//         // Only process if the leave is approved
//         if ($leave->leave_status !== LeaveStatusEnum::Approved) {
//             return;
//         }

//         $leaveBalance = LeaveBalance::where('employee_id', $leave->employee_id)->first();

//         if ($leaveBalance) {
//             $leaveBalance->remaining_days -= $leave->days_taken;
//             $leaveBalance->used_days += $leave->days_taken;
//             $leaveBalance->save();
//         }
//     }

//     /**
//      * Handle the Leave "updated" event.
//      */
//     public function updated(Leave $leave): void
//     {
//         // تحقق أولاً إذا كان الحقل leave_status قد تغير
//         if (!$leave->isDirty('leave_status')) {
//             return;
//         }

//         // ثم تحقق إذا كانت القيمة الجديدة Approved
//         if ($leave->leave_status !== LeaveStatusEnum::Approved) {
//             return;
//         }

//         $originalDaysTaken = $leave->getOriginal('days_taken');
//         $daysDifference = $leave->days_taken - $originalDaysTaken;

//         $leaveBalance = LeaveBalance::where('employee_id', $leave->employee_id)->first();

//         if ($leaveBalance) {
//             $leaveBalance->remaining_days -= $daysDifference;
//             $leaveBalance->used_days += $daysDifference;
//             $leaveBalance->save();
//         }
//     }

//     /**
//      * Handle the Leave "deleted" event.
//      */
//     public function deleted(Leave $leave): void
//     {
//         // Only process if the leave was approved
//         if ($leave->leave_status !== LeaveStatusEnum::Approved) {
//             return;
//         }

//         $leaveBalance = LeaveBalance::where('employee_id', $leave->employee_id)->first();

//         if ($leaveBalance) {
//             $leaveBalance->remaining_days += $leave->days_taken;
//             $leaveBalance->used_days -= $leave->days_taken;
//             $leaveBalance->save();
//         }
//     }


//     /**
//      * Handle the Leave "restored" event.
//      */
//     public function restored(Leave $leave): void
//     {
//         //
//     }

//     /**
//      * Handle the Leave "force deleted" event.
//      */
//     public function forceDeleted(Leave $leave): void
//     {
//         //
//     }
// }