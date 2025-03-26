<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\LeaveBalanceFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Admin::factory()->create([
            'name' => 'محمد أسامه',
            'username' => 'mosama',
        ]);


        $this->call([
            WeekSeeder::class,
            MonthSeeder::class,
            GovernorateSeeder::class,
            BranchSeeder::class,
            JobGradeSeeder::class,
            EmployeeSeeder::class,
            LeaveBalanceFactory::class,
        ]);
    }
}