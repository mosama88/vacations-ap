<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JobGradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('job_grades')->insert(
            [
                ['name' => 'الدرجه الرابعه أ', 'slug'=>'الدرجه-الرابعه-أ'],
                ['name' => 'الدرجه الرابعه ب', 'slug'=>'الدرجه-الرابعه-ب'],
                ['name' => 'الدرجه الرابعه ج', 'slug'=>'الدرجه-الرابعه-ج'],
                ['name' => 'الدرجه الثالثه ج', 'slug'=>'الدرجه-الثالثه-ج'],
                ['name' => 'الدرجه الثالثه ب', 'slug'=>'الدرجه-الثالثه-ب'],
                ['name' => 'الدرجه الثالثه أ', 'slug'=>'الدرجه-الثالثه-أ'],
                ['name' => 'الدرجه الثانية أ', 'slug'=>'الدرجه-الثانية-أ'],
                ['name' => 'الدرجه الثانية ب', 'slug'=>'الدرجه-الثانية-ب'],
                ['name' => 'الدرجه الأولى', 'slug'=>'الدرجه-الأولى'],

            ]
        );
    }
}