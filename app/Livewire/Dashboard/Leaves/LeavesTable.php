<?php

namespace App\Livewire\Dashboard\Leaves;

use App\Models\Week;
use App\Models\Leave;
use Livewire\Component;
use App\Models\Employee;
use App\Enum\StatusActive;
use Livewire\WithPagination;
use App\Enum\LeaveStatusEnum;
use App\Models\FinanceCalendar;
use Illuminate\Support\Facades\Auth;

class LeavesTable extends Component
{
    use WithPagination;

    public $other, $emp_search, $start_date_search, $end_date_search, $leave_type_search, $finance_calendars_search, $leave_status_search;


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function clear()
    {
        $this->emp_search = null;
        $this->end_date_search = null;
        $this->start_date_search = null;
        $this->leave_type_search = null;
        $this->leave_status_search = null;
        $this->finance_calendars_search = null;

        $this->resetPage();
    }


    public function mount()
    {
        $this->other['weeks'] = Week::get();
        $this->other['finance_calendars'] = FinanceCalendar::get();
    }

    public function render()
    {
        $query = Leave::query();

        if ($this->emp_search) {
            $query->whereHas('employee', function ($query) {
                // البحث باستخدام الاسم
                $query->where('name', 'like', '%' . $this->emp_search . '%')
                    ->orWhere('employee_code', 'like', '%' . $this->emp_search . '%')
                    ->orWhere('username', 'like', '%' . $this->emp_search . '%');
            });
        }


        if ($this->finance_calendars_search) {
            $query->orWhere('finance_calendar_id',  $this->finance_calendars_search);
        }

        //search by start date between end date
        if ($this->start_date_search && $this->end_date_search) {
            $query->whereBetween('start_date', [$this->start_date_search, $this->end_date_search]);
        } elseif ($this->start_date_search) {
            $query->where('start_date', '>=', $this->start_date_search);
        } elseif ($this->end_date_search) {
            $query->where('end_date', '<=', $this->end_date_search);
        }

        if ($this->leave_type_search) {
            $query->where('leave_type', $this->leave_type_search);
        }


        if ($this->leave_status_search) {
            $query->where('leave_status', $this->leave_status_search);
        }



        $data = $query->where('leave_status', "!=", LeaveStatusEnum::Pending)->orderByDesc('id')->paginate(10);


        return view('dashboard.leaves.leaves-table', compact('data'));
    }
}