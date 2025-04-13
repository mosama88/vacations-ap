<?php

namespace App\Livewire\Dashboard\LeaveBalance;

use Livewire\Component;
use App\Models\Employee;
use App\Models\LeaveBalance;
use Livewire\WithPagination;
use App\Enum\LeaveBalanceStatus;

class LeaveBalanceTable extends Component
{
    use WithPagination;

    public $other, $emp_search;


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function clear()
    {
        $this->emp_search = null;


        $this->resetPage();
    }

    public function mount()
    {
        $this->other['employees'] = Employee::get();
    }

    public function render()
    {
        $query = LeaveBalance::query();

        if ($this->emp_search) {
            $query->where('employee_id', $this->emp_search);
        }


        $data = $query->select('*')->where('employee_id', '!=', null)->where('status', LeaveBalanceStatus::Open)->orderByDesc('id')->paginate(10);

        return view('dashboard.leaveBalances.leave-balance-table', compact('data'));
    }
}
