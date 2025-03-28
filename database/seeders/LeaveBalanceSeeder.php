<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\LeaveBalance;
use Illuminate\Database\Seeder;


class LeaveBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeaveBalance::factory()->count(1000)->create([
            'employee_id' => Employee::inRandomOrder()->limit(1000)->pluck('id')->toArray(),
        ]);
    }
}
