<?php

namespace App\Livewire\Front\Employees;

use Livewire\Component;
use App\Models\Week;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\JobGrade;
use App\Models\Governorate;
use Livewire\WithPagination;


class EmployeeTableFront extends Component
{
    use WithPagination;

    public $other, $emp_search, $week_search, $mohafza_search, $fara_search;

    protected $queryString = [
        'emp_search' => ['sa' => 'اسم الموظف'],
        'fara_search' => ['sa' => 'الفرع'],
        'mohafza_search' => ['sa' => 'المحافظة'],
        'week_search' => ['sa' => 'الراحه'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function clear()
    {
        $this->reset(
            'emp_search',
            'fara_search',
            'mohafza_search',
            'week_search',
        );
    }


    public function mount()
    {
        $this->other['governorates'] = Governorate::get();
        $this->other['weeks'] = Week::get();
        $this->other['job_grades'] = JobGrade::get();
        $this->other['branches'] = Branch::get();
    }

    public function render()
    {
        $query = Employee::query();

        if ($this->emp_search) {
            $query->where('name', 'LIKE', '%' . $this->emp_search . '%')
                ->orWhere('username', 'LIKE', '%' . $this->emp_search . '%')
                ->orWhere('mobile', 'LIKE', '%' . $this->emp_search . '%');
        }

        if ($this->week_search) {
            $query->where('week_id', $this->week_search);
        }

        if ($this->fara_search) {
            $query->where('branch_id', $this->fara_search);
        }


        if ($this->mohafza_search) {
            $query->where('governorate_id', $this->mohafza_search);
        }


        $data = $query->select('*')->orderByDesc('id')->paginate(10);

        return view('front.employees.employee-table-front', compact('data'));
    }
}