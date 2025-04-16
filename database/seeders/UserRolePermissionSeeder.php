<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Employee;
use App\Enum\EmployeeType;
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
        $guardAdmin = 'employee';

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


            ['name' => 'الأعدادت', 'category' => 'settings', 'guard_name' => $guardAdmin],
            ['name' => 'الصفحه الرئيسية', 'category' => 'settings', 'guard_name' => $guardAdmin],
            ['name' => 'إدارة شئون الموظفين', 'category' => 'settings', 'guard_name' => $guardAdmin],
            ['name' => 'إدارة شئون الأجازات', 'category' => 'settings', 'guard_name' => $guardAdmin],
            ['name' => 'إدارة شئون المستخدمين', 'category' => 'settings', 'guard_name' => $guardAdmin],


            // السنوات المالية
            ['name' => 'السنوات المالية', 'category' => 'financeCalendars', 'guard_name' => $guardAdmin],
            ['name' => 'اضافة السنوات المالية', 'category' => 'financeCalendars', 'guard_name' => $guardAdmin],
            ['name' => 'تعديل السنوات المالية', 'category' => 'financeCalendars', 'guard_name' => $guardAdmin],
            ['name' => 'حذف السنوات المالية', 'category' => 'financeCalendars', 'guard_name' => $guardAdmin],
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
            ['name' => 'عرض الدرجات الوظيفية', 'category' => 'jobsGrades', 'guard_name' => $guardAdmin],
            ['name' => 'حذف الدرجات الوظيفية', 'category' => 'jobsGrades', 'guard_name' => $guardAdmin],

            //    المحافظات
            ['name' => 'المحافظات', 'category' => 'governorates', 'guard_name' => $guardAdmin],
            ['name' => 'اضافة المحافظات', 'category' => 'governorates', 'guard_name' => $guardAdmin],
            ['name' => 'تعديل المحافظات', 'category' => 'governorates', 'guard_name' => $guardAdmin],
            ['name' => 'حذف المحافظات', 'category' => 'governorates', 'guard_name' => $guardAdmin],


            // ###################################################################################################################



            // بيانات الموظفين
            ['name' => 'بيانات الموظفين', 'category' => 'Employees', 'guard_name' => $guardAdmin],
            ['name' => 'جدول الموظفين', 'category' => 'Employees', 'guard_name' => $guardAdmin],
            ['name' => 'أضافة موظف', 'category' => 'Employees', 'guard_name' => $guardAdmin],
            ['name' => 'تعديل الموظف', 'category' => 'Employees', 'guard_name' => $guardAdmin],
            ['name' => 'حذف الموظف', 'category' => 'Employees', 'guard_name' => $guardAdmin],
            ['name' => 'عرض حساب الأجازات', 'category' => 'Employees', 'guard_name' => $guardAdmin],
            ['name' => 'بحث الموظفين', 'category' => 'Employees', 'guard_name' => $guardAdmin],


            //    رصيد الموظف
            ['name' => 'رصيد الموظف', 'category' => 'leaveBalances', 'guard_name' => $guardAdmin],
            ['name' => 'اضافة رصيد الموظف', 'category' => 'leaveBalances', 'guard_name' => $guardAdmin],
            ['name' => 'تعديل رصيد الموظف', 'category' => 'leaveBalances', 'guard_name' => $guardAdmin],
            ['name' => 'حذف رصيد الموظف', 'category' => 'leaveBalances', 'guard_name' => $guardAdmin],



            //    أنواع الأجازات
            ['name' => 'الأجازات', 'category' => 'leaves', 'guard_name' => $guardAdmin],
            ['name' => 'تعديل الأجازات', 'category' => 'leaves', 'guard_name' => $guardAdmin],
            ['name' => 'حذف الأجازات', 'category' => 'leaves', 'guard_name' => $guardAdmin],
            ['name' => 'اخذ اجراء الأجازات', 'category' => 'leaves', 'guard_name' => $guardAdmin],
            ['name' => 'المعلقه الأجازات', 'category' => 'leaves', 'guard_name' => $guardAdmin],
            ['name' => 'الموظفين الأجازات', 'category' => 'leaves', 'guard_name' => $guardAdmin],
            ['name' => 'طلب الأجازات', 'category' => 'leaves', 'guard_name' => $guardAdmin],
            ['name' => 'طباعة الأجازات', 'category' => 'leaves', 'guard_name' => $guardAdmin],

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
        $superUserRole = Role::create(['name' => 'super-user', 'guard_name' => $guardAdmin]); //as super-admin
        $superAdminRole = Role::create(['name' => 'super-admin', 'guard_name' => $guardAdmin]); //as super-admin
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => $guardAdmin]);
        $staffRole = Role::create(['name' => 'staff', 'guard_name' => $guardAdmin]);
        $userRole = Role::create(['name' => 'employee', 'guard_name' => $guardAdmin]);

        // Lets give all permission to super-admin role.
        $allPermissionNames = Permission::where('guard_name', $guardAdmin)->pluck('name')->toArray();
        $superUserRole->givePermissionTo($allPermissionNames);
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
        $superAdminUser = Employee::firstOrCreate([
            'username' => 'superadmin',
        ], [
            'employee_code' => 500,
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'password' => Hash::make('password'),
            'gender' => '1',
            'type' => EmployeeType::Manager,
            'mobile' => '01150559683',
            'status' => EmployeeStatus::Active,
            'week_id' => 7,
            'job_grade_id' => 9,
            'branch_id' => 10,
            'governorate_id' => 24,
        ]);
        $superAdminUser->assignRole($superAdminRole);

        $superAdminUser2 = Employee::firstOrCreate([
            'username' => 'mosama',
        ], [
            'employee_code' => 501,
            'name' => 'محمد أسامه',
            'username' => 'mosama',
            'password' => Hash::make('password'),
            'gender' => '1',
            'type' => EmployeeType::Manager,
            'mobile' => '01150559683',
            'status' => EmployeeStatus::Active,
            'week_id' => 7,
            'job_grade_id' => 9,
            'branch_id' => 10,
            'governorate_id' => 24,
        ]);

        $superAdminUser2 = Employee::firstOrCreate([
            'username' => 'Mohamed Osama',
        ], [
            'employee_code' => 502,
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'gender' => '1',
            'type' => EmployeeType::Manager,
            'mobile' => '01150559683',
            'status' => EmployeeStatus::Active,
            'week_id' => 7,
            'job_grade_id' => 9,
            'branch_id' => 10,
            'governorate_id' => 24,
        ]);
        $superAdminUser2->assignRole($superAdminRole);

        $adminUser = Employee::firstOrCreate([
            'username' => 'admin'
        ], [
            'employee_code' => 503,
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make(value: 'password'),
            'gender' => '1',
            'type' => EmployeeType::Manager,
            'mobile' => '01150559683',
            'status' => EmployeeStatus::Active,
            'week_id' => 7,
            'job_grade_id' => 9,
            'branch_id' => 10,
            'governorate_id' => 24,
        ]);
        $adminUser->assignRole($adminRole);

        $staffUser = Employee::firstOrCreate([
            'username' => 'staff',
        ], [
            'employee_code' => 504,
            'name' => 'Staff',
            'username' => 'staff',
            'password' => Hash::make('password'),
            'gender' => '1',
            'type' => EmployeeType::Manager,
            'mobile' => '01150559683',
            'status' => EmployeeStatus::Active,
            'week_id' => 7,
            'job_grade_id' => 9,
            'branch_id' => 10,
            'governorate_id' => 24,
        ]);
        $staffUser->assignRole($staffRole);

        $staffUser2 = Employee::firstOrCreate([
            'username' => 'heba',
        ], [
            'employee_code' => 505,
            'name' => 'heba',
            'username' => 'heba',
            'password' => Hash::make('password'),
            'gender' => '1',
            'type' => EmployeeType::Manager,
            'mobile' => '01150559683',
            'status' => EmployeeStatus::Active,
            'week_id' => 7,
            'job_grade_id' => 9,
            'branch_id' => 10,
            'governorate_id' => 24,
        ]);
        $staffUser2->assignRole($staffRole);


        $userRole = Employee::firstOrCreate([
            'username' => 'mosama',
        ], [
            'employee_code' => 505,
            'name' => 'heba',
            'username' => 'heba',
            'password' => Hash::make('password'),
            'gender' => '1',
            'type' => EmployeeType::Manager,
            'mobile' => '01150559683',
            'status' => EmployeeStatus::Active,
            'week_id' => 7,
            'job_grade_id' => 9,
            'branch_id' => 10,
            'governorate_id' => 24,
        ]);
        $userRole->assignRole($staffRole);
    }
}
