<?php

namespace Database\Factories;

use App\Models\Week;
use App\Models\Admin;
use App\Models\Branch;
use App\Models\JobGrade;
use App\Enum\EmployeeType;
use App\Models\Governorate;
use Illuminate\Support\Str;
use App\Enum\EmployeeGender;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {  // تعريف أسماء البنات
        $femaleNames = [
            'فاطمة',
            'عائشة',
            'خديجة',
            'زينب',
            'سارة',
            'مريم',
            'نور',
            'هبة',
            'آلاء',
            'رنا',
            'ياسمين',
            'أسماء',
            'رغد',
            'حلا',
            'شيماء',
            'ريم',
            'هدى',
            'ليلى',
            'لبنى',
            'بتول',
            'سلمى',
            'أميرة',
            'إيمان',
            'ندى',
            'حنان',
            'رحمة',
            'عبير',
            'بسمة',
            'ميساء',
            'صفاء',
            'روان',
            'ملك',
            'جنى',
            'تاليا',
            'مها',
            'أماني',
            'رؤى',
            'إلهام',
            'جيهان',
            'نوال',
            'نورهان',
            'شذى',
            'مرح',
            'آية',
            'لينا',
            'ماريا',
            'ديما',
            'سندس',
            'لمى',
            'تالين',
            'روز',
            'سجى',
            'ناهد',
            'ميرفت',
            'ابتسام',
            'زهرة',
            'وفاء',
            'سناء',
            'رينا',
            'سحر',
            'سهى',
            'صابرين',
            'إسراء',
            'ميسون',
            'جود',
            'رغد',
            'رهف',
            'فرح',
            'شهد',
            'حور',
            'ناريمان',
            'كارمن',
            'بيان',
            'أسيل',
            'تقى',
            'يسرى',
            'أحلام',
            'عبلة',
            'سيرين',
            'لورين',
            'ريما',
            'غادة',
            'نجلاء',
            'رابية',
            'أريج',
            'بشرى',
            'ضحى',
            'هند',
            'حياة',
            'شهد',
            'كنزة',
            'كوثر',
            'فريال',
            'نعيمة',
            'نجوى',
            'ملاك',
            'صفية',
            'آمال',
            'هناء',
            'لارا',
            'رانيا',
            'غزل',
            'لجين',
            'ألفة',
            'نهى',
            'آسيا',
            'مروة',
            'جميلة',
            'أسما',
            'روبي',
            'تولين',
            'علا',
            'خلود',
            'عبير',
            'نرمين',
            'بثينة',
            'منال',
            'غيداء',
            'سدين',
            'راما',
            'ماريا',
            'جنان',
            'لميس',
            'مارلين',
            'تالين',
            'مرام',
            'ديما',
            'صفاء',
            'شهد',
            'فداء',
            'رحاب',
            'عبلة',
            'نورين',
            'سهاد',
            'ميسر',
            'آية',
            'هبة الله',
            'لبنى',
            'لورا',
            'ريحانة',
            'هنادي',
            'ربى',
            'لين',
            'هلا',
            'هالة',
            'جواهر',
            'رغدة',
            'ليان',
            'سهير',
            'داليا',
            'حنين',
            'سحر',
            'لمى',
            'ندى',
            'نوران',
            'سلسبيل',
            'جنى',
            'وسن',
            'يسرى',
            'سمية',
            'ميس',
            'تالة',
            'جنة',
            'مي',
            'رُبى',
            'رهام',
            'سوار',
            'عفاف',
            'آمنة',
            'ساجدة',
            'عبير',
            'نور',
            'هدى',
            'رغد',
            'حسناء',
            'دينا',
            'ريما',
            'لميس',
            'أروى',
            'بشرى',
            'نايا',
            'رند',
            'تاليا',
            'شهد',
            'لينا',
            'نيرمين',
            'سنا',
            'سهاد',
            'ماريا',
            'نغم',
            'تسنيم',
            'صفا',
            'ليلى',
            'غادة',
            'منار',
            'ميساء',
            'زينة',
            'خولة',
            'بيسان',
            'رويدا',
            'تهاني',
            'رزان',
            'نهال',
            'نورين',
            'وسام',
            'حنين',
            'ريتال',
            'فرح',
            'شذى',
            'إيناس',
            'أمينة',
            'سجا',
            'رؤى',
            'مها',
            'ديانا',
            'ميرال',
            'مرح',
            'ليندا',
            'مارلين',
            'بنان',
            'ليان',
            'رولا',
            'ناريمان',
            'مارية',
            'شوق',
            'لارين',
            'بيلسان',
            'إيلاف',
            'جود',
            'كرمة',
            'عروب',
            'إيمان',
            'يسرا',
            'خلود',
            'آية',
            'تولين',
            'لاما',
            'رواء',
            'شهد',
            'ميسم',
            'نورهان',
            'مروى',
            'نوف',
            'ريحان',
            'حلا',
            'ديمة',
            'يمنى',
            'عالية',
            'شهدان',
            'آمنة',
            'زهراء',
            'مها',
            'صفية',
            'كوثر',
            'سارة',
            'عفاف',
            'سلمى',
            'صوفيا',
            'ماجدة',
            'هناء',
            'سميرة',
            'نجوان',
            'بهية',
            'ميرا',
            'ندى',
            'رغدة',
            'سوسن',
            'عزة',
            'ضحى',
            'ريهام',
            'لؤلؤة',
            'نسمة',
            'جنان',
            'دارين',
            'ماريا',
            'نورين',
            'بثينة',
            'هند',
            'رجاء',
            'روضة',
            'بتلاء',
            'وجدان',
            'لمار',
            'ماريا',
            'كنزي',
            'آلاء',
            'رينا',
            'حسنة',
            'حياة',
            'بسمة',
            'إسراء',
            'سجى',
            'رانيا',
            'خلود',
            'نعمة',
            'ليليا',
            'رابية',
            'ريحانة',
            'دارين',
            'فرحة',
            'ساهرة',
            'رحمة',
            'وصال',
            'عائشة',
            'هبة الله',
            'بدرية',
            'بياضة',
            'ملك',
            'نهى',
            'ليلة',
        ];

        // تعريف أسماء الأولاد
        $maleNames = [
            'أحمد',
            'محمد',
            'علي',
            'يوسف',
            'عمر',
            'حسن',
            'إبراهيم',
            'إسماعيل',
            'مالك',
            'أيمن',
            'سالم',
            'حمزة',
            'آدم',
            'سعيد',
            'زيد',
            'عبدالله',
            'عبدالرحمن',
            'سليمان',
            'مصطفى',
            'حسين',
            'فارس',
            'رامي',
            'ماهر',
            'جمال',
            'كريم',
            'نور',
            'صهيب',
            'شادي',
            'أنس',
            'باسل',
            'زياد',
            'طارق',
            'ياسر',
            'هيثم',
            'عبدالعزيز',
            'مهند',
            'عبداللطيف',
            'علاء',
            'حاتم',
            'رائد',
            'سامي',
            'عماد',
            'وائل',
            'حامد',
            'عدنان',
            'عامر',
            'بكر',
            'توفيق',
            'يحيى',
            'حذيفة',
            'عمار',
            'نادر',
            'باسم',
            'رامز',
            'إلياس',
            'نبيل',
            'صابر',
            'منصور',
            'ربيع',
            'شريف',
            'بدر',
            'عبدالباسط',
            'عبدالحكيم',
            'عبدالسلام',
            'عبدالكريم',
            'عبدالحميد',
            'عبدالفتاح',
            'عبدالرزاق',
            'عبدالحي',
            'محمود',
            'عصام',
            'رشيد',
            'أمجد',
            'أكرم',
            'تامر',
            'سامر',
            'لؤي',
            'سهيل',
            'رياض',
            'رفيق',
            'وجيه',
            'أديب',
            'قاسم',
            'ناجي',
            'زين',
            'مازن',
            'أنور',
            'أيوب',
            'عادل',
            'ثامر',
            'معاذ',
            'راغب',
            'شاكر',
            'سيف',
            'طلال',
            'جواد',
            'بشار',
            'منذر',
            'سامح',
            'وائل',
            'عبدالمجيد',
            'هشام',
            'رائد',
            'شوقي',
            'عبدالرؤوف',
            'عبدالوهاب',
            'عبدالودود',
            'إيهاب',
            'عطا',
            'فضل',
            'جلال',
            'مروان',
            'شهاب',
            'معتز',
            'وضاح',
            'زكريا',
            'حاتم',
            'ليث',
            'عمرو',
            'أوس',
            'حمود',
            'مؤيد',
            'رائف',
            'سراج',
            'ضياء',
            'كنعان',
            'معين',
            'وسام',
            'نزار',
            'ظافر',
            'حذيفة',
            'نصار',
            'غسان',
            'كرم',
            'شمس',
            'هاني',
            'ممتاز',
            'صفوان',
            'عبد',
            'عدلي',
            'نجيب',
            'مراد',
            'سائد',
            'نواف',
            'سلطان',
            'عبدالرازق',
            'حكيم',
            'مجاهد',
            'فهد',
            'رعد',
            'عبدالصمد',
            'وسيم',
            'ياسين',
            'أصيل',
            'لطفي',
            'عابد',
            'قيس',
            'شاكر',
            'نافع',
            'واصف',
            'وفيق',
            'عبدالحليم',
            'رجاء',
            'نورالدين',
            'مصلح',
            'شفيق',
            'عبدالقدوس',
            'سليم',
            'صالح',
            'غازي',
            'مجدي',
            'مفيد',
            'نبهان',
            'زكي',
            'حسان',
            'منيف',
            'محسن',
            'راشد',
            'فؤاد',
            'مشعل',
            'عبدالرزاق',
            'أحمدان',
            'جبر',
            'ثابت',
            'وسام',
            'مدحت',
            'شوقي',
            'منصور',
            'فواز',
            'خطاب',
            'نصر',
            'يزيد',
            'خالد',
            'بلال',
            'سهوان',
            'جواد',
            'صفوان',
            'كرم',
            'ماهر',
            'نصار',
            'هيثم',
            'أيهم',
            'مخلص',
            'مقداد',
            'ضياء',
            'مهيب',
            'عبود',
            'لطفي',
            'مهدي',
            'قسام',
            'براء',
            'مصطفى',
            'عارف',
            'غالي',
            'أكرم',
            'نور',
            'أسامة',
            'راغب',
            'عزام',
            'مازن',
            'طاهر',
            'منجد',
            'وجيه',
            'أيمن',
            'رياض',
            'رامز',
            'نضال',
            'عوني',
            'مصلح',
            'راضي',
            'حامد',
            'محيي',
            'عبدالودود',
            'أدهم',
            'أمين',
            'فاضل',
            'سهيل',
            'شاهر',
            'بلال',
            'فخري',
            'مؤمن',
            'فطين',
            'نزار',
            'عصمت',
            'نهاد',
            'فراس',
            'باسم',
            'هارون',
            'حمد',
            'طلال',
            'رماح',
            'قادر',
            'بشر',
            'وديع',
            'عدنان',
            'فيصل',
            'رامي',
            'سرمد',
            'بسام',
            'بكر',
            'أنيس',
            'إبراهيم',
            'طارق',
            'مليح',
            'كنعان',
            'نواف',
            'صفوان',
            'ناجي',
            'جواد',
            'ساري',
            'مأمون',
            'بديع',
            'مهند',
            'غسان',
            'ليث',
            'سعد',
            'ياسر',
            'قيس',
            'صالح',
            'محفوظ',
            'زهران',
            'وضاح',
            'إيهاب',
            'شعبان',
            'ربيع',
            'عمران',
            'رامح',
            'مرشد',
            'منيب',
            'سراجي',
            'برهان',
            'منجد',
            'بدر',
            'يزن',
            'حسان',
            'محمود',
            'عبدالعليم',
            'صفوان',
            'عزام',
            'زكريا',
            'يونس',
            'نبيل',
            'وجيه',
            'مخلص',
            'بلال',
            'فرحان',
            'وسيم',
            'مراد',
            'شادي',
            'رفيق',
            'أصيل',
            'محسن',
            'مبارك',
            'معاوية',
            'معتصم',
            'مكين',
            'عبدالحافظ',
            'ناجي',
            'طلال',
            'نبراس',
            'علوان',
            'منير',
            'فخري',
            'شاهين',
            'صابر',
            'غريب',
            'مزاحم',
            'يوسف',
            'وليد',
            'زاهر',
            'عامر',
            'سالم',
            'سراج',
            'سلامة',
            'صبري',
            'شمس',
            'لؤي',
            'عبدالباري',
            'عوض',
            'فهد',
            'مصعب',
            'خاطر',
            'عبدالمحسن',
            'فتحي',
            'مدين',
            'عطاالله',
            'كمال',
            'أكرم',
            'مرشد',
            'حارث',
            'شعلان',
            'يونس',
            'شاهر',
            'نواف',
            'شرف',
            'وجيه',
            'علاء',
            'باسل',
            'مطيع',
            'سائد',
            'ساجي',
            'سامح',
            'عبداللطيف',
            'أصيل',
            'أوس',
            'حكيم',
            'حميد',
            'سهيل',
            'عبدالكبير',
            'سامي',
            'ثروت',
            'زين',
            'براء',
            'أنور',
            'راغب',
            'رؤوف',
            'عزيز',
            'ناصيف',
            'بكر',
            'غالب',
            'شاهر',
            'رامي',
            'يوسف',
            'مؤيد',
            'نضال',
            'عبدالرحيم',
            'محجوب',
            'معروف',
            'عفيف',
            'عليان',
            'هيثم',
            'شفيق',
            'وحيد',
            'رشاد',
            'بهاء',
            'زاهر',
            'ربيع',
            'بشار',
            'سهوان',
            'وسيم',
            'حيدر',
            'شعلان',
            'شهاب',
            'مختار',
            'شاهين',
            'مقصود',
            'سامي',
            'مازن',
            'أشرف',
            'مختار',
            'صفوت',
            'ضياء',
            'عيسى',
            'مبارك',
            'عبدالبارئ',
            'شهاب',
            'علاء',
            'حبيب',
            'مخلص',
            'رائد',
            'عبدالرزاق',
            'مؤمن',
            'ماجد',
            'محمود',
            'عبدالفتاح',
            'نبيل',
            'حسان',
            'ناجي',
            'سامر',
            'عصام',
            'عبدالحليم',
            'بكر',
            'خالد',
            'نزار',
            'حارث',
            'عبدالمحسن',
            'فراس',
            'قيس',
            'عبدالكريم',
            'يوسف',
            'عبدالوهاب',
            'نهاد',
            'هيثم',

        ];

        // خلط الأسماء
        shuffle($maleNames);
        shuffle($femaleNames);

        // تحديد الجنس
        $gender = fake()->randomElement([EmployeeGender::Male, EmployeeGender::Female]);

        // توليد الاسم حسب الجنس
        $name = $gender === EmployeeGender::Male
            ? implode(' ', array_slice($maleNames, 0, 3))  // أسماء ذكور فقط
            : fake()->randomElement($femaleNames) . ' ' . implode(' ', array_slice($maleNames, 0, 2));  // اسم بنت + اسمين ذكور

        // توليد اسم المستخدم من الاسم
        $nameParts = explode(' ', $name);
        $username = '';

        foreach ($nameParts as $i => $part) {
            if ($i < count($nameParts) - 1) {
                $username .= mb_substr($part, 0, 1); // أول حرف من كل اسم ما عدا الأخير
            } else {
                $username .= mb_substr($part, 0, 4); // أول 4 حروف من آخر اسم
            }
        }

        // إزالة أي رموز وتحويله لصيغة صالحة كـ username
        $username = Str::slug($username, '');

        return [
            'employee_code' => fake()->unique()->numberBetween(1000, 9999),
            'gender' => $gender,
            'name' => $name,
            'username' => $username,
            'password' => Hash::make('password'), // Hashing the password
            'mobile' => fake()->regexify('/^(012|015|010|011)[0-9]{8}$/'),
            'type' => fake()->randomElement([EmployeeType::User, EmployeeType::Manager]),
            'branch_id' => Branch::inRandomOrder()->first()->id,
            'governorate_id' => Governorate::inRandomOrder()->first()->id,
            'job_grade_id' => JobGrade::inRandomOrder()->first()->id,
            'week_id' => Week::inRandomOrder()->first()->id,
            'created_by' => Admin::all()->random()->id,
            'remember_token' => Str::random(10),
        ];
    }
}
