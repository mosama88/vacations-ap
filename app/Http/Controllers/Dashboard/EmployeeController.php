<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Week;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\JobGrade;
use App\Models\Governorate;
use App\Enum\EmployeeStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\EmployeeRequest;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.employees.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $other['governorates'] = Governorate::get();
        $other['weeks'] = Week::get();
        $other['job_grades'] = JobGrade::get();
        $other['branches'] = Branch::get();
        $roles = Role::pluck('name', 'name')->all();

        return view('dashboard.employees.create', compact('other', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $lastEmployees = Employee::orderByDesc('employee_code')->value('employee_code');
        $new_employeeCode = $lastEmployees ? $lastEmployees + 1 : 1000;
        $employees = $request->validated();
        $data = array_merge($employees, [
            'employee_code' => $new_employeeCode,
            'status' => EmployeeStatus::Active,
            'created_by' => auth()->guard('admin')->user()->id,
        ]);
        $employee = Employee::create($data);
        $employee->syncRoles($request->roles);

        session()->flash('success', 'تم أضافة الموظف بنجاح');

        return redirect()->route('dashboard.employees.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $other['governorates'] = Governorate::get();
        $other['weeks'] = Week::get();
        $other['job_grades'] = JobGrade::get();
        $other['branches'] = Branch::get();
        return view('dashboard.employees.show', compact('employee', 'other'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $other['governorates'] = Governorate::get();
        $other['weeks'] = Week::get();
        $other['job_grades'] = JobGrade::get();
        $other['branches'] = Branch::get();
        return view('dashboard.employees.edit', compact('employee', 'other'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف الموظف بنجاح!'
        ]);
    }
}