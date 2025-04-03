<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FinanceCalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('finance_calendars')->insert([
            [
                'id' => 1,
                'finance_yr' => '2024',
                'finance_yr_desc' => 'السنه المالية لسنه 2024',
                'start_date' => '2024-06-30',
                'end_date' => '2025-07-01',
                'status' => '1',
                'created_at' => '2025-03-25 22:35:38',
                'updated_at' => '2025-03-25 22:35:38',
            ]
        ]);
    }
}