<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Week;
use App\Models\Branch;
use App\Models\JobType;
use App\Models\Employee;
use App\Models\JobGrade;
use App\Models\Governorate;
use App\Enum\EmployeeStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
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
        $other['job_types'] = JobType::get();
        $roles = Role::pluck('name', 'name')->all();

        return view('dashboard.employees.create', compact('other', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        try {
            DB::beginTransaction();
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
            DB::commit();

            session()->flash('success', 'تم أضافة الموظف بنجاح');
            return redirect()->route('dashboard.employees.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'عفوا حدث خطأ' . $e->getMessage()])->withInput();
        }
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
        $other['job_types'] = JobType::get();
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
        $other['job_types'] = JobType::get();
        $roles = Role::pluck('name', 'name')->all();
        $employeeRoles = $employee->roles->pluck('name', 'name')->all();
        return view('dashboard.employees.edit', compact('employee', 'other', 'roles', 'employeeRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        try {
            DB::beginTransaction();
            $employees = $request->validated();
            $data = array_merge($employees, [
                'status' => $request->status,
            ]);
     
            $employee->update($data);

            $employee->syncRoles($request->roles);
            DB::commit();
            session()->flash('success', 'تم تعديل الموظف بنجاح');
            return redirect()->route('dashboard.employees.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'عفوا حدث خطأ' . $e->getMessage()])->withInput();
        }
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
        $user = Auth::user()->id;
        $employee = Employee::findOrFail($user);
        $other['governorates'] = Governorate::get();
        $other['weeks'] = Week::get();
        $other['job_grades'] = JobGrade::get();
        $other['branches'] = Branch::get();
        $roles = Role::pluck('name', 'name')->all();
        $employeeRoles = $employee->roles->pluck('name', 'name')->all();
        return view('dashboard.auth.profile', compact('employee', 'other', 'roles', 'employeeRoles'));
    }


    public function changePassword(Request $request)
    {
        // إضافة قواعد التحقق
        $request->validate([
            'password' => [
                'required',
                'confirmed',
                'max:15',
                Password::min(8)->mixedCase()  // يتطلب الحروف الكبيرة والصغيرة
            ],
            'password_confirmation' => 'required'
        ], [
            'password.required' => 'حقل كلمة المرور مطلوب',
            'password.confirmed' => 'كلمتا المرور غير متطابقتين',
            'password.max' => 'يجب ألا تزيد كلمة المرور عن 15 حرفاً',
            'password.min' => 'يجب ألا تقل كلمة المرور عن 8 أحرف',
            'password_confirmation.required' => 'حقل تأكيد كلمة المرور مطلوب',
        ]);

        // الحصول على المستخدم
        $user = Auth::user();

        if (!$user) {
            session()->flash('error', 'المستخدم غير موجود');
            return redirect()->back();
        }

        try {
            // استرجاع الموظف باستخدام المعرف الخاص بالمستخدم
            $employee = Employee::findOrFail($user->id);

            // تحديث كلمة المرور بشكل آمن
            $employee->password = Hash::make($request->password);

            // حفظ البيانات
            $employee->save();

            // إرسال رسالة نجاح
            session()->flash('success', 'تم تغيير كلمة المرور بنجاح');

            return redirect()->back();
        } catch (\Exception $e) {
            // في حالة حدوث أي استثناء
            session()->flash('error', 'حدث خطأ أثناء تغيير كلمة المرور');


            return redirect()->back();
        }
    }
}