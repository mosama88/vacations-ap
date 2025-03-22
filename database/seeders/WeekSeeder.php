<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class WeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        DB::table('weeks')->insert(
            [
                ['name' => 'السبت'],
                ['name' => 'الأحد'],
                ['name' => 'الأثنين'],
                ['name' => 'الثلاثاء'],
                ['name' => 'الآربعاء'],
                ['name' => 'الخميس'],
                ['name' => 'الجمعه'],
            ]
        );
    }
}