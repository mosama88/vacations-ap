<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('months')->insert(
            [
                ['name' => json_encode(['en' => 'January', 'ar' => 'يناير'])],
                ['name' => json_encode(['en' => 'February', 'ar' => 'فبراير'])],
                ['name' => json_encode(['en' => 'March', 'ar' => 'مارس'])],
                ['name' => json_encode(['en' => 'April', 'ar' => 'أبريل'])],
                ['name' => json_encode(['en' => 'May', 'ar' => 'مايو'])],
                ['name' => json_encode(['en' => 'June', 'ar' => 'يونيو'])],
                ['name' => json_encode(['en' => 'July', 'ar' => 'يوليو'])],
                ['name' => json_encode(['en' => 'August', 'ar' => 'أغسطس'])],
                ['name' => json_encode(['en' => 'September', 'ar' => 'سبتمبر'])],
                ['name' => json_encode(['en' => 'October', 'ar' => 'اكتوبر'])],
                ['name' => json_encode(['en' => 'November', 'ar' => 'نوفمبر'])],
                ['name' => json_encode(['en' => 'December', 'ar' => 'ديسمبر'])],
            ]
        );
    }
}