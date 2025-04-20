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

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);



        $this->call([
            WeekSeeder::class,
            MonthSeeder::class,
            FinanceCalendarSeeder::class,
            GovernorateSeeder::class,
            BranchSeeder::class,
            JobGradeSeeder::class,
            // EmployeeSeeder::class,
            // LeaveBalanceFactory::class,
        ]);
    }
}