<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leave extends Model
{
    use HasFactory;

    protected $table = 'leaves';

    protected $fillable = [
        'employee_id',
        'leave_balance_id',
        'start_date',
        'end_date',
        'leave_type',
        'leave_status',
        'description',
        'created_by',
        'updated_by',
    ];


    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function leaveBalance()
    {
        return $this->belongsTo(LeaveBalance::class, 'leave_balance_id');
    }
}
