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
                ['name' => 'مبنى القاهرة الجديد', 'slug' => 'مبنى-القاهرة-الجديد', 'governorate_id' => 1],
                ['name' => 'مبنى رئاسة الهيئة', 'slug' => 'مبنى-رئاسة-الهيئة', 'governorate_id' => 2],
                ['name' => 'نيابة الأسكندرية', 'slug' => 'نيابة-الأسكندرية', 'governorate_id' => 3],
                ['name' => 'نيابة الإسماعيلية ', 'slug' => 'نيابة-الإسماعيلية ', 'governorate_id' => 4],
                ['name' => 'نيابة الدقهلية ', 'slug' => 'نيابة-الدقهلية ', 'governorate_id' => 5],
                ['name' => 'نيابة أسيوط ', 'slug' => 'نيابة-أسيوط ', 'governorate_id' => 6],
                ['name' => 'نيابة السويس ', 'slug' => 'نيابة-السويس ', 'governorate_id' => 7],
                ['name' => 'نيابة القليوبية ', 'slug' => 'نيابة-القليوبية ', 'governorate_id' => 8],
                ['name' => 'نيابة البحيرة ', 'slug' => 'نيابة-البحيرة ', 'governorate_id' => 9],
                ['name' => 'الغربية نيابة ', 'slug' => 'نيابة-الغربية ', 'governorate_id' => 10],
                ['name' => 'نيابة دمياط ', 'slug' => 'نيابة-دمياط ', 'governorate_id' => 11],
                ['name' => 'نيابة كفرالشيخ ', 'slug' => 'نيابة-كفرالشيخ ', 'governorate_id' => 12],
                ['name' => 'نيابة سوهاج ', 'slug' => 'نيابة-سوهاج ', 'governorate_id' => 13],
                ['name' => 'نيابة الأقصر ', 'slug' => 'نيابة-الأقصر ', 'governorate_id' => 14],
                ['name' => 'نيابة أسوان ', 'slug' => 'نيابة-أسوان ', 'governorate_id' => 15],
                ['name' => 'نيابة الواحات ', 'slug' => 'نيابة-الواحات ', 'governorate_id' => 16],
                ['name' => 'نيابة الوادي الجديد ', 'slug' => 'نيابة-الوادي-الجديد ', 'governorate_id' => 17],
                ['name' => 'نيابة البحر الأحمر ', 'slug' => 'نيابة-البحر-الأحمر ', 'governorate_id' => 18],
                ['name' => 'نيابة قنا ', 'slug' => 'نيابة-قنا ', 'governorate_id' => 19],
                ['name' => 'نيابة المنيا ', 'slug' => 'نيابة-المنيا ', 'governorate_id' => 20],
                ['name' => 'نيابة جنوب سيناء ', 'slug' => 'نيابة-جنوب-سيناء ', 'governorate_id' => 21],
                ['name' => 'نيابة شمال سيناء ', 'slug' => 'نيابة-شمال-سيناء ', 'governorate_id' => 22],
                ['name' => 'نيابة مطروح ', 'slug' => 'نيابة-مطروح ', 'governorate_id' => 23],
                ['name' => 'نيابة بنها ', 'slug' => 'نيابة-بنها ', 'governorate_id' => 24],
                ['name' => 'نيابة الفيوم ', 'slug' => 'نيابة-الفيوم ', 'governorate_id' => 25],
                ['name' => 'نيابة بنى سويف ', 'slug' => 'نيابة-بنى-سويف ', 'governorate_id' => 26],
                ['name' => 'نيابة الشرقيه ', 'slug' => 'نيابة-الشرقيه ', 'governorate_id' => 27],
                ['name' => 'نيابة المنوفية ', 'slug' => 'نيابة-المنوفية ', 'governorate_id' => 28],
            ]
        );
    }
}