<?php

namespace App\Http\Controllers;

use App\Models\Week;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\JobGrade;
use App\Models\Governorate;
use App\Enum\EmployeeStatus;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Dashboard\EmployeeRequest;

class UserController extends Controller
{



    public function index()
    {
        return view('front.employees.index');
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

        return view('front.employees.create', compact('other', 'roles'));
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

        return redirect()->route('dashboard.users.index');
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
        $roles = Role::pluck('name', 'name')->all();
        $employeeRoles = $employee->roles->pluck('name', 'name')->all();
        return view('front.employees.show', compact('employee', 'other', 'roles', 'employeeRoles'));
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
        $roles = Role::pluck('name', 'name')->all();
        $employeeRoles = $employee->roles->pluck('name', 'name')->all();
        return view('front.employees.edit', compact('employee', 'other', 'roles', 'employeeRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employees = $request->validated();
        $data = array_merge($employees, [
            'status' => $request->status,
            'updated_by' => auth()->guard('admin')->user()->id,
        ]);
        if (!empty($request->password)) {
            $data += [
                'password' => Hash::make($request->password),
            ];
        }
        $employee->update($data);

        $employee->syncRoles($request->roles);

        session()->flash('success', 'تم تعديل الموظف بنجاح');

        return redirect()->route('dashboard.users.index');
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