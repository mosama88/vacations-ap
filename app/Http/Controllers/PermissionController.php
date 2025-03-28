<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{


    public function index()
    {
        $permissions = Permission::get();
        return view('role-permission.permission.index', ['permissions' => $permissions]);
    }

    public function create()
    {
        return view('role-permission.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ],
            'category' => [
                'required',
                'string'
            ],
           
        ]);

        Permission::create([
            'name' => $request->name,
            'category' => $request->category,
            'guard_name' => $request->guard_name
        ]);

        return redirect('permissions')->with('status', 'تم إنشاء الأذونات بنجاح');
    }


    public function edit(Permission $permission)
    {
        return view('role-permission.permission.edit', ['permission' => $permission]);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,'.$permission->id
            ]
        ]);

        $permission->update([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status','تم تعديل الاذونات بنجاح');
    }

    public function destroy($permissionId)
    {
        $permission = Permission::find($permissionId);
        $permission->delete();
        return redirect('permissions')->with('status','تم حذف الأذونات بنجاح');
    }
}
