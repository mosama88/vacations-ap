<?php

namespace App\Livewire\Dashboard\Employees;

use App\Models\Week;
use App\Models\Branch;
use Livewire\Component;
use App\Models\Employee;
use App\Models\JobGrade;
use App\Models\Governorate;
use Livewire\WithPagination;

class EmployeeTable extends Component
{

    use WithPagination;

    public $other, $emp_search, $week_search, $mohafza_search, $fara_search, $gender_search;

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
        $this->fara_search = null;
        $this->mohafza_search = null;
        $this->week_search = null;
        $this->gender_search = null;

        $this->resetPage();
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

        if ($this->gender_search) {
            $query->where('gender', $this->gender_search);
        }


        $data = $query->select('*')->orderByDesc('id')->paginate(10);
        return view('dashboard.employees.employee-table', compact('data'));
    }
}
