<?php

namespace App\Livewire\Dashboard\Leaves;

use App\Models\Week;
use App\Models\Leave;
use Livewire\Component;
use App\Models\Employee;
use App\Enum\StatusActive;
use App\Models\Governorate;
use Livewire\WithPagination;
use App\Enum\LeaveStatusEnum;
use App\Models\FinanceCalendar;
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


        if ($this->governrate_search) {
            $query->whereHas('employee', function ($query) {
                // البحث باستخدام الاسم
                $query->where('governorate_id',  $this->governrate_search);
            });
        }



        $financial_year = FinanceCalendar::select('id', 'finance_yr')->where('status', StatusActive::Active)->first();
        // Get the current user's branch (assuming the manager is logged in)
        // You might need to adjust this based on your authentication setup
        $user_branch_id = Auth::user()->branch_id;
        // Get employees in the same branch as the manager
        $employees = Employee::with('branch')
            ->where('branch_id', $user_branch_id)
            ->get();

        // Get leave requests for these employees
        $data = $query->whereIn('employee_id', $employees->pluck('id'))->where('leave_status', "=", LeaveStatusEnum::Pending)->orderByDesc('id')->paginate(10);


        return view('dashboard.leaves.leaves-pending-table', compact('data', 'financial_year'));
    }
}