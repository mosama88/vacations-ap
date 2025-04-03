<?php

namespace Database\Seeders;

use App\Models\LeaveBalance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeaveBalance::factory()->count(160)->create();
    }
}