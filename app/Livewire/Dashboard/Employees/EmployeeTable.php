<?php

namespace App\Livewire\Dashboard\Employees;

use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;

class EmployeeTable extends Component
{

    use WithPagination;

    public function render()
    {
        $data = Employee::orderByDesc('id')->paginate(10);
        return view('dashboard.employees.employee-table', compact('data'));
    }
}