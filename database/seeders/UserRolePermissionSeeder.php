<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Employee;
use App\Enum\EmployeeStatus;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;


class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Permissions
        // Define the guard
        $guardAdmin = 'admin';

        // Create Permissions
        $permissions = [
            ['name' => 'view role', 'category' => 'Roles', 'guard_name' => $guardAdmin],
            ['name' => 'create role', 'category' => 'Roles', 'guard_name' => $guardAdmin],
            ['name' => 'update role', 'category' => 'Roles', 'guard_name' => $guardAdmin],
            ['name' => 'delete role', 'category' => 'Roles', 'guard_name' => $guardAdmin],

            ['name' => 'view permission', 'category' => 'Permissions', 'guard_name' => $guardAdmin],
            ['name' => 'create permission', 'category' => 'Permissions', 'guard_name' => $guardAdmin],
            ['name' => 'update permission', 'category' => 'Permissions', 'guard_name' => $guardAdmin],
            ['name' => 'delete permission', 'category' => 'Permissions', 'guard_name' => $guardAdmin],

            ['name' => 'view user', 'category' => 'Users', 'guard_name' => $guardAdmin],
            ['name' => 'create user', 'category' => 'Users', 'guard_name' => $guardAdmin],
            ['name' => 'update user', 'category' => 'Users', 'guard_name' => $guardAdmin],
            ['name' => 'delete user', 'category' => 'Users', 'guard_name' => $guardAdmin],



            // السنوات المالية
            ['name' => 'السنوات المالية', 'category' => 'financeCalendars', 'guard_name' => $guardAdmin],
            ['name' => 'اضافة السنوات المالية', 'category' => 'financeCalendars', 'guard_name' => $guardAdmin],
            ['name' => 'تعديل السنوات المالية', 'category' => 'financeCalendars', 'guard_name' => $guardAdmin],
            ['name' => 'حذف السنوات المالية', 'category' => 'financeCalendars', 'guard_name' => $guardAdmin],
            ['name' => 'عرض شهور السنه السنوات مالية', 'category' => 'financeCalendars', 'guard_name' => $guardAdmin],
            ['name' => 'فتح السنوات المالية', 'category' => 'financeCalendars', 'guard_name' => $guardAdmin],
            ['name' => 'غلق السنوات المالية', 'category' => 'financeCalendars', 'guard_name' => $guardAdmin],

            // الفروع
            ['name' => 'الفروع', 'category' => 'branches', 'guard_name' => $guardAdmin],
            ['name' => 'اضافة الفروع', 'category' => 'branches', 'guard_name' => $guardAdmin],
            ['name' => 'تعديل الفروع', 'category' => 'branches', 'guard_name' => $guardAdmin],
            ['name' => 'حذف الفروع', 'category' => 'branches', 'guard_name' => $guardAdmin],


            // الدرجات الوظيفية
            ['name' => 'الدرجات الوظيفية', 'category' => 'jobsGrades', 'guard_name' => $guardAdmin],
            ['name' => 'اضافة الدرجات الوظيفية', 'category' => 'jobsGrades', 'guard_name' => $guardAdmin],
            ['name' => 'تعديل الدرجات الوظيفية', 'category' => 'jobsGrades', 'guard_name' => $guardAdmin],
            ['name' => 'حذف الدرجات الوظيفية', 'category' => 'jobsGrades', 'guard_name' => $guardAdmin],


            //    أنواع الأجازات
            ['name' => 'الأجازات', 'category' => 'leaves', 'guard_name' => $guardAdmin],
            ['name' => 'اضافة الأجازات', 'category' => 'leaves', 'guard_name' => $guardAdmin],
            ['name' => 'تعديل الأجازات', 'category' => 'leaves', 'guard_name' => $guardAdmin],
            ['name' => 'حذف الأجازات', 'category' => 'leaves', 'guard_name' => $guardAdmin],
            ['name' => 'اخذ اجراء الأجازات', 'category' => 'leaves', 'guard_name' => $guardAdmin],


            //    المحافظات
            ['name' => 'المحافظات', 'category' => 'governorates', 'guard_name' => $guardAdmin],
            ['name' => 'اضافة المحافظات', 'category' => 'governorates', 'guard_name' => $guardAdmin],
            ['name' => 'تعديل المحافظات', 'category' => 'governorates', 'guard_name' => $guardAdmin],
            ['name' => 'حذف المحافظات', 'category' => 'governorates', 'guard_name' => $guardAdmin],


            // ###################################################################################################################

            // قائمة بيانات شئون الموظفين
            ['name' => 'قائمة بيانات شئون الموظفين', 'category' => 'affairsEmployees', 'guard_name' => $guardAdmin],

            // بيانات الموظفين
            ['name' => 'بيانات الموظفين', 'category' => 'Employees', 'guard_name' => $guardAdmin],
            ['name' => 'جدول الموظفين', 'category' => 'Employees', 'guard_name' => $guardAdmin],
            ['name' => 'أضافة موظف', 'category' => 'Employees', 'guard_name' => $guardAdmin],
            ['name' => 'تعديل الموظف', 'category' => 'Employees', 'guard_name' => $guardAdmin],
            ['name' => 'حذف الموظف', 'category' => 'Employees', 'guard_name' => $guardAdmin],
            ['name' => 'عرض حساب الأجازات', 'category' => 'Employees', 'guard_name' => $guardAdmin],
            ['name' => 'بحث الموظفين', 'category' => 'Employees', 'guard_name' => $guardAdmin],
            ['name' => 'اضافة بدل ثابت', 'category' => 'Employees', 'guard_name' => $guardAdmin],
            ['name' => 'الراتب المؤرشف', 'category' => 'Employees', 'guard_name' => $guardAdmin],
            ['name' => 'جدول الملفات الشخصية', 'category' => 'Employees', 'guard_name' => $guardAdmin],
            ['name' => 'اضافة ملفات شخصية', 'category' => 'Employees', 'guard_name' => $guardAdmin],
            ['name' => 'تحميل من جدول ملفات شخصية', 'category' => 'Employees', 'guard_name' => $guardAdmin],
            ['name' => 'حذف من جدول ملفات شخصية', 'category' => 'Employees', 'guard_name' => $guardAdmin],



            //    قائمة المستخدمين
            ['name' => 'قائمة المستخدمين', 'category' => 'UserList', 'guard_name' => $guardAdmin],

            // المستخدمين
            ['name' => 'المستخدمين', 'category' => 'users', 'guard_name' => $guardAdmin],
            ['name' => 'اضافة المستخدمين', 'category' => 'users', 'guard_name' => $guardAdmin],
            ['name' => 'تعديل المستخدمين', 'category' => 'users', 'guard_name' => $guardAdmin],
            ['name' => 'حذف المستخدمين', 'category' => 'users', 'guard_name' => $guardAdmin],

            // الصلاحيات
            ['name' => 'الصلاحيات', 'category' => 'roles', 'guard_name' => $guardAdmin],
            ['name' => 'اضافة الصلاحيات', 'category' => 'roles', 'guard_name' => $guardAdmin],
            ['name' => 'تعديل الصلاحيات', 'category' => 'roles', 'guard_name' => $guardAdmin],
            ['name' => 'حذف الصلاحيات', 'category' => 'roles', 'guard_name' => $guardAdmin],
            ['name' => 'إضافة وتعديل أذونات الصلاحية', 'category' => 'roles', 'guard_name' => $guardAdmin],

            // الأذونات
            ['name' => 'الأذونات', 'category' => 'permissions', 'guard_name' => $guardAdmin],
            ['name' => 'اضافة الأذونات', 'category' => 'permissions', 'guard_name' => $guardAdmin],
            ['name' => 'تعديل الأذونات', 'category' => 'permissions', 'guard_name' => $guardAdmin],
            ['name' => 'حذف الأذونات', 'category' => 'permissions', 'guard_name' => $guardAdmin],

        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Create Roles
        $superAdminRole = Role::create(['name' => 'super-admin', 'guard_name' => $guardAdmin]); //as super-admin
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => $guardAdmin]);
        $staffRole = Role::create(['name' => 'staff', 'guard_name' => $guardAdmin]);
        $userRole = Role::create(['name' => 'user', 'guard_name' => $guardAdmin]);

        // Lets give all permission to super-admin role.
        $allPermissionNames = Permission::where('guard_name', $guardAdmin)->pluck('name')->toArray();
        $superAdminRole->givePermissionTo($allPermissionNames);

        // Let's give few permissions to admin role.
        $adminPermissions = [
            'create role',
            'view role',
            'update role',
            'create permission',
            'view permission',
            'create user',
            'view user',
            'update user',
        ];

        $adminRole->givePermissionTo($adminPermissions);

        // Let's Create User and assign Role to it.
        $superAdminUser = Admin::firstOrCreate([
            'username' => 'superadmin',
        ], [
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'password' => Hash::make('password'),
        ]);
        $superAdminUser->assignRole($superAdminRole);

        $superAdminUser2 = Admin::firstOrCreate([
            'username' => 'mosama',
        ], [
            'name' => 'محمد أسامه',
            'username' => 'mosama',
            'password' => Hash::make('password'),
        ]);

        $superAdminUser2 = Admin::firstOrCreate([
            'username' => 'Mohamed Osama',
        ], [
            'name' => 'محمد أسامه',
            'username' => 'admin',
            'password' => Hash::make('password'),
        ]);
        $superAdminUser2->assignRole($superAdminRole);

        $adminUser = Admin::firstOrCreate([
            'username' => 'admin'
        ], [
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make(value: 'password'),
        ]);
        $adminUser->assignRole($adminRole);

        $staffUser = Admin::firstOrCreate([
            'username' => 'staff',
        ], [
            'name' => 'Staff',
            'username' => 'staff',
            'password' => Hash::make('password'),
        ]);
        $staffUser->assignRole($staffRole);

        $staffUser2 = Admin::firstOrCreate([
            'username' => 'heba',
        ], [
            'name' => 'heba',
            'username' => 'heba',
            'password' => Hash::make('password'),
        ]);
        $staffUser2->assignRole($staffRole);
    }
}
