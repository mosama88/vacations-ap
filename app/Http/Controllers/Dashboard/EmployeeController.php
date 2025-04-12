<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Week;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\JobGrade;
use App\Models\Governorate;
use App\Enum\EmployeeStatus;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Dashboard\EmployeeRequest;

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
            'password' => Hash::make('P@ssw0rd'),
            'status' => EmployeeStatus::Active,
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
        $roles = Role::pluck('name', 'name')->all();
        $employeeRoles = $employee->roles->pluck('name', 'name')->all();
        return view('dashboard.employees.show', compact('employee', 'other', 'roles', 'employeeRoles'));
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
        return view('dashboard.employees.edit', compact('employee', 'other', 'roles', 'employeeRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employees = $request->validated();
        $data = array_merge($employees, [
            'status' => $request->status,
        ]);

        if (!empty($request->password)) {
            // إذا كانت كلمة المرور موجودة، يتم تشفيرها وتحديث البيانات
            $employee['password'] = Hash::make($request->password);
        }
        $employee->update($data);

        $employee->syncRoles($request->roles);

        session()->flash('success', 'تم تعديل الموظف بنجاح');

        return redirect()->route('dashboard.employees.index');
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

    public function profile()
    {
        return view('dashboard.auth.profile');
    }


    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:5|max:30|confirmed',
            'password_confirmation' => 'required'
        ], [
            'password.required' => 'حقل كلمة المرور مطلوب',
            'password.min' => 'يجب أن تتكون كلمة المرور من 5 أحرف على الأقل',
            'password.max' => 'يجب ألا تزيد كلمة المرور عن 30 حرفاً',
            'password.confirmed' => 'كلمتا المرور غير متطابقتين',
            'password_confirmation.required' => 'حقل تأكيد كلمة المرور مطلوب'
        ]);
        $user = Auth::user()->id;
        $employee = Employee::findOrFail($user);
        $employee->password = $request->password;

        $employee->save();

        session()->flash('success', 'تم تغيير كلمة المرور بنجاح');

        return redirect()->back();
    }
}