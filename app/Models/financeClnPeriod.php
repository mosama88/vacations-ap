<?php

namespace App\Models;

use App\Models\Month;
use App\Enum\StatusOpen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class financeClnPeriod extends Model
{
    use HasFactory;

    protected $table = 'finance_cln_periods';

    protected $fillable = [
        'finance_calendar_id',
        'finance_yr',
        'month_id',
        'year_and_month',
        'start_date_month',
        'end_date_month',
        'number_of_days',
        'status',
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

    public function finance_calendar()
    {
        return $this->belongsTo(FinanceCalendar::class, 'finance_calendar_id');
    }

    public function month()
    {
        return $this->belongsTo(Month::class, 'month_id');
    }

    protected $casts = [
        'status' => StatusOpen::class,
    ];

 
}