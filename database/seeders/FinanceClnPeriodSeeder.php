<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FinanceClnPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('finance_cln_periods')->insert([
            ['id' => 1, 'finance_calendar_id' => 1, 'finance_yr' => '2024', 'month_id' => 6, 'year_and_month' => '2024-06', 'start_date_month' => '2024-06-01', 'end_date_month' => '2024-06-30', 'number_of_days' => 30, 'status' => '0', 'created_by' => 11, 'updated_by' => 11, 'created_at' => '2025-03-25 22:35:38', 'updated_at' => '2025-03-25 22:35:38'],
            ['id' => 2, 'finance_calendar_id' => 1, 'finance_yr' => '2024', 'month_id' => 7, 'year_and_month' => '2024-07', 'start_date_month' => '2024-07-01', 'end_date_month' => '2024-07-31', 'number_of_days' => 31, 'status' => '0', 'created_by' => 11, 'updated_by' => 11, 'created_at' => '2025-03-25 22:35:38', 'updated_at' => '2025-03-25 22:35:38'],
            ['id' => 3, 'finance_calendar_id' => 1, 'finance_yr' => '2024', 'month_id' => 8, 'year_and_month' => '2024-08', 'start_date_month' => '2024-08-01', 'end_date_month' => '2024-08-31', 'number_of_days' => 31, 'status' => '0', 'created_by' => 11, 'updated_by' => 11, 'created_at' => '2025-03-25 22:35:38', 'updated_at' => '2025-03-25 22:35:38'],
            ['id' => 4, 'finance_calendar_id' => 1, 'finance_yr' => '2024', 'month_id' => 9, 'year_and_month' => '2024-09', 'start_date_month' => '2024-09-01', 'end_date_month' => '2024-09-30', 'number_of_days' => 30, 'status' => '0', 'created_by' => 11, 'updated_by' => 11, 'created_at' => '2025-03-25 22:35:38', 'updated_at' => '2025-03-25 22:35:38'],
            ['id' => 5, 'finance_calendar_id' => 1, 'finance_yr' => '2024', 'month_id' => 10, 'year_and_month' => '2024-10', 'start_date_month' => '2024-10-01', 'end_date_month' => '2024-10-31', 'number_of_days' => 31, 'status' => '0', 'created_by' => 11, 'updated_by' => 11, 'created_at' => '2025-03-25 22:35:38', 'updated_at' => '2025-03-25 22:35:38'],
            ['id' => 6, 'finance_calendar_id' => 1, 'finance_yr' => '2024', 'month_id' => 11, 'year_and_month' => '2024-11', 'start_date_month' => '2024-11-01', 'end_date_month' => '2024-11-30', 'number_of_days' => 30, 'status' => '0', 'created_by' => 11, 'updated_by' => 11, 'created_at' => '2025-03-25 22:35:38', 'updated_at' => '2025-03-25 22:35:38'],
            ['id' => 7, 'finance_calendar_id' => 1, 'finance_yr' => '2024', 'month_id' => 12, 'year_and_month' => '2024-12', 'start_date_month' => '2024-12-01', 'end_date_month' => '2024-12-31', 'number_of_days' => 31, 'status' => '0', 'created_by' => 11, 'updated_by' => 11, 'created_at' => '2025-03-25 22:35:38', 'updated_at' => '2025-03-25 22:35:38'],
            ['id' => 8, 'finance_calendar_id' => 1, 'finance_yr' => '2024', 'month_id' => 1, 'year_and_month' => '2025-01', 'start_date_month' => '2025-01-01', 'end_date_month' => '2025-01-31', 'number_of_days' => 31, 'status' => '0', 'created_by' => 11, 'updated_by' => 11, 'created_at' => '2025-03-25 22:35:38', 'updated_at' => '2025-03-25 22:35:38'],
            ['id' => 9, 'finance_calendar_id' => 1, 'finance_yr' => '2024', 'month_id' => 3, 'year_and_month' => '2025-03', 'start_date_month' => '2025-03-01', 'end_date_month' => '2025-03-31', 'number_of_days' => 31, 'status' => '0', 'created_by' => 11, 'updated_by' => 11, 'created_at' => '2025-03-25 22:35:38', 'updated_at' => '2025-03-25 22:35:38'],
            ['id' => 10, 'finance_calendar_id' => 1, 'finance_yr' => '2024', 'month_id' => 4, 'year_and_month' => '2025-04', 'start_date_month' => '2025-04-01', 'end_date_month' => '2025-04-30', 'number_of_days' => 30, 'status' => '0', 'created_by' => 11, 'updated_by' => 11, 'created_at' => '2025-03-25 22:35:38', 'updated_at' => '2025-03-25 22:35:38'],
            ['id' => 11, 'finance_calendar_id' => 1, 'finance_yr' => '2024', 'month_id' => 5, 'year_and_month' => '2025-05', 'start_date_month' => '2025-05-01', 'end_date_month' => '2025-05-31', 'number_of_days' => 31, 'status' => '0', 'created_by' => 11, 'updated_by' => 11, 'created_at' => '2025-03-25 22:35:38', 'updated_at' => '2025-03-25 22:35:38'],
            ['id' => 12, 'finance_calendar_id' => 1, 'finance_yr' => '2024', 'month_id' => 6, 'year_and_month' => '2025-06', 'start_date_month' => '2025-06-01', 'end_date_month' => '2025-06-30', 'number_of_days' => 30, 'status' => '0', 'created_by' => 11, 'updated_by' => 11, 'created_at' => '2025-03-25 22:35:38', 'updated_at' => '2025-03-25 22:35:38'],
            ['id' => 13, 'finance_calendar_id' => 1, 'finance_yr' => '2024', 'month_id' => 7, 'year_and_month' => '2025-07', 'start_date_month' => '2025-07-01', 'end_date_month' => '2025-07-31', 'number_of_days' => 31, 'status' => '0', 'created_by' => 11, 'updated_by' => 11, 'created_at' => '2025-03-25 22:35:38', 'updated_at' => '2025-03-25 22:35:38']
        ]);
    }
}