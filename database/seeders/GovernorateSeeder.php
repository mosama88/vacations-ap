<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('governorates')->insert(
            [
                ['name' => 'القاهرة'],
                ['name' => 'الجيزه'],
                ['name' => 'الاسكندرية'],
                ['name' => 'الإسماعيلية'],
                ['name' => 'الدقهلية'],
                ['name' => 'أسيوط'],
                ['name' => 'السويس'],
                ['name' => 'القليوبية'],
                ['name' => 'البحيرة'],
                ['name' => 'الغربية'],
                ['name' => 'دمياط'],
                ['name' => 'كفرالشيخ'],
                ['name' => 'سوهاج'],
                ['name' => 'الأقصر'],
                ['name' => 'أسوان'],
                ['name' => 'الواحات'],
                ['name' => 'الوادي الجديد'],
                ['name' => 'البحر الأحمر'],
                ['name' => 'قنا'],
                ['name' => 'المنيا'],
                ['name' => 'جنوب سيناء'],
                ['name' => 'شمال سيناء'],
                ['name' => 'مطروح'],
                ['name' => 'بنها'],
                ['name' => 'الفيوم'],
                ['name' => 'بنى سويف'],
                ['name' => 'الشرقيه'],
                ['name' => 'المنوفية'],
            ]
        );
    }
}