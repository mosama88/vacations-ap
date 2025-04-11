<?php

namespace App\Observers;

use App\Models\Leave;
use App\Models\Employee;
use App\Enum\LeaveTypeEnum;
use App\Models\LeaveBalance;
use App\Enum\LeaveStatusEnum;
use Illuminate\Support\Facades\Auth;

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
    public function updated(Leave $leave)
{
    // نتأكد إن الحالة تمت الموافقة عليها
    if ($leave->leave_status != LeaveStatusEnum::Approved) {
        return;
    }

    // تحديد ID الموظف صاحب الإجازة (مش الأدمن اللي وافق)
    $employeeId = $leave->employee_id;

    // الحصول على رصيد الإجازات
    $leaveBalance = LeaveBalance::where('employee_id', $employeeId)->first();
    if (!$leaveBalance) {
        return;
    }

    // تحديد نوع الخصم حسب نوع الإجازة
    if ($leave->leave_type == LeaveTypeEnum::Emergency) {
        $leaveBalance->remainig_days_emergency -= $leave->days_taken;
        $leaveBalance->used_days_emergency += $leave->days_taken;
    } else {
        $leaveBalance->remainig_days -= $leave->days_taken;
        $leaveBalance->used_days += $leave->days_taken;
    }

    $leaveBalance->save();
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