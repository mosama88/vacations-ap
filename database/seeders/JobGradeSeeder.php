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
                ['name' => 'الدرجه الرابعه أ', 'slug'=>'الدرجه-الرابعه-أ','created_by' => 1],
                ['name' => 'الدرجه الرابعه ب', 'slug'=>'الدرجه-الرابعه-ب','created_by' => 1],
                ['name' => 'الدرجه الرابعه ج', 'slug'=>'الدرجه-الرابعه-ج','created_by' => 1],
                ['name' => 'الدرجه الثالثه ج', 'slug'=>'الدرجه-الثالثه-ج','created_by' => 1],
                ['name' => 'الدرجه الثالثه ب', 'slug'=>'الدرجه-الثالثه-ب','created_by' => 1],
                ['name' => 'الدرجه الثالثه أ', 'slug'=>'الدرجه-الثالثه-أ','created_by' => 1],
                ['name' => 'الدرجه الثانية أ', 'slug'=>'الدرجه-الثانية-أ','created_by' => 1],
                ['name' => 'الدرجه الثانية ب', 'slug'=>'الدرجه-الثانية-ب','created_by' => 1],
                ['name' => 'الدرجه الأولى', 'slug'=>'الدرجه-الأولى','created_by' => 1],

            ]
        );
    }
}