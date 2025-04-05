<?php

namespace App\Models;

use App\Enum\LeaveBalanceStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeaveBalance extends Model
{
    use HasFactory;

    protected $table = 'leave_balances';

    protected $fillable = [
        'employee_id',
        'finance_calendar_id',
        'total_days_emergency',
        'used_days_emergency',
        'remainig_days_emergency',
        'total_days',
        'used_days',
        'remainig_days',
        'status',
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

    public function financeCalendar()
    {
        return $this->belongsTo(FinanceCalendar::class, 'finance_calendar_id');
    }


    protected $casts = [
        'status' => LeaveBalanceStatus::class,
    ];
}