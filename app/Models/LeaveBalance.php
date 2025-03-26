<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeaveBalance extends Model
{
    use HasFactory;

    protected $table = 'leave_balances';

    protected $fillable = [
        'employee_id',
        'finance_calendar_id',
        'total_days',
        'used_days',
        'remainig_days',
    ];



    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function financeCalendar()
    {
        return $this->belongsTo(FinanceCalendar::class, 'finance_calendar_id');
    }
}
