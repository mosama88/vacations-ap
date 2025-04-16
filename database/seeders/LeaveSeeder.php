<?php

namespace Database\Seeders;

use App\Models\Leave;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Leave::factory()->count(1000)->create();
    }
}