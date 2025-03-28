<?php

namespace App\Models;

use App\Enum\LeaveTypeEnum;
use App\Enum\LeaveStatusEnum;
use App\Observers\LeavesObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([LeavesObserver::class])]
class Leave extends Model
{
    use HasFactory;

    protected $table = 'leaves';

    protected $fillable = [
        'employee_id',
        'start_date',
        'end_date',
        'leave_type',
        'days_taken',
        'leave_status',
        'description',
        'created_by',
        'updated_by',
    ];


    public function createdBy()
    {
        return $this->belongsTo(Employee::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Employee::class, 'updated_by');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    protected $casts = [
        'leave_status' => LeaveStatusEnum::class,
        'leave_type' => LeaveTypeEnum::class,
    ];
}