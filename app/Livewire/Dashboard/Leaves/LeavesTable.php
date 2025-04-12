<?php

namespace App\Livewire\Dashboard\Leaves;

use App\Models\Week;
use App\Models\Leave;
use Livewire\Component;
use App\Enum\StatusActive;
use Livewire\WithPagination;
use App\Enum\LeaveStatusEnum;
use App\Models\FinanceCalendar;
use Illuminate\Support\Facades\Auth;

class LeavesTable extends Component
{
    use WithPagination;

    public $other, $emp_search, $start_date_search, $end_date_search, $leave_type_search, $leave_status_search;

    // protected $queryString = [
    //     'emp_search' => ['as' => 'اسم الموظف'],
    //     'fara_search' => ['as' => 'الفرع'],
    //     'mohafza_search' => ['as' => 'المحافظة'],
    //     'week_search' => ['as' => 'الراحه'],
    //     'gender_search' => ['as' => 'الجنس'],
    // ];


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

        $this->resetPage();
    }


    public function mount()
    {
        $this->other['weeks'] = Week::get();
    }

    public function render()
    {
        $query = Leave::query();

        if ($this->emp_search) {
            $query->where('employee_id', $this->emp_search);
        }

        if ($this->start_date_search) {
            $query->orWhere('start_date', 'LIKE', '%' . $this->start_date_search . '%');
        }

        if ($this->end_date_search) {
            $query->orWhere('end_date', 'LIKE', '%' . $this->end_date_search . '%');
        }

        if ($this->leave_type_search) {
            $query->where('leave_type', $this->leave_type_search);
        }


        if ($this->leave_status_search) {
            $query->where('leave_status', $this->leave_status_search);
        }


        $financial_year = FinanceCalendar::select('id', 'finance_yr')->where('status', StatusActive::Active)->first();
        $emplyeeId = Auth::user()->id;
        $data = $query->select('*')->orderByDesc('id')->where('finance_calendar_id', $financial_year->id)->where('leave_status', "!=", LeaveStatusEnum::Pending)->paginate(10);

        return view('dashboard.leaves.leaves-table', compact('data', 'financial_year'));
    }
}
