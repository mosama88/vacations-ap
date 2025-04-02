<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    protected array $middleware = [
        'permission:view user' => ['only' => ['index']],
        'permission:create user' => ['only' => ['create', 'store']],
        'permission:update user' => ['only' => ['update', 'edit']],
        'permission:delete user' => ['only' => ['destroy']]
    ];


    public function index()
    {
        $employees = Employee::paginate(10);
        return view('front.role-permission.user.index', ['employees' => $employees]);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('front.role-permission.user.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|max:255|unique:employees,username',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required',
            'status' => 'nullable|in:0,1',
        ]);

        $employee = Employee::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        $employee->syncRoles($request->roles);

        return redirect('/users')->with('status', 'تم إنشاء المستخدم بالصلاحيات بنجاح');
    }

    public function edit(Employee $employee)
    {
        $roles = Role::pluck('name', 'name')->all();
        $employeeRoles = $employee->roles->pluck('name', 'name')->all();
        return view('front.role-permission.user.edit', [
            'user' => $employee,
            'roles' => $roles,
            'userRoles' => $employeeRoles
        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|max:20',
            'roles' => 'required',
            'status' => 'nullable|in:0,1',
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'status' => $request->status,
        ];

        if (!empty($request->password)) {
            $data += [
                'password' => Hash::make($request->password),
            ];
        }

        $employee->update($data);
        $employee->syncRoles($request->roles);

        return redirect('/users')->with('status', 'تم تعديل المستخدم بالصلاحيات بنجاح');
    }

    public function destroy($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $employee->delete();

        return redirect('/users')->with('status', 'حذف المستخدم بنجاح');
    }
}