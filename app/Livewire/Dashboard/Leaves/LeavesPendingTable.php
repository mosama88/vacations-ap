<?php

namespace App\Livewire\Dashboard\Leaves;

use Livewire\Component;
use App\Models\Week;
use App\Models\Leave;
use App\Enum\StatusActive;
use Livewire\WithPagination;
use App\Enum\LeaveStatusEnum;
use App\Models\FinanceCalendar;
use App\Models\Governorate;
use Illuminate\Support\Facades\Auth;

class LeavesPendingTable extends Component
{
    use WithPagination;

    public $other, $emp_search, $start_date_search, $end_date_search, $leave_type_search, $governrate_search;


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
        $this->governrate_search = null;

        $this->resetPage();
    }


    public function mount()
    {
        $this->other['weeks'] = Week::get();
        $this->other['governorates'] = Governorate::get();
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

        if ($this->start_date_search) {
            $query->orWhere('start_date', 'LIKE', '%' . $this->start_date_search . '%');
        }

        if ($this->end_date_search) {
            $query->orWhere('end_date', 'LIKE', '%' . $this->end_date_search . '%');
        }

        if ($this->leave_type_search) {
            $query->where('leave_type', $this->leave_type_search);
        }


        if ($this->governrate_search) {
            $query->whereHas('employee', function ($query) {
                // البحث باستخدام الاسم
                $query->where('governorate_id',  $this->governrate_search);
            });
        }


        $financial_year = FinanceCalendar::select('id', 'finance_yr')->where('status', StatusActive::Active)->first();
        $emplyeeId = Auth::user()->id;
        $data = $query->select('*')->orderByDesc('id')->where('finance_calendar_id', $financial_year->id)->where('leave_status', "=", LeaveStatusEnum::Pending)->paginate(10);

        return view('dashboard.leaves.leaves-pending-table', compact('data', 'financial_year'));
    }
}