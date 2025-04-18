<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class RoleController extends Controller
{


    protected array $middleware = [
        'permission:view role' => ['only' => ['index']],
        'permission:create role' => ['only' => ['create', 'store', 'addPermissionToRole', 'givePermissionToRole']],
        'permission:update role' => ['only' => ['update', 'edit']],
        'permission:delete role' => ['only' => ['destroy']]
    ];

    public function index()
    {
        $roles = Role::get();
        return view('front.role-permission.role.index', ['roles' => $roles]);
    }

    public function create()
    {
        return view('front.role-permission.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        Role::create([
            'name' => $request->name
        ]);
        session()->flash('success', 'إنشاء الصلاحية بنجاح');

        return redirect('roles');
    }

    public function edit(Role $role)
    {
        return view('front.role-permission.role.edit', [
            'role' => $role
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,' . $role->id
            ]
        ]);

        $role->update([
            'name' => $request->name
        ]);
        session()->flash('success', 'تعديل الصلاحية بنجاح');
        return redirect('roles');
    }

    public function destroy($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();
        session()->flash('success', 'حذف الصلاحية بنجاح');
        return redirect('roles');
    }

    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('front.role-permission.role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);

        session()->flash('success', 'تم إضافة الأذونات الى الصلاحيات');
        return redirect()->back();
    }
}