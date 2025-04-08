<?php

namespace App\Models;

use App\Enum\StatusActive;
use Illuminate\Database\Eloquent\Model;
use App\Observers\FinanceCalendarObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;


#[ObservedBy([FinanceCalendarObserver::class])]
class FinanceCalendar extends Model
{

    use HasFactory;

    protected $table = 'finance_calendars';

    protected $fillable = [
        'finance_yr',
        'finance_yr_desc',
        'start_date',
        'end_date',
        'status',
    ];



    protected $casts = [
        'status' => StatusActive::class,
    ];
}