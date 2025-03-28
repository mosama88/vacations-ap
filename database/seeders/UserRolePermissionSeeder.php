<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Permissions
        $permissions = [
            ['name' => 'view role', 'category' => 'Roles'],
            ['name' => 'create role', 'category' => 'Roles'],
            ['name' => 'update role', 'category' => 'Roles'],
            ['name' => 'delete role', 'category' => 'Roles'],

            ['name' => 'view permission', 'category' => 'Permissions'],
            ['name' => 'create permission', 'category' => 'Permissions'],
            ['name' => 'update permission', 'category' => 'Permissions'],
            ['name' => 'delete permission', 'category' => 'Permissions'],

            ['name' => 'view user', 'category' => 'Users'],
            ['name' => 'create user', 'category' => 'Users'],
            ['name' => 'update user', 'category' => 'Users'],
            ['name' => 'delete user', 'category' => 'Users'],

            ['name' => 'الموظفين', 'category' => 'Employees'],
            ['name' => 'أضافة موظف', 'category' => 'Employees'],
            ['name' => 'تعديل الموظف', 'category' => 'Employees'],
            ['name' => 'حذف الموظف', 'category' => 'Employees'],
            ['name' => 'عرض الموظفين', 'category' => 'Employees'],
            ['name' => 'بيانات الموظفين', 'category' => 'Employees'],
            ['name' => 'عرض حساب الأجازات', 'category' => 'Employees'],
            ['name' => 'عرض كل أجازات الموظف', 'category' => 'Employees'],

        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Create Roles
        $superAdminRole = Role::create(['name' => 'super-admin']); //as super-admin
        $adminRole = Role::create(['name' => 'admin']);
        $staffRole = Role::create(['name' => 'staff']);
        $userRole = Role::create(['name' => 'user']);

        // Lets give all permission to super-admin role.
        $allPermissionNames = Permission::pluck('name')->toArray();
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
        $superAdminUser = User::firstOrCreate([
            'email' => 'superadmin@dt.com',
        ], [
            'name' => 'Super Admin',
            'email' => 'superadmin@dt.com',
            'password' => Hash::make('12345678'),
            'status' => 'active',
        ]);
        $superAdminUser->assignRole($superAdminRole);

        $superAdminUser2 = User::firstOrCreate([
            'email' => 'mosama@dt.com',
        ], [
            'name' => 'محمد أسامه',
            'email' => 'mosama@dt.com',
            'password' => Hash::make('@Osama88'),
            'status' => 'active',
        ]);
        $superAdminUser2->assignRole($superAdminRole);

        $adminUser = User::firstOrCreate([
            'email' => 'admin@dt.com'
        ], [
            'name' => 'Admin',
            'email' => 'admin@dt.com',
            'password' => Hash::make('12345678'),
            'status' => 'active',
        ]);
        $adminUser->assignRole($adminRole);

        $staffUser = User::firstOrCreate([
            'email' => 'staff@dt.com',
        ], [
            'name' => 'Staff',
            'email' => 'staff@dt.com',
            'password' => Hash::make('12345678'),
            'status' => 'inactive',
        ]);
        $staffUser->assignRole($staffRole);

        $staffUser2 = User::firstOrCreate([
            'email' => 'heba@dt.com',
        ], [
            'name' => 'هبة الله سمير',
            'email' => 'heba@dt.com',
            'password' => Hash::make('123456789'),
            'status' => 'active',
        ]);
        $staffUser2->assignRole($staffRole);
    }
}
