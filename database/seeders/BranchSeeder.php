<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('branches')->insert(
            [
                ['name' => 'مبنى القاهرة الجديد', 'governorate_id' => 1, 'created_by' => 1],
                ['name' => 'مبنى رئاسة الهيئة', 'governorate_id' => 2, 'created_by' => 1],
                ['name' => 'نيابة الأسكندرية', 'governorate_id' => 3, 'created_by' => 1],
                ['name' => 'نيابة الإسماعيلية ', 'governorate_id' => 4, 'created_by' => 1],
                ['name' => 'نيابة الدقهلية ', 'governorate_id' => 5, 'created_by' => 1],
                ['name' => 'نيابة أسيوط ', 'governorate_id' => 6, 'created_by' => 1],
                ['name' => 'نيابة السويس ', 'governorate_id' => 7, 'created_by' => 1],
                ['name' => 'نيابة القليوبية ', 'governorate_id' => 8, 'created_by' => 1],
                ['name' => 'نيابة البحيرة ', 'governorate_id' => 9, 'created_by' => 1],
                ['name' => 'الغربية نيابة ', 'governorate_id' => 10, 'created_by' => 1],
                ['name' => 'نيابة دمياط ', 'governorate_id' => 11, 'created_by' => 1],
                ['name' => 'نيابة كفرالشيخ ', 'governorate_id' => 12, 'created_by' => 1],
                ['name' => 'نيابة سوهاج ', 'governorate_id' => 13, 'created_by' => 1],
                ['name' => 'نيابة الأقصر ', 'governorate_id' => 14, 'created_by' => 1],
                ['name' => 'نيابة أسوان ', 'governorate_id' => 15, 'created_by' => 1],
                ['name' => 'نيابة الواحات ', 'governorate_id' => 16, 'created_by' => 1],
                ['name' => 'نيابة الوادي الجديد ', 'governorate_id' => 17, 'created_by' => 1],
                ['name' => 'نيابة البحر الأحمر ', 'governorate_id' => 18, 'created_by' => 1],
                ['name' => 'نيابة قنا ', 'governorate_id' => 19, 'created_by' => 1],
                ['name' => 'نيابة المنيا ', 'governorate_id' => 20, 'created_by' => 1],
                ['name' => 'نيابة جنوب سيناء ', 'governorate_id' => 21, 'created_by' => 1],
                ['name' => 'نيابة شمال سيناء ', 'governorate_id' => 22, 'created_by' => 1],
                ['name' => 'نيابة مطروح ', 'governorate_id' => 23, 'created_by' => 1],
                ['name' => 'نيابة بنها ', 'governorate_id' => 24, 'created_by' => 1],
                ['name' => 'نيابة الفيوم ', 'governorate_id' => 25, 'created_by' => 1],
                ['name' => 'نيابة بنى سويف ', 'governorate_id' => 26, 'created_by' => 1],
                ['name' => 'نيابة الشرقيه ', 'governorate_id' => 27, 'created_by' => 1],
                ['name' => 'نيابة المنوفية ', 'governorate_id' => 28, 'created_by' => 1],
            ]
        );
    }
}