<?php

use App\Models\Branch;
use App\Models\Governorate;
use App\Models\JobGrade;
use App\Models\Week;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_code')->unique();
            $table->string('name', 255);
            $table->string('slug', 255)->nullable();
            $table->string('username', 20)->unique();
            $table->string('password')->nullable();
            $table->enum('gender', [0, 1]);
            $table->enum('type', [0, 1]);
            $table->string('mobile');
            $table->integer('total_days_balance')->nullable();
            $table->enum('status', [0, 1])->default(1);
            $table->foreignIdFor(Week::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(JobGrade::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Branch::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Governorate::class)->nullable()->constrained()->nullOnDelete();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};


// INSERT INTO `employees` (`id`, `employee_code`, `name`, `slug`, `username`, `password`, `gender`, `type`, `mobile`, `total_days_balance`, `status`, `week_id`, `job_grade_id`, `branch_id`, `governorate_id`, `remember_token`, `created_at`, `updated_at`) VALUES
// (1, 2221, 'مزاحم رعد شوقي', 'mzahm-raad-shoky', 'mrshoky', '$2y$12$lPjnxIE8DOVuOsKAQr..Xu.44YnVJ5XtrSg6b1p8QNiO83P9W6ZXS', '0', '0', '01251540211', 30, '1', 4, 7, 3, 10, 'kU04PRcVKU', '2025-04-08 09:12:40', '2025-04-08 09:12:40'),
// (2, 5806, 'سهاد قاسم حميد', 'shad-kasm-hmyd', 'skhmyd', '$2y$12$K.zMJCk.H12BzqyMEcENvuXdAXuoeHjHkAcOJ/7vJ8HKyjoJPkJNe', '1', '1', '01558090989', 21, '1', 4, 3, 18, 6, 'Y74zyddYVc', '2025-04-08 09:12:40', '2025-04-08 09:12:40'),
// (3, 5310, 'تسنيم قاسم حسين', 'tsnym-kasm-hsyn', 'tkhsyn', '$2y$12$rj/06y.Er6xbmx6QoaoXOul5wKPwuGPX94ve9QzhxQ8Yb2NvqZHkC', '1', '0', '01573284727', 21, '1', 3, 3, 2, 27, 'nM06yuW9Nf', '2025-04-08 09:12:41', '2025-04-08 09:12:41'),
// (4, 3801, 'غادة شرف عزام', 'ghad-shrf-aazam', 'ghshaa', '$2y$12$Hekssx8/grnKdaNfFCORPegGP3mjZJog5V.Wejse31uD.qbyhHHn6', '1', '1', '01135849084', 21, '1', 5, 1, 14, 6, 'EKyIpf1GkU', '2025-04-08 09:12:41', '2025-04-08 09:12:41'),
// (5, 7287, 'وجدان وسام أدهم', 'ogdan-osam-adhm', 'ooadhm', '$2y$12$X12r.GiD3mlGmkcw8c25v.mmPKXkxgXwADi3lNSI.9/rlJl95wCOm', '1', '1', '01048181019', 30, '1', 1, 1, 20, 21, 'Ntws840MjD', '2025-04-08 09:12:41', '2025-04-08 09:12:41'),
// (6, 6820, 'رولا حمزة مهند', 'rola-hmz-mhnd', 'rhmhnd', '$2y$12$KtRNM72DLabLWzlhrecwnecn95ioSGqT43gnvYvWzS.WRhkMqb0De', '1', '0', '01525837007', 21, '1', 1, 3, 2, 12, 'GLanzaIVHv', '2025-04-08 09:12:41', '2025-04-08 09:12:41'),
// (7, 8997, 'سهوان عمار عبداللطيف', 'shoan-aamar-aabdalltyf', 'saaaabd', '$2y$12$30ZVAdBmdqq94BNVYjLfkO79G8vpk2r4drz5lWDS3aOxXFFFrYz/e', '0', '1', '01225476827', 21, '1', 5, 3, 8, 3, 'I4SwedmEBa', '2025-04-08 09:12:41', '2025-04-08 09:12:41'),
// (8, 3822, 'هاني تامر عمار', 'hany-tamr-aamar', 'htaama', '$2y$12$pbovNqAg6xqjRSOPVlEUEueeevUfbAZLxzavu8FHsDIIIkeGmC8c2', '0', '0', '01530732483', 45, '1', 1, 2, 24, 26, '7pLm4dniyM', '2025-04-08 09:12:41', '2025-04-08 09:12:41'),
// (9, 6696, 'لورا هيثم عبدالسلام', 'lora-hythm-aabdalslam', 'lhaabd', '$2y$12$esrrLsDP1b8hWywjqh.UmecHWetmwZKMtJnyVHfb/0bGPKQpScWMq', '1', '1', '01551174269', 21, '1', 6, 7, 16, 1, 'f0OjtpY8B4', '2025-04-08 09:12:41', '2025-04-08 09:12:41'),
// (10, 8910, 'مطيع مؤيد مهدي', 'mtyaa-moyd-mhdy', 'mmmhdy', '$2y$12$XS5rbteJYMvODc3dgL54o.kwj1bxvFiWaTmkJNWeo8QoqsMtC4LNm', '0', '1', '01088613405', 45, '1', 3, 3, 17, 28, 'bnBAzobtCQ', '2025-04-08 09:12:41', '2025-04-08 09:12:41'),
// (11, 6362, 'جمال عبدالودود حسن', 'gmal-aabdalodod-hsn', 'gaahsn', '$2y$12$MZB8jJusQiu1P7SAOR5v1OdkSJXztfCynBOEvLFvRVOLjulZtMEA2', '0', '1', '01201567443', 21, '1', 6, 5, 28, 4, '9gCFj06HpV', '2025-04-08 09:12:42', '2025-04-08 09:12:42'),
// (12, 7700, 'سائد فطين نضال', 'sayd-ftyn-ndal', 'sfndal', '$2y$12$ZEsfEiduDCT/xOYLtWli1O5Jzm.qCy6RwwVTjDJlWR6xYCdG3nOaa', '0', '1', '01068570162', 30, '1', 6, 4, 21, 14, 'qM6fzer2CM', '2025-04-08 09:12:42', '2025-04-08 09:12:42'),
// (13, 2468, 'سهاد مرشد حذيفة', 'shad-mrshd-hthyf', 'smhthyf', '$2y$12$J9wiW4fZ5A0cBARMxwRuveFXAaB77/QlI0Uan0.Ydarq7hD.jrnPa', '1', '0', '01511367796', 21, '1', 4, 3, 18, 27, 'QWhDRRGLou', '2025-04-08 09:12:42', '2025-04-08 09:12:42'),
// (14, 1885, 'تاليا مشعل سهيل', 'talya-mshaal-shyl', 'tmshyl', '$2y$12$K6VIn/YaewTdU4gyKLPphu5mFpxCIq3O4Q1e2aw3MY99T4rPCwh7y', '1', '0', '01157005930', 45, '1', 5, 3, 17, 16, '7VIR5id8YQ', '2025-04-08 09:12:42', '2025-04-08 09:12:42'),
// (15, 8131, 'غادة سليمان مختار', 'ghad-slyman-mkhtar', 'ghsmkhta', '$2y$12$oaeR9YbrWF.8vPU9pWC2fOKT2dGnFt9nQxMQ0ZuEhD6I5wWgA5bf.', '1', '0', '01294311199', 21, '1', 2, 7, 3, 3, 'DzK12fEApO', '2025-04-08 09:12:42', '2025-04-08 09:12:42'),
// (16, 4050, 'وسن منيف ربيع', 'osn-mnyf-rbyaa', 'omrbyaa', '$2y$12$FSXkq6qr/05JXlaQJoQQE.1nCvM7PeyFoQpVz0ATHzgRz36pAuFnS', '1', '0', '01241625056', 30, '1', 6, 1, 1, 7, 'QNmYMwmMvO', '2025-04-08 09:12:42', '2025-04-08 09:12:42'),
// (17, 1867, 'شهد رامح زين', 'shhd-ramh-zyn', 'shrzyn', '$2y$12$R1A.IYtYZpSBf6SfmnVqf.2M7Mgkbv2Q79BLD73kjjfAqHfusSiRy', '1', '0', '01558573801', 45, '1', 6, 9, 18, 18, 'VVfSDhbz1x', '2025-04-08 09:12:42', '2025-04-08 09:12:42'),
// (18, 3621, 'ربيع رامي أكرم', 'rbyaa-ramy-akrm', 'rrakrm', '$2y$12$XBSeR48EOEt1EpShZ6riZeCD4fHAnV/WL/zjLz0jV10sS3W8aoFSe', '0', '1', '01015626479', 30, '1', 6, 6, 10, 19, 'dh3TKaI2or', '2025-04-08 09:12:42', '2025-04-08 09:12:42'),
// (19, 7599, 'بيسان عليان حاتم', 'bysan-aalyan-hatm', 'baahatm', '$2y$12$.WvQveRWMg1xcsvZYn6vR.i017UgTorn9Y9IGMW2MMwl9zjJ3v7Aa', '1', '0', '01151218500', 21, '1', 1, 4, 7, 4, 'w4t4cAw5OH', '2025-04-08 09:12:42', '2025-04-08 09:12:42'),
// (20, 7789, 'شفيق كرم عطا', 'shfyk-krm-aata', 'shkaat', '$2y$12$oZ0C.jNnTX5alKCitMkJz.n3b7P26ozWpwyyUnuA0Ouze9v/D4AFa', '0', '1', '01241587592', 21, '1', 2, 8, 9, 26, '6Xx5IaAu8O', '2025-04-08 09:12:43', '2025-04-08 09:12:43'),
// (21, 8765, 'زاهر عبدالودود رائف', 'zahr-aabdalodod-rayf', 'zaarayf', '$2y$12$3nVLpzg4BlB05Ct0zwxi/.fgSLQf9SbDbH4hIG7nziUXJTUlYlJCO', '0', '1', '01141496388', 21, '1', 3, 4, 18, 20, 'qqZ0qal9YK', '2025-04-08 09:12:43', '2025-04-08 09:12:43'),
// (22, 3943, 'رابية سهوان مهيب', 'raby-shoan-mhyb', 'rsmhyb', '$2y$12$rSu4UeeZzO5SJOuDlp95Q.npbDuxiO89AB7c7Oa4Wpbs3P9hu1oIG', '1', '0', '01226538236', 45, '1', 1, 9, 22, 25, 'PugNCOhsmi', '2025-04-08 09:12:43', '2025-04-08 09:12:43'),
// (23, 5414, 'رماح مأمون مازن', 'rmah-mamon-mazn', 'rmmazn', '$2y$12$gF9aSAtRXWanAJ29OFqbiuiFVwE5xF39Gdw7.strh7XQj8iUZLPtG', '0', '1', '01531892487', 21, '1', 5, 3, 17, 25, 'IzsyGnO05y', '2025-04-08 09:12:43', '2025-04-08 09:12:43'),
// (24, 6832, 'نوران عامر نضال', 'noran-aaamr-ndal', 'naandal', '$2y$12$8L/ClGXpi86eLF4r4KF60OeyH2CGDwDG0PrJfDq724v6dn92p4A42', '1', '0', '01050460199', 30, '1', 1, 1, 10, 28, 'mproZ6a6Ni', '2025-04-08 09:12:43', '2025-04-08 09:12:43'),
// (25, 4537, 'عزيز عبدالحافظ محسن', 'aazyz-aabdalhafth-mhsn', 'aaaamh', '$2y$12$bWyrj63S454LkMxq4KvKIO2YoQ1k0VEOzn3DTE4in1bDGhYO4/8vC', '0', '1', '01128910256', 30, '1', 5, 2, 17, 17, 'kmfxzVoG04', '2025-04-08 09:12:43', '2025-04-08 09:12:43'),
// (26, 1574, 'ماريا ممتاز عبدالفتاح', 'marya-mmtaz-aabdalftah', 'mmaabd', '$2y$12$5eHqyN69iDEHeRPbpbF5Se3YRaIHmap3EaGp7IrQZyQ01LS7uUDWu', '1', '1', '01557271952', 21, '1', 6, 3, 4, 27, 'Xxx8wJ4dJ9', '2025-04-08 09:12:43', '2025-04-08 09:12:43'),
// (27, 5878, 'يزن عدلي حارث', 'yzn-aadly-harth', 'yaahart', '$2y$12$mOTYKTJN5JPjmZKT/51QpOv299/oMO.V4gW3v8Stpw7LV.FlF9dtG', '0', '0', '01040384831', 45, '1', 4, 6, 28, 26, 'jLoIPBXmvt', '2025-04-08 09:12:43', '2025-04-08 09:12:43'),
// (28, 3114, 'ماريا زاهر شاهين', 'marya-zahr-shahyn', 'mzshahy', '$2y$12$Tb5EjMhS3PWa8WFTPf7oXe8OUrr05rXQW2Ton239e4P.Vd7a0lk0u', '1', '0', '01179259549', 30, '1', 1, 8, 19, 25, 'FEJdxtuAEi', '2025-04-08 09:12:43', '2025-04-08 09:12:43'),
// (29, 1783, 'زياد نهاد سراج', 'zyad-nhad-srag', 'znsrag', '$2y$12$ro4GX8688m5ucrvjYOJXre8DqiOQF.ujIVWXbvTNOzPsbz4Cp1IAu', '0', '1', '01055962965', 30, '1', 5, 4, 27, 19, 'GEomh2tofv', '2025-04-08 09:12:44', '2025-04-08 09:12:44'),
// (30, 8831, 'فاطمة عبدالبارئ صالح', 'fatm-aabdalbary-salh', 'faasalh', '$2y$12$1eWCc31SO3cE03iaIwdnvOlvO7DhywYUrU6BgNBoVP0/25iKcooUK', '1', '1', '01088901884', 21, '1', 3, 9, 2, 21, 'mX06L8U2Y5', '2025-04-08 09:12:44', '2025-04-08 09:12:44'),
// (31, 5239, 'رؤى رياض وضاح', 'ro-ryad-odah', 'rrodah', '$2y$12$I0Fo4/VnFBOsNxRjQQGGYu1xFWKbYAlRC.Lgi.IQUKerhXJm6FYcS', '1', '1', '01112185086', 45, '1', 2, 5, 11, 5, 'QMnVeovQZO', '2025-04-08 09:12:44', '2025-04-08 09:12:44'),
// (32, 2550, 'شاهين مجاهد مبارك', 'shahyn-mgahd-mbark', 'shmmbar', '$2y$12$yEn8UDOL.M/o7qgslMNPyOPNerLyO1COlAg5pa7mZbOV.Q2QcYZ.C', '0', '1', '01105532275', 21, '1', 5, 8, 8, 15, 'xkZF5AIg4w', '2025-04-08 09:12:44', '2025-04-08 09:12:44'),
// (33, 8441, 'سلامة مخلص عبدالكبير', 'slam-mkhls-aabdalkbyr', 'smaabd', '$2y$12$Pff0FXj.VOiRd4wDfxeyH.a/6RaBGaSqsTvXzgBQcAxeFQrYr8mie', '0', '0', '01187584117', 30, '1', 5, 6, 23, 1, 'gPCZ17fzBX', '2025-04-08 09:12:44', '2025-04-08 09:12:44'),
// (34, 7575, 'لورين عبدالله مختار', 'loryn-aabdallh-mkhtar', 'laamkht', '$2y$12$zqfa4AkqJ2GbFk26I3E/ruGPUkb/brIHALqrw7l5n5x00ve33isZS', '1', '1', '01277704574', 21, '1', 7, 8, 23, 13, 're8sjUljv7', '2025-04-08 09:12:44', '2025-04-08 09:12:44'),
// (35, 6633, 'نبراس معاوية علوان', 'nbras-maaaoy-aaloan', 'nmaaloa', '$2y$12$hDO.mo4rfieIciwZQnsUGeBvTuBSlmnvZCadbS1qI6jPVIpY6FxxW', '0', '1', '01119673158', 21, '1', 6, 8, 2, 25, '5bOAD0rroo', '2025-04-08 09:12:44', '2025-04-08 09:12:44'),
// (36, 9412, 'سارة شوقي سراجي', 'sar-shoky-sragy', 'sshsra', '$2y$12$6nrWDSfwEemdGtmlaievRu.4V2cuNFY6gMAzgXxyoxkvrvRpX3l7u', '1', '0', '01157557030', 21, '1', 3, 2, 2, 11, 'mkNWlIje59', '2025-04-08 09:12:44', '2025-04-08 09:12:44'),
// (37, 9933, 'سهوان معاوية وسام', 'shoan-maaaoy-osam', 'smosam', '$2y$12$8oZWhziqNXK419ZgSZDaOe.S941AxKMGwEqi6FMzKF9kFYsz1ppiO', '0', '0', '01161525093', 45, '1', 4, 7, 2, 1, 'nodmLRN42w', '2025-04-08 09:12:44', '2025-04-08 09:12:44'),
// (38, 3021, 'حسن وجيه أصيل', 'hsn-ogyh-asyl', 'hoasyl', '$2y$12$Vn8xPXNJgiFRcFr3Uw2lpO3bLYL3y.t84pDDtqDphAdAvLtB4pPcS', '0', '0', '01275858030', 30, '1', 4, 9, 6, 24, 'qdSevqeDrf', '2025-04-08 09:12:44', '2025-04-08 09:12:44'),
// (39, 5326, 'هيثم طلال غسان', 'hythm-tlal-ghsan', 'htghsan', '$2y$12$rM9sHQ5Eg4B1GQcSxHlmyu8cz.vbArd3nyE0h2sJ9F1m0TPrGcsKG', '0', '0', '01581394965', 45, '1', 3, 9, 19, 3, 'uVAP1tA3Zy', '2025-04-08 09:12:45', '2025-04-08 09:12:45'),
// (40, 2157, 'فضل حاتم سليمان', 'fdl-hatm-slyman', 'fhslym', '$2y$12$SrwG4sAwCgift565Ncch0eLnJW4DjWKZe/QJTf3WEHirlutibQB8e', '0', '1', '01508945261', 45, '1', 7, 7, 11, 9, 'hbfX10bm8d', '2025-04-08 09:12:45', '2025-04-08 09:12:45'),
// (41, 3242, 'كنعان عبدالعليم ممتاز', 'knaaan-aabdalaalym-mmtaz', 'kaammta', '$2y$12$fVmn/puyuXWtf9pK/AtzTO/I4f1OBLYAxXYk5cQryvtJg7wxoNdk6', '0', '0', '01098996209', 21, '1', 1, 2, 23, 12, 'nVHL76jLwg', '2025-04-08 09:12:45', '2025-04-08 09:12:45'),
// (42, 1956, 'سهير أدهم رشاد', 'shyr-adhm-rshad', 'sarshad', '$2y$12$Ce4ZYFdzcCEW6Chw1P2xaOKof3enfuszKiXhXJQFrI/6US69Cd9GC', '1', '0', '01596274584', 45, '1', 6, 8, 21, 16, 'aavAZU1wKL', '2025-04-08 09:12:45', '2025-04-08 09:12:45'),
// (43, 4124, 'راغب إيهاب عدنان', 'raghb-ayhab-aadnan', 'raaadn', '$2y$12$L1FFqe3EmjM1HIWod4aumOiVz09dGSiI3Vh2djJUGXEvyZRzcVT7a', '0', '1', '01558671837', 21, '1', 7, 6, 3, 18, 'imdk1uvXIG', '2025-04-08 09:12:45', '2025-04-08 09:12:45'),
// (44, 9565, 'سوار محيي أكرم', 'soar-mhyy-akrm', 'smakrm', '$2y$12$1mJ7NTfqhNnmfyTC5UfJoOC9rjbwRnYp2SgcmJlqddBCr5HJQihQW', '1', '1', '01554529078', 21, '1', 3, 3, 23, 6, 'C5O8ERrwXp', '2025-04-08 09:12:45', '2025-04-08 09:12:45'),
// (45, 9468, 'محمد أوس رياض', 'mhmd-aos-ryad', 'maryad', '$2y$12$hK25QkYoHyzNkVrJNieZJuhVLIq1.1TAEfGiokYB.yk/UTJTTanpe', '0', '1', '01123510880', 30, '1', 3, 1, 24, 22, 'EwlU05OYsx', '2025-04-08 09:12:45', '2025-04-08 09:12:45'),
// (46, 6282, 'عصام وليد معتصم', 'aasam-olyd-maatsm', 'aaomaats', '$2y$12$Fc7TCzMd1FKQKGtrvfnn.ORKYC0KSsJFvuCsTkHYdXkyflxDNvFb2', '0', '1', '01268739109', 45, '1', 5, 9, 28, 20, 'XSPyPYdq3i', '2025-04-08 09:12:46', '2025-04-08 09:12:46'),
// (47, 9080, 'عبير عليان عبداللطيف', 'aabyr-aalyan-aabdalltyf', 'aaaaaab', '$2y$12$avf9x.QV2PhZywpgLTk.9uaiNY8B7.j0Mtc2tWYp8GfpTUG1EoUn6', '1', '1', '01033868275', 45, '1', 6, 7, 3, 24, 'n5G91Jv2Ss', '2025-04-08 09:12:46', '2025-04-08 09:12:46'),
// (48, 7660, 'أدهم نور فاضل', 'adhm-nor-fadl', 'anfadl', '$2y$12$WeA/SPKhfqSqsLMK3qAn9OevA677/bnA16UWtrN22u9LFkPdop/xW', '0', '0', '01151729079', 30, '1', 4, 4, 8, 4, 'y1Dzr3ROUV', '2025-04-08 09:12:46', '2025-04-08 09:12:46'),
// (49, 3994, 'عابد ليث إسماعيل', 'aaabd-lyth-asmaaayl', 'aalasma', '$2y$12$SSuT4BPwcbaUIMURR4OdF.CECVHlELP2GVf72gKlNckfa6M.PZQGe', '0', '0', '01515763418', 30, '1', 5, 3, 6, 13, 'uxtGEpuTmK', '2025-04-08 09:12:46', '2025-04-08 09:12:46'),
// (50, 5389, 'رفيق نزار ربيع', 'rfyk-nzar-rbyaa', 'rnrbyaa', '$2y$12$zVbtNMBCpVSc1oDImoiPUeJlYjSR/h2/.MZVM2iIDIj3gcvRueQxK', '0', '0', '01242188411', 21, '1', 7, 5, 27, 15, 'f51pABGdVO', '2025-04-08 09:12:46', '2025-04-08 09:12:46'),
// (51, 8028, 'هيثم نورالدين توفيق', 'hythm-noraldyn-tofyk', 'hntofy', '$2y$12$YjcFdMSZVDtE.oIjHDkHieLoGZgdjwOD6ZzpEDFDeC0WpJXYqHLRu', '0', '1', '01291040869', 21, '1', 1, 5, 5, 2, '9YyQPDbcES', '2025-04-08 09:12:46', '2025-04-08 09:12:46'),
// (52, 1022, 'خديجة مصعب عبدالقدوس', 'khdyg-msaab-aabdalkdos', 'khmaabda', '$2y$12$nzSLp12SUIsTjxa2vJ.C/uRO8qMSx5kfriRGA72Ew2yFsRuAIzTZa', '1', '0', '01570627933', 45, '1', 6, 8, 1, 26, 'io3JvDpOvG', '2025-04-08 09:12:46', '2025-04-08 09:12:46'),
// (53, 9230, 'وسيم زين عليان', 'osym-zyn-aalyan', 'ozaalya', '$2y$12$pbFgiB8e0XFdVc3oS7P.T.OW4.ZHw2FaF.QesFijipTFSCDYE5eGC', '0', '0', '01587957528', 21, '1', 5, 7, 19, 18, 'aqpzAwSZkS', '2025-04-08 09:12:47', '2025-04-08 09:12:47'),
// (54, 6598, 'محجوب شاهين نزار', 'mhgob-shahyn-nzar', 'mshnzar', '$2y$12$z36uhCUbjFpbyB7U5n92Ouii5yCUOPEKFNUZlxpPbrPCchjXdK1ii', '0', '1', '01520177671', 21, '1', 2, 5, 16, 5, 'yctqbDPug1', '2025-04-08 09:12:47', '2025-04-08 09:12:47'),
// (55, 7804, 'سلسبيل خطاب أشرف', 'slsbyl-khtab-ashrf', 'skhash', '$2y$12$Se6CDtM.Lsou3igfHaYUke6kYF/tn92CVo.tLI/h.fq5g9ro0GxsS', '1', '0', '01082088880', 45, '1', 4, 1, 6, 9, '9q61ez79PY', '2025-04-08 09:12:47', '2025-04-08 09:12:47'),
// (56, 4276, 'غيداء مراد وسام', 'ghydaaa-mrad-osam', 'ghmosam', '$2y$12$zuLSWcAH1ec1bSj4fToB0.kjABWymypVmuK9HPMRxuhzVntluLx1G', '1', '0', '01523792753', 30, '1', 5, 3, 4, 18, 'hsIBci9aRE', '2025-04-08 09:12:47', '2025-04-08 09:12:47'),
// (57, 3716, 'سامي زين راغب', 'samy-zyn-raghb', 'szragh', '$2y$12$z07qd.4kLjGLlhBlIRNPDOyoVVlVI.eBVhM9NmNRPv7hBd8YQkZny', '0', '1', '01075953572', 21, '1', 7, 4, 10, 15, 'RYnDMjLJ1e', '2025-04-08 09:12:47', '2025-04-08 09:12:47'),
// (58, 4502, 'عفيف فيصل عيسى', 'aafyf-fysl-aays', 'aafaays', '$2y$12$eI0xauelTtpFOvtPIz6nSuDeusWSZZaPTcVLmqOD4tR7mqJM/9RvK', '0', '0', '01152734799', 30, '1', 6, 3, 20, 13, 'CYGgEAgeUB', '2025-04-08 09:12:48', '2025-04-08 09:12:48'),
// (59, 7445, 'تقى مكين حامد', 'tk-mkyn-hamd', 'tmhamd', '$2y$12$2rlARKHs9SKcMOow4GtwLuXNRh6wNH943sk9lSQ0qAmCWuIUXmYJS', '1', '0', '01011497982', 30, '1', 6, 3, 13, 28, 'GeWKboam05', '2025-04-08 09:12:48', '2025-04-08 09:12:48'),
// (60, 5681, 'إيهاب عيسى عادل', 'ayhab-aays-aaadl', 'aaaaaadl', '$2y$12$ZKhntJG8cD.elBwcv3npJ.yfqK63416zrcwQ7czyg3uGYzFjYpmYy', '0', '0', '01170540334', 30, '1', 1, 5, 20, 28, 'QVyVXeagHp', '2025-04-08 09:12:48', '2025-04-08 09:12:48'),
// (61, 5736, 'سوار وسيم محفوظ', 'soar-osym-mhfoth', 'somhfo', '$2y$12$RgewGW5Q188kWpUWPFgu4e12x8n01U2fPedup0l3Ah0jRDhrMbFdO', '1', '1', '01556772381', 21, '1', 1, 5, 4, 2, 'qI7fjzVtKD', '2025-04-08 09:12:48', '2025-04-08 09:12:48'),
// (62, 3999, 'يزيد محمود صفوان', 'yzyd-mhmod-sfoan', 'ymsfoa', '$2y$12$9A6ZztRyxpl2GKwOFiumtOTJnX2CgH.4b2Qo2LlIqrJocHOVqFx5i', '0', '1', '01225819928', 45, '1', 6, 7, 5, 22, 'pLO6q0gy4Y', '2025-04-08 09:12:48', '2025-04-08 09:12:48'),
// (63, 6532, 'حلا منيب نور', 'hla-mnyb-nor', 'hmnor', '$2y$12$zrlMWH9lXcJfsSHadwX5/.KoszrTTPbj8eXSRi0BHvr80BFohuQcq', '1', '1', '01087033342', 30, '1', 7, 1, 27, 5, 'XbbWh3ibjI', '2025-04-08 09:12:48', '2025-04-08 09:12:48'),
// (64, 1375, 'نورهان رامي مخلص', 'norhan-ramy-mkhls', 'nrmkhls', '$2y$12$A5TY.AxuMGgRbmvai.P64Oks3hxwrIWZWftv6GcwQGWBo9ohvxdzS', '1', '1', '01252455501', 30, '1', 3, 4, 4, 24, '3yY0rGVZZ0', '2025-04-08 09:12:48', '2025-04-08 09:12:48'),
// (65, 7487, 'سامي عبدالرزاق منيف', 'samy-aabdalrzak-mnyf', 'saamnyf', '$2y$12$FLi1Qm1.V4OvmkGLYpkz1O9tcEd.Cykq0YNfWzE34VZHylGgh86Q6', '0', '1', '01036180658', 21, '1', 4, 7, 23, 7, 'cPiFy24Dg3', '2025-04-08 09:12:48', '2025-04-08 09:12:48'),
// (66, 2563, 'صفا هيثم أنور', 'sfa-hythm-anor', 'shanor', '$2y$12$7VyEXgI.s2YC9/XhSNi4d.mqGdUbqKo5cnAaKCb9.BsQWmLsFCeW2', '1', '1', '01104400895', 30, '1', 3, 3, 7, 1, 'IUDXQzGMbE', '2025-04-08 09:12:48', '2025-04-08 09:12:48'),
// (67, 3447, 'عائشة شهاب سلطان', 'aaaysh-shhab-sltan', 'aashslta', '$2y$12$iPcsWNH3Zn4PWGwkCPfZMu.h7/SQ8bLVq4E0AA5XUyorg/DDK3qDy', '1', '0', '01587605214', 30, '1', 5, 7, 7, 2, 'CS8yQzg353', '2025-04-08 09:12:48', '2025-04-08 09:12:48'),
// (68, 6094, 'سارة معاوية مأمون', 'sar-maaaoy-mamon', 'smmamo', '$2y$12$I9jKj30wOGcTuK8KNpdrMOmAW9/mrj6oN2b8nC3hf3jfzP4KyvnPG', '1', '1', '01155884167', 30, '1', 5, 7, 26, 24, 'qG7YPUiXsg', '2025-04-08 09:12:49', '2025-04-08 09:12:49'),
// (69, 1132, 'حذيفة حكيم عزام', 'hthyf-hkym-aazam', 'hhaazam', '$2y$12$k.9JRaYxn1dl.8PdwWyC0.vV3uquLOBcO6JNlCtvOgWK/lCH1zirC', '0', '0', '01560106538', 30, '1', 4, 4, 3, 8, 'WeSURqnrbh', '2025-04-08 09:12:49', '2025-04-08 09:12:49'),
// (70, 6150, 'نوران عبدالحكيم ناجي', 'noran-aabdalhkym-nagy', 'naanagy', '$2y$12$SncnPIkk5ndJ7YAlXRwq3.vgv0D1pKo.JKrAIYBq25tYJ7rd7oQ.i', '1', '0', '01209798724', 30, '1', 1, 5, 26, 11, 'mxPuP9DIJc', '2025-04-08 09:12:49', '2025-04-08 09:12:49'),
// (71, 3156, 'سراج عبدالمجيد راضي', 'srag-aabdalmgyd-rady', 'saarady', '$2y$12$NwVHctrznlxASHfqtH1WUun.HWH5961x1YQcMd546XLPCNQ0/1KUW', '0', '1', '01500715525', 21, '1', 1, 3, 22, 6, 'gsg6fOw74u', '2025-04-08 09:12:49', '2025-04-08 09:12:49'),
// (72, 9623, 'ناجي وحيد صابر', 'nagy-ohyd-sabr', 'nosabr', '$2y$12$PUTZOt4.vcu279nJR805DO27rKkV1hd4W4SVAD0py2UXIbU3M46f.', '0', '1', '01267327767', 30, '1', 3, 4, 6, 6, 'YKH6pCMz9k', '2025-04-08 09:12:49', '2025-04-08 09:12:49'),
// (73, 4384, 'زهرة عابد منصور', 'zhr-aaabd-mnsor', 'zaamns', '$2y$12$fTQ4xTqUlSqcFuyaz4WDb.PglDbfdCcXju9aRJgoxPGPHdf4Dhtx2', '1', '1', '01188697429', 21, '1', 6, 9, 23, 9, 'DbTB7tr2fR', '2025-04-08 09:12:49', '2025-04-08 09:12:49'),
// (74, 9669, 'كارمن مجاهد عارف', 'karmn-mgahd-aaarf', 'kmaaar', '$2y$12$EPCGmky5WkpFA6ZKLXwRSusPM4ZsAoLzQs0cCP3/oyw.37CnrkJrm', '1', '0', '01175219920', 21, '1', 1, 7, 23, 23, 'rzj39DdMbB', '2025-04-08 09:12:49', '2025-04-08 09:12:49'),
// (75, 6971, 'معتصم بكر عماد', 'maatsm-bkr-aamad', 'mbaama', '$2y$12$MXfk5fGbg.uN0GWxhzYAi.9Uwofec2VGPi88nZgJCnOjC8GK0T9jq', '0', '1', '01021379512', 21, '1', 4, 9, 12, 23, 'DLElN1wpy7', '2025-04-08 09:12:49', '2025-04-08 09:12:49'),
// (76, 7724, 'لارين عدلي برهان', 'laryn-aadly-brhan', 'laabrha', '$2y$12$CcWnY0RUmyVak6OdFiRTSOohVWTIFBp5tpfKO.HRFwKEosC2fgsHa', '1', '1', '01110031186', 45, '1', 4, 3, 5, 3, '1k9sNB0O2z', '2025-04-08 09:12:50', '2025-04-08 09:12:50'),
// (77, 6538, 'شفيق بشار عبدالرزاق', 'shfyk-bshar-aabdalrzak', 'shbaabda', '$2y$12$sc..QC8Hon5zhJEkWXXD7uWIjVswM6JVshE6WO9r2tOa4KM1nyX9q', '0', '0', '01506161096', 45, '1', 5, 2, 1, 25, 'aX4E2G9ljg', '2025-04-08 09:12:50', '2025-04-08 09:12:50'),
// (78, 1764, 'مأمون ظافر أشرف', 'mamon-thafr-ashrf', 'mthashrf', '$2y$12$jZFYq2qRc77fFQd4EYoJS.mf7nJIv/acrPgqmFKkqPryjGnPfzpUi', '0', '1', '01586192073', 30, '1', 6, 4, 10, 7, 'nn6XeNCXUQ', '2025-04-08 09:12:50', '2025-04-08 09:12:50'),
// (79, 1632, 'زكريا سامي خاطر', 'zkrya-samy-khatr', 'zskhatr', '$2y$12$22g75Rku/UFGxZGflKiCCutNvKOKtWG4NQxwmwrcU3tw8KH3hIVM2', '0', '1', '01263036998', 21, '1', 4, 3, 17, 2, 'VnbVDPFHSf', '2025-04-08 09:12:50', '2025-04-08 09:12:50'),
// (80, 3945, 'شذى عبود نورالدين', 'shth-aabod-noraldyn', 'shaano', '$2y$12$XVxhyzFrbXuBsW3KiJ0BgudU./jBkKoxUUF22tVpbVRC5VG9a/q9K', '1', '0', '01043891652', 21, '1', 2, 8, 28, 16, 'UHyKCgxa38', '2025-04-08 09:12:50', '2025-04-08 09:12:50'),
// (81, 6960, 'كرم حمد جلال', 'krm-hmd-glal', 'khglal', '$2y$12$fSVqfeU5qlfEV0PlxgakD.odkGDL1E3cOUQmb7wBPUG/JoWTX5ple', '0', '1', '01192087263', 30, '1', 2, 8, 25, 12, 'Wz73UWDKIP', '2025-04-08 09:12:50', '2025-04-08 09:12:50'),
// (82, 4123, 'سالم شوقي حاتم', 'salm-shoky-hatm', 'sshhatm', '$2y$12$H7Xg5/wzS0NUYKlX01m/R.tQdjsyrQiwOM0wKLc532QdcbN5MLnU2', '0', '0', '01548806986', 30, '1', 1, 7, 13, 17, '9jFlJlZ5r1', '2025-04-08 09:12:50', '2025-04-08 09:12:50'),
// (83, 8106, 'معروف كنعان مقداد', 'maarof-knaaan-mkdad', 'mkmkda', '$2y$12$0DwtGNFzr8HrYP.hYVr8KuxP1EeaO5tepGPkPSGW3BSR94cR2Fo4q', '0', '1', '01069913108', 21, '1', 1, 2, 12, 24, '2N5WzcLEWR', '2025-04-08 09:12:50', '2025-04-08 09:12:50'),
// (84, 9101, 'فطين جلال ساجي', 'ftyn-glal-sagy', 'fgsagy', '$2y$12$4MHR7Kn0c6nrMZPOlca5NOgyeTH0Eac6nVp.NyJBfHWXNh6z6QzbC', '0', '1', '01581823269', 30, '1', 5, 6, 4, 3, 'WZIsdNtl72', '2025-04-08 09:12:51', '2025-04-08 09:12:51'),
// (85, 6940, 'هبة الله كمال مصطفى', 'hb-allh-kmal-mstf', 'hakmstf', '$2y$12$r8jx.tHn9qrLS0wuj.LuZu4caJSXYalg39HCVepXeY6IzzeHjrFtK', '1', '0', '01543231045', 30, '1', 1, 7, 4, 12, 'xIUHRsBm3m', '2025-04-08 09:12:51', '2025-04-08 09:12:51'),
// (86, 6091, 'أصيل رفيق عبدالرزاق', 'asyl-rfyk-aabdalrzak', 'araabda', '$2y$12$tjblbz2uXvs5CqdXhU0m/OyN8gHS4dIIGgyHvQ8pjRm7xz.feKTQ2', '0', '1', '01289960483', 45, '1', 6, 4, 13, 5, '478gACe2Xa', '2025-04-08 09:12:51', '2025-04-08 09:12:51'),
// (87, 6959, 'لاما حميد بدر', 'lama-hmyd-bdr', 'lhbdr', '$2y$12$k4msBJ48/lzr90Y6jV4rhe.LpXeUyfXKYRSp5olYO25xBeCnvwmnm', '1', '0', '01248278408', 30, '1', 6, 8, 25, 19, 'DRoMxTUvD0', '2025-04-08 09:12:51', '2025-04-08 09:12:51'),
// (88, 1797, 'نسمة عبدالحليم لؤي', 'nsm-aabdalhlym-loy', 'naaloy', '$2y$12$Na3maA4NuF8Kwi8SGE3C8e.WtTdEOfgGyL9E5wCiOXkvehP.J/nQi', '1', '1', '01232348577', 21, '1', 4, 6, 16, 20, '08tonZt0HK', '2025-04-08 09:12:51', '2025-04-08 09:12:51'),
// (89, 8780, 'علي كرم عزام', 'aaly-krm-aazam', 'aakaaz', '$2y$12$LARRDZVvXXKnb83thp8FU.VB3DNVHKTUrJUbP11s/kZyP2MzytOxu', '0', '1', '01238701756', 30, '1', 7, 5, 14, 28, 'f8yKN9mkPC', '2025-04-08 09:12:51', '2025-04-08 09:12:51'),
// (90, 1670, 'نضال زاهر نزار', 'ndal-zahr-nzar', 'nznzar', '$2y$12$AMlCLdqAcZUp0SzN5nFmZOlIkM8chbeJVf1G4Tnuq6gXhwWTXgiwm', '0', '1', '01065383145', 30, '1', 2, 4, 25, 14, 'wtBO3AEgO3', '2025-04-08 09:12:52', '2025-04-08 09:12:52'),
// (91, 5238, 'لبنى عبود قيس', 'lbn-aabod-kys', 'laakys', '$2y$12$xS7O0NlQZLuDLrjSU.hQJ.lGn8nIQDf5l6nYscj/4lpxo9IicBBIO', '1', '1', '01192860368', 30, '1', 2, 6, 24, 1, 'k30V5v5eeo', '2025-04-08 09:12:52', '2025-04-08 09:12:52'),
// (92, 6703, 'فخري عبدالحي مصلح', 'fkhry-aabdalhy-mslh', 'faamslh', '$2y$12$/wLA.EWt47YfgLA.bhW7I.RUb9TK/ORuM7IBPA4eoZaSo7ITguus2', '0', '1', '01085624285', 30, '1', 7, 5, 8, 19, 'za113h6ssR', '2025-04-08 09:12:52', '2025-04-08 09:12:52'),
// (93, 7380, 'فريال رامي جواد', 'fryal-ramy-goad', 'frgoad', '$2y$12$by/kC7x.v2Qb20i6IFvNcObngLt9B/MdhmuCxpgbKN9v.QxSJIhZS', '1', '1', '01059241457', 30, '1', 5, 7, 12, 14, 'OAEj978D4X', '2025-04-08 09:12:52', '2025-04-08 09:12:52'),
// (94, 9348, 'فاضل سهوان نور', 'fadl-shoan-nor', 'fsnor', '$2y$12$EBDPbOn2dEpWqCLVIj18/emcedd7vCMgeffP.icp0glwfuYIYe9Ua', '0', '0', '01188161853', 21, '1', 4, 5, 6, 2, 'bjBMgA4J0L', '2025-04-08 09:12:52', '2025-04-08 09:12:52'),
// (95, 6787, 'رويدا عبدالحافظ معتز', 'royda-aabdalhafth-maatz', 'raamaat', '$2y$12$0QgtrK7.bAi0pxomDyesG.L90BKzRjGy8RIZPECgrTGaMF8IPvzau', '1', '0', '01105227931', 21, '1', 7, 1, 22, 23, 'pRQK3XDo94', '2025-04-08 09:12:52', '2025-04-08 09:12:52'),
// (96, 5064, 'فريال علوان عمران', 'fryal-aaloan-aamran', 'faaaam', '$2y$12$AFBG2/iUyH1fDRRjJ1gwhujXUs30nF5z3Yy0IflzOKm7PqlAh4W.e', '1', '0', '01152532045', 21, '1', 7, 2, 2, 13, 'poe9TNw0id', '2025-04-08 09:12:53', '2025-04-08 09:12:53'),
// (97, 4278, 'حميد عبدالفتاح سليم', 'hmyd-aabdalftah-slym', 'haasly', '$2y$12$y214ZG58TC1cK1N968R2ieeUi0wB00uULiC.D7MB5Y1M45r/Pj6Ea', '0', '1', '01507341687', 45, '1', 6, 9, 24, 1, 'PukgqVAnN7', '2025-04-08 09:12:53', '2025-04-08 09:12:53'),
// (98, 7506, 'وسيم عبدالفتاح معتز', 'osym-aabdalftah-maatz', 'oaamaat', '$2y$12$wn.oS8uJeZbCR26OEKBpqeWkNv9W3dlw/hUCAyu1gJ0rf6ejLV8cy', '0', '0', '01534909765', 21, '1', 4, 1, 16, 21, 'zF7kANPqvS', '2025-04-08 09:12:53', '2025-04-08 09:12:53'),
// (99, 5092, 'خطاب عدلي إبراهيم', 'khtab-aadly-abrahym', 'khaaab', '$2y$12$lgTbFSMbLerRXsiFewB31OJdD9KZGlPIdSdY57RJMQBj.2Wr0Wi6.', '0', '1', '01253088622', 21, '1', 6, 1, 12, 25, 'uKV9AsLBbq', '2025-04-08 09:12:53', '2025-04-08 09:12:53'),
// (100, 1327, 'شاهين حكيم هشام', 'shahyn-hkym-hsham', 'shhhsham', '$2y$12$ebokD63S5kJ5Hrmzt7IcQOJl5O6Q1/jOuCzcvOyjHR5cPltuneNHa', '0', '0', '01164873351', 30, '1', 1, 3, 9, 26, 'ZWvWqEuvX8', '2025-04-08 09:12:53', '2025-04-08 09:12:53'),
// (101, 5195, 'روبي أشرف ماجد', 'roby-ashrf-magd', 'ramagd', '$2y$12$kTcJq/f1jM0fZWquWouH9.wP5wKcMl.B9fBgzVqDPz9IDC35hRBh2', '1', '0', '01240049160', 30, '1', 3, 6, 9, 18, 'tuFwv7KCju', '2025-04-08 09:12:53', '2025-04-08 09:12:53'),
// (102, 9328, 'رند بشار محجوب', 'rnd-bshar-mhgob', 'rbmhgo', '$2y$12$V9eU35xXiWmk4m3P7kBFbOIr9CNcYm4Bw0cUI.dzVAsO7zNF.VBCy', '1', '0', '01079912371', 45, '1', 2, 4, 2, 22, 'TKYsQ3YocV', '2025-04-08 09:12:53', '2025-04-08 09:12:53'),
// (103, 6489, 'فيصل عبدالمحسن وجيه', 'fysl-aabdalmhsn-ogyh', 'faaogy', '$2y$12$OBif7fQP04x2cXn1W0EBQOHzmTs/c5WYnZyyqzgUm/Iiash5D6cLe', '0', '0', '01117161085', 21, '1', 7, 4, 4, 27, 'FcsgRP4yck', '2025-04-08 09:12:53', '2025-04-08 09:12:53'),
// (104, 1325, 'وحيد رائف فارس', 'ohyd-rayf-fars', 'orfars', '$2y$12$unSFY3GT6taUHk3r95aplezBhFBSpNbsrVwytdiQCtndqvvEWpr32', '0', '1', '01527549342', 30, '1', 1, 4, 22, 18, '0vb82ORol4', '2025-04-08 09:12:54', '2025-04-08 09:12:54'),
// (105, 1130, 'حسناء عادل حبيب', 'hsnaaa-aaadl-hbyb', 'haahby', '$2y$12$U1ur8R8S9z/ntZcC8zRf2OxGeVNZuH91j0Yzz233eXlct4AcSapfW', '1', '1', '01169570593', 30, '1', 3, 5, 16, 1, 'CdEPfEvcmr', '2025-04-08 09:12:54', '2025-04-08 09:12:54'),
// (106, 5963, 'أحلام نور رفيق', 'ahlam-nor-rfyk', 'anrfyk', '$2y$12$pU6JY6XfPPkTycT7f60A4.LwUc0wUn7poT2wSPBE.diTcN1Ys7fki', '1', '1', '01263035476', 45, '1', 5, 5, 11, 6, 'cEPlo1XVeK', '2025-04-08 09:12:54', '2025-04-08 09:12:54'),
// (107, 1655, 'صفوان معاوية مالك', 'sfoan-maaaoy-malk', 'smmalk', '$2y$12$7QWZGYqS.aCMLi4J2MzJEuS0M7zCcGog81wNcnKH/hnqiMjNLt6oK', '0', '1', '01120612041', 30, '1', 5, 6, 6, 13, 'HQqWZZcEAc', '2025-04-08 09:12:54', '2025-04-08 09:12:54'),
// (108, 8863, 'هلا يزن غسان', 'hla-yzn-ghsan', 'hyghsan', '$2y$12$NH7KbEdFU6Ya8xcB6VXyj.hkiPZHAS5S1nWEV7hry/KQCLkHMSr7m', '1', '1', '01540883746', 45, '1', 2, 8, 2, 2, 'GGVeVuw56s', '2025-04-08 09:12:54', '2025-04-08 09:12:54'),
// (109, 1604, 'سجى وسيم عبدالمحسن', 'sg-osym-aabdalmhsn', 'soaabda', '$2y$12$KZgfuBbcLrlZGf2OSsZ3puqi3zj.BQloyq.hTU44/cLHo5lEFh1qG', '1', '1', '01239382294', 45, '1', 4, 7, 21, 15, '7cepF8WyQA', '2025-04-08 09:12:54', '2025-04-08 09:12:54'),
// (110, 3204, 'جنة مختار رامي', 'gn-mkhtar-ramy', 'gmramy', '$2y$12$Pv9tqX5xpDDBON24cHOZouRfLy96FYKuTqRsKgVzBrJk4WfeehQZG', '1', '0', '01051713783', 21, '1', 6, 1, 2, 16, 'PyZktnL11Z', '2025-04-08 09:12:54', '2025-04-08 09:12:54'),
// (111, 9203, 'بهاء فارس رفيق', 'bhaaa-fars-rfyk', 'bfrfyk', '$2y$12$u0zvYv5/PbSrFM5jnj/6aOGQvfnwLDCEXAz0WlHLhLqInBAj2G/MW', '0', '0', '01598353021', 45, '1', 4, 4, 27, 20, 'zCb3yRtWSF', '2025-04-08 09:12:54', '2025-04-08 09:12:54'),
// (112, 8045, 'غسان أصيل أصيل', 'ghsan-asyl-asyl', 'ghaasyl', '$2y$12$6QL..aoGMylJR9Sd7.mrwOgUfi.6KKHZiqKvE8yV1T8DNxJspblOa', '0', '1', '01065947695', 30, '1', 2, 3, 7, 13, 'JEHZqPbXwM', '2025-04-08 09:12:54', '2025-04-08 09:12:54'),
// (113, 1614, 'بديع عبدالباري قادر', 'bdyaa-aabdalbary-kadr', 'baakadr', '$2y$12$Yd1ZMpfMJsbuOGLOAeXaeeKJbJpgazRByOVhbox7TBdi6yP9tfVwq', '0', '1', '01287455851', 21, '1', 5, 3, 15, 2, '3LWsB0kvF9', '2025-04-08 09:12:55', '2025-04-08 09:12:55'),
// (114, 2359, 'شهد كرم محسن', 'shhd-krm-mhsn', 'shkmhsn', '$2y$12$IQBubW5CkMS3yJ46XD6t5.9y4DVS7zqNDxMTODzCOigwEUULRDrVG', '1', '0', '01502179381', 21, '1', 3, 2, 3, 27, 'qNBJjsMz8l', '2025-04-08 09:12:55', '2025-04-08 09:12:55'),
// (115, 2537, 'وديع رامي ممتاز', 'odyaa-ramy-mmtaz', 'ormmta', '$2y$12$Ap.I8apWaR2Dycravq4hHuSqGR0kMCJkrDdCnwTIPP4rC4BeOkPom', '0', '1', '01170516631', 30, '1', 1, 6, 10, 9, 'zPFd93Yiis', '2025-04-08 09:12:55', '2025-04-08 09:12:55'),
// (116, 5693, 'رانيا سهيل عبدالعليم', 'ranya-shyl-aabdalaalym', 'rsaabda', '$2y$12$aqCDEET5rQ6rvq3aP0naJeJwnJ8jLZaqfOYF5X4B3uK4sUO8LI8Tm', '1', '1', '01548792513', 30, '1', 3, 2, 24, 24, '2FvRGbPRvR', '2025-04-08 09:12:55', '2025-04-08 09:12:55'),
// (117, 2625, 'نصر سامر نصار', 'nsr-samr-nsar', 'nsnsar', '$2y$12$aTXRG/Ifo8RtgooZ51no7.E/0m6NXqtEUhY2P5tDkBRz5pOwF5yrG', '0', '0', '01297844986', 21, '1', 7, 8, 1, 8, '24olxQpZrB', '2025-04-08 09:12:55', '2025-04-08 09:12:55'),
// (118, 7638, 'مؤمن براء يوسف', 'momn-braaa-yosf', 'mbyosf', '$2y$12$rnAKxSwsPqR.wkjkAxak8ex4W3MePbpMRhPDK2QHqCLbuJgyhYroa', '0', '0', '01130269725', 45, '1', 5, 2, 18, 5, 'rxGpbyLkBc', '2025-04-08 09:12:55', '2025-04-08 09:12:55'),
// (119, 1569, 'ديمة نبراس رامز', 'dym-nbras-ramz', 'dnramz', '$2y$12$1kacdgbLGNGkv5Cc5/LcSes6SBPhVy6xmcwrVjbg9nlHhpEcqwwdu', '1', '1', '01224424014', 30, '1', 6, 4, 18, 12, 'PEFaAwpxG2', '2025-04-08 09:12:55', '2025-04-08 09:12:55'),
// (120, 6851, 'رعد وضاح حسن', 'raad-odah-hsn', 'rohsn', '$2y$12$fmwwI8anMELgvmbzJkoTH.k9cHbBtGNMnFb02m9lGKQGKzJyoQvhe', '0', '0', '01271995272', 21, '1', 6, 7, 12, 2, 'VzxcZ78Akd', '2025-04-08 09:12:56', '2025-04-08 09:12:56'),
// (121, 5708, 'رهام شاكر أحمد', 'rham-shakr-ahmd', 'rshahmd', '$2y$12$k5husNTH0wx2QTJ3dt777uyShAgPw/sHCrfUVABGD7zuhkihLqyPe', '1', '0', '01091945237', 45, '1', 4, 5, 13, 5, '1hmCNLMBss', '2025-04-08 09:12:56', '2025-04-08 09:12:56'),
// (122, 1455, 'أصيل رائد مجاهد', 'asyl-rayd-mgahd', 'armgah', '$2y$12$lp9WUMzvmbAqVevjOj6p9eOYD7CYI5UDhSLyzcYoxm4By8OhT3xDC', '0', '0', '01069373792', 45, '1', 7, 3, 16, 22, 'tyVOowEc5H', '2025-04-08 09:12:56', '2025-04-08 09:12:56'),
// (123, 5218, 'منجد نادر مؤيد', 'mngd-nadr-moyd', 'mnmoyd', '$2y$12$qfy4CMAlBeGoNL94LvL1hODnu/4j6yAhDjJ7C1vuz1ZfFse/TgXdW', '0', '1', '01294942942', 30, '1', 3, 9, 8, 22, 'TVEAqhMF2F', '2025-04-08 09:12:56', '2025-04-08 09:12:56'),
// (124, 1240, 'شريف وسيم مختار', 'shryf-osym-mkhtar', 'shomkhta', '$2y$12$ZZjAV3liays/KQCjDVIzmOTZ4NvdlpYlkxdkPXr7.qxKPGPLWnyU2', '0', '0', '01102503177', 45, '1', 4, 7, 15, 15, 'yTsIn7fqXi', '2025-04-08 09:12:56', '2025-04-08 09:12:56'),
// (125, 7664, 'فاضل حمد محجوب', 'fadl-hmd-mhgob', 'fhmhgo', '$2y$12$JYGj55pJxtxCDx535Au12ehzvSZyFK6WGdDUKHLHD37BdRTbjsOQS', '0', '1', '01075097605', 45, '1', 3, 3, 3, 23, 'iX2uctaezr', '2025-04-08 09:12:56', '2025-04-08 09:12:56'),
// (126, 7984, 'أريج نواف باسم', 'aryg-noaf-basm', 'anbasm', '$2y$12$wwheStJfxqDKQYD/nNaT0.G/FLks93.GbyOPmRpkt/8fS5h1uZl52', '1', '0', '01538824478', 30, '1', 2, 9, 1, 5, 'lMbCWrQQwB', '2025-04-08 09:12:56', '2025-04-08 09:12:56'),
// (127, 1886, 'نجوى معتصم منصور', 'ngo-maatsm-mnsor', 'nmmnso', '$2y$12$CnUR8ykgCvYvhcPt39hUc.E/iPZGPb8ZpxDfcI9wSmFHGMQ9vwZGG', '1', '0', '01584812306', 30, '1', 4, 9, 21, 15, 'SLtsqrCbZV', '2025-04-08 09:12:57', '2025-04-08 09:12:57'),
// (128, 1552, 'معين سليم شمس', 'maayn-slym-shms', 'msshms', '$2y$12$/v21XekDmHR8s9BoXxnjNezvuhFrWdOKW3kDa92d25gRuqcubv8Hi', '0', '1', '01571367557', 45, '1', 6, 1, 20, 27, 'IgZ7n1Kdy5', '2025-04-08 09:12:57', '2025-04-08 09:12:57'),
// (129, 1766, 'جنان منيب قسام', 'gnan-mnyb-ksam', 'gmksam', '$2y$12$0JACueC.OqMIO5.lJSCZH.q/2Fi2iIFv3AAbD9Spl4B.02jek4euO', '1', '0', '01224561121', 21, '1', 2, 6, 22, 10, 'WiU4qXlmRU', '2025-04-08 09:12:57', '2025-04-08 09:12:57'),
// (130, 6467, 'ناجي بكر سلطان', 'nagy-bkr-sltan', 'nbslta', '$2y$12$qkC8yeymYysW.HynnPhzKOZg4eERsMDik0ogqa3jSo/DbxPpqzKfu', '0', '0', '01041318365', 45, '1', 7, 2, 5, 18, '5jcokep6J4', '2025-04-08 09:12:57', '2025-04-08 09:12:57'),
// (131, 6098, 'أيوب مقداد حكيم', 'ayob-mkdad-hkym', 'amhkym', '$2y$12$8O2l57.kUXajrvloAM3WpewKTsBBZuVXEqWcSEyfn9x8nB7tj07SK', '0', '0', '01193100426', 30, '1', 4, 6, 11, 1, 'c3TCgTlysk', '2025-04-08 09:12:57', '2025-04-08 09:12:57'),
// (132, 8729, 'سدين مازن عبدالكريم', 'sdyn-mazn-aabdalkrym', 'smaabda', '$2y$12$xn.un1wuecdatkQC6vp5wOHaAqL7T4oDNi/5ugI0i8USl9D/bArJG', '1', '0', '01133951433', 21, '1', 5, 3, 15, 7, 'Cehx6EMAjY', '2025-04-08 09:12:57', '2025-04-08 09:12:57'),
// (133, 9437, 'ميرفت مصعب نبيل', 'myrft-msaab-nbyl', 'mmnbyl', '$2y$12$OTilbI8rWbC.zQ.FVeqzJO.k5jtOdMvbhUOMH//sm520wywMSqDBu', '1', '0', '01028609360', 21, '1', 2, 6, 17, 26, 'knRvBkcoGo', '2025-04-08 09:12:57', '2025-04-08 09:12:57'),
// (134, 8616, 'برهان كرم إسماعيل', 'brhan-krm-asmaaayl', 'bkasma', '$2y$12$5efbExg/FTtl1WFjJzGLUO4QGlJSLxDMnjpLvSMtOlrYiBwsTOcYG', '0', '0', '01100116817', 45, '1', 2, 6, 5, 21, '79dfodmK17', '2025-04-08 09:12:57', '2025-04-08 09:12:57'),
// (135, 3724, 'ريحانة مرشد نبراس', 'ryhan-mrshd-nbras', 'rmnbra', '$2y$12$ASte993RsJVOJfzY3mfAkOtsGnnmSvhr22P8gGF3yHkm0Nvqcgd3y', '1', '1', '01284918874', 30, '1', 3, 8, 8, 15, 'jhRsfZiY8l', '2025-04-08 09:12:58', '2025-04-08 09:12:58'),
// (136, 5014, 'آمال معروف رامي', 'amal-maarof-ramy', 'amramy', '$2y$12$MxZE7Htyph2cxDO91WQu5eZkVDiIYy8SsG0anzCJDkX9BO8skgI5u', '1', '0', '01546476933', 45, '1', 1, 5, 15, 1, 'PXiTtE3zA9', '2025-04-08 09:12:58', '2025-04-08 09:12:58'),
// (137, 8054, 'حياة قادر علي', 'hya-kadr-aaly', 'hkaaly', '$2y$12$squeXCBEbVSNY1KoPH8B5.1Dn4N7boKyK5PZm.tZOZOrMKA8A5kMW', '1', '1', '01182941913', 30, '1', 2, 1, 25, 18, 'aDEEo63cLa', '2025-04-08 09:12:58', '2025-04-08 09:12:58'),
// (138, 5460, 'شاكر محمد أيمن', 'shakr-mhmd-aymn', 'shmaym', '$2y$12$CTAhKnUWDaFNsJ3nFuqb2.GCIDo8xYMAvs/099ImuD1F83gBULc3W', '0', '1', '01016784511', 21, '1', 3, 5, 12, 21, 'i0XklPS8Fh', '2025-04-08 09:12:58', '2025-04-08 09:12:58'),
// (139, 2390, 'نغم سامر مؤيد', 'nghm-samr-moyd', 'nsmoyd', '$2y$12$P8lCG0cYTyvqfID4KZUk.OGHmd9JpUsco//ymU.UWazxWJmXuUinK', '1', '0', '01180502260', 21, '1', 7, 2, 19, 11, 'GlNAfxB8R2', '2025-04-08 09:12:58', '2025-04-08 09:12:58'),
// (140, 1037, 'مرام محمود عبدالعليم', 'mram-mhmod-aabdalaalym', 'mmaabda', '$2y$12$P9HtpSHfPgN8BKCAsAPzAOmmylIL31pOIyJ8slsdejZU4ACRs5MXq', '1', '0', '01539590900', 45, '1', 5, 7, 8, 18, 'K6HOLPj7An', '2025-04-08 09:12:58', '2025-04-08 09:12:58'),
// (141, 4813, 'عفيف بدر راضي', 'aafyf-bdr-rady', 'aabrady', '$2y$12$VfQmsgtuZ9klwx9LEGCdcOILMgEM6/bu/jqfB/9rUjlXAYmCodt4e', '0', '0', '01088845527', 30, '1', 3, 9, 20, 7, 'TYUV9Ju6L0', '2025-04-08 09:12:58', '2025-04-08 09:12:58'),
// (142, 5142, 'فخري جواد عبدالبارئ', 'fkhry-goad-aabdalbary', 'fgaabda', '$2y$12$kuHHDp7g1RtCi01BqZewaeHnq.cm8an8QyVmYboE2ceXPzA.RyhkS', '0', '0', '01134749818', 45, '1', 2, 3, 26, 16, 'oXQ2JYb4w7', '2025-04-08 09:12:58', '2025-04-08 09:12:58'),
// (143, 6648, 'لميس سراجي نصار', 'lmys-sragy-nsar', 'lsnsar', '$2y$12$tS.24T69sCbVZycmSsxpRuXhyBf7NyJbhfSdp2Bx3CvZ2lFxCXP5i', '1', '1', '01240874025', 30, '1', 6, 3, 14, 9, 'NZtv58VksT', '2025-04-08 09:12:59', '2025-04-08 09:12:59'),
// (144, 4553, 'سجا معروف عطاالله', 'sga-maarof-aataallh', 'smaataa', '$2y$12$zGehAt.FkVXEjP9BWWq21uPMROWDKlwvJ55/Rwsur1r8z5Hil7twO', '1', '0', '01587309867', 21, '1', 5, 1, 1, 19, 'TuyHjcsGeM', '2025-04-08 09:12:59', '2025-04-08 09:12:59'),
// (145, 7477, 'لينا عبدالسلام مجاهد', 'lyna-aabdalslam-mgahd', 'laamgah', '$2y$12$BeHCzQ67XlwmMBZVLQ1K8uSyM9AyqurYiGNbhjMVUna5p22pQY3za', '1', '1', '01537615360', 45, '1', 4, 3, 7, 26, 'XndEDITSQD', '2025-04-08 09:12:59', '2025-04-08 09:12:59'),
// (146, 3942, 'شهاب عصام أنس', 'shhab-aasam-ans', 'shaaan', '$2y$12$GWatLD3IVPUh8rJOXtHQ4OOjypddbmT54PQhzuctgIQDgz0TuZsgG', '0', '0', '01059139324', 30, '1', 5, 4, 11, 13, 'HtBpvubdbk', '2025-04-08 09:12:59', '2025-04-08 09:12:59'),
// (147, 9354, 'ميرال صفوان عطاالله', 'myral-sfoan-aataallh', 'msaataa', '$2y$12$ueWhwDG8ECt7vltVH0b6Xet60kcMHg7e.kwQBgihL3KQvbo1iLFkW', '1', '1', '01520972866', 30, '1', 5, 6, 26, 17, 'YzVdnfPCAq', '2025-04-08 09:12:59', '2025-04-08 09:12:59'),
// (148, 1251, 'يسرا هيثم عبدالمحسن', 'ysra-hythm-aabdalmhsn', 'yhaabd', '$2y$12$nv3x7s3lsKPeL9XU4iZZs.cHtS3cyHfw0OGgRJSRJ7RumYK.Le18m', '1', '0', '01131593493', 45, '1', 7, 6, 20, 3, 'M6SjUy1sm7', '2025-04-08 09:12:59', '2025-04-08 09:12:59'),
// (149, 8969, 'ريما عمران سعيد', 'ryma-aamran-saayd', 'raasaayd', '$2y$12$MYYkDrJOqND9tolGhvwNzOaeCDuuGIYjWH45dsO6CqJbwtGvAVcJa', '1', '0', '01163761325', 45, '1', 6, 8, 9, 20, 'LZUejHroxd', '2025-04-08 09:12:59', '2025-04-08 09:12:59'),
// (150, 4313, 'مفيد أصيل حذيفة', 'mfyd-asyl-hthyf', 'mahthyf', '$2y$12$mizAEKQKSCEUEm6q44NpUuVAAvtBYIY9BemCmLJ7/gdvo1ywDBpIu', '0', '1', '01546510705', 30, '1', 5, 8, 22, 19, 'K3gJ8PRq2P', '2025-04-08 09:12:59', '2025-04-08 09:12:59'),
// (151, 8414, 'جواهر فيصل رامي', 'goahr-fysl-ramy', 'gframy', '$2y$12$qelcRaqhU9zWimQavYHeU.9NLhc5RHJd.qKFIw7awior4D39oQyma', '1', '0', '01157137537', 21, '1', 6, 9, 9, 6, 'e97kd0Avy6', '2025-04-08 09:12:59', '2025-04-08 09:12:59'),
// (152, 6046, 'نعيمة سهوان رفيق', 'naaym-shoan-rfyk', 'nsrfyk', '$2y$12$Y9llZ6e2L66cXcjLaFkJ8ufUrux0jaFYjEhFWWkOMnv9YT.cf3REa', '1', '0', '01539331995', 45, '1', 4, 9, 7, 14, '3C8FK7f7Bc', '2025-04-08 09:13:00', '2025-04-08 09:13:00'),
// (153, 7747, 'عبدالمحسن سراج رجاء', 'aabdalmhsn-srag-rgaaa', 'aasrgaa', '$2y$12$MeM3T1O/hboD14OdYNpWceBSCHWB3ltPbKYFfZc9tlGD7aDevRBUO', '0', '0', '01033610210', 45, '1', 2, 2, 26, 26, 'BEYvcBdid1', '2025-04-08 09:13:00', '2025-04-08 09:13:00'),
// (154, 3054, 'عالية مصعب يزيد', 'aaaly-msaab-yzyd', 'aamyzyd', '$2y$12$VJtCXywByIgCSM5N3YIplu9/q4JB6Q.aFznpr/GZ9WYCdU18zKZLO', '1', '0', '01584731932', 21, '1', 1, 4, 10, 25, 'bjDh5OhEtN', '2025-04-08 09:13:00', '2025-04-08 09:13:00'),
// (155, 1021, 'جنى يزيد صالح', 'gn-yzyd-salh', 'gysalh', '$2y$12$7YL7l7eHT4Xh2ATp6HkHuedID6.Qa5D0zJHHO6n7TPLaiYgG4uY8m', '1', '1', '01147396644', 45, '1', 6, 5, 12, 9, '4mrUZnYXO2', '2025-04-08 09:13:00', '2025-04-08 09:13:00'),
// (156, 4745, 'ملك سهوان راغب', 'mlk-shoan-raghb', 'msragh', '$2y$12$HYcbRrkm/HRRGfM5iDFXVO9hwe4WObIBoUzBgVPjcXnEHnGAyIPzm', '1', '0', '01179998686', 45, '1', 4, 1, 25, 3, 'rDBmyFVemy', '2025-04-08 09:13:00', '2025-04-08 09:13:00'),
// (157, 2006, 'نورهان ياسر حامد', 'norhan-yasr-hamd', 'nyhamd', '$2y$12$TdEC/lPgKKFSGEMdEdbdQO479iae0BSVrnQqML2iHOJKj65hXPSeq', '1', '1', '01006210684', 21, '1', 1, 8, 6, 6, '6PmMD6dS8b', '2025-04-08 09:13:00', '2025-04-08 09:13:00'),
// (158, 5039, 'قيس يزن شاكر', 'kys-yzn-shakr', 'kyshakr', '$2y$12$Pwmm1SMnCcR4XQNjScVbJ.TT3Y0dThUXHme9Ch/E.g.NmS2azSw2a', '0', '1', '01226297068', 30, '1', 5, 4, 14, 11, '2nVKcFH7D5', '2025-04-08 09:13:00', '2025-04-08 09:13:00'),
// (159, 1023, 'شمس سامح عمران', 'shms-samh-aamran', 'shsaam', '$2y$12$vhb8b81pTmSymCJjJYsaJuxirUhnS/fbI3cxh0RAh0HbNCYDaK2Ii', '0', '1', '01293430308', 30, '1', 4, 7, 23, 18, 'OTaIXmmkoO', '2025-04-08 09:13:00', '2025-04-08 09:13:00'),
// (160, 2771, 'ناهد راغب شهاب', 'nahd-raghb-shhab', 'nrshha', '$2y$12$PX8Kk.NLTtokPCRJoYJD9uLyIXx0dV/OXXr0HRQk0JvjslLHU.CLu', '1', '0', '01068852594', 21, '1', 5, 1, 19, 20, 'Z7G6hOAnaS', '2025-04-08 09:13:01', '2025-04-08 09:13:01'),
// (161, 7820, 'منار سائد أيمن', 'mnar-sayd-aymn', 'msaymn', '$2y$12$Ul6JcgLEPE/rqD.oWzHr4OdBV3AzzB8QGUauBlr/pu0Ks5dZP2.7W', '1', '0', '01157653380', 45, '1', 3, 2, 27, 24, 'raB65FLVg6', '2025-04-08 09:13:01', '2025-04-08 09:13:01'),
// (162, 1902, 'صهيب مفيد مبارك', 'shyb-mfyd-mbark', 'smmbar', '$2y$12$LuWLwM/TgZSdVk/VRzilkOCEWJT1pX/qjsXXXEoakbenpAbB1JiZy', '0', '0', '01540257630', 21, '1', 4, 1, 15, 13, 'nXm9WBQwzI', '2025-04-08 09:13:01', '2025-04-08 09:13:01'),
// (163, 4981, 'عبدالحكيم بلال بلال', 'aabdalhkym-blal-blal', 'aabbla', '$2y$12$6xpw2jM7Y0RaJ3ThPZlaEuqgZw.xsEr7ru40ODVy1sAp9oBkiRWYe', '0', '0', '01212237806', 30, '1', 1, 7, 13, 1, 'zMukiUf3uN', '2025-04-08 09:13:01', '2025-04-08 09:13:01'),
// (164, 6503, 'ندى منصور عبدالمجيد', 'nd-mnsor-aabdalmgyd', 'nmaabda', '$2y$12$b/JnfqSCsN0zMbjQ2TJJW.ENTelnJ5WWLW1v6ui9ak//gHdy/xjPm', '1', '0', '01219899208', 21, '1', 7, 6, 18, 17, 'OQWd2WJunJ', '2025-04-08 09:13:01', '2025-04-08 09:13:01'),
// (165, 3812, 'ميسون بشر علوان', 'myson-bshr-aaloan', 'mbaaloa', '$2y$12$YZ21iumhOKhI9wl7RddtRe.gspB/4.truCxPR3H7IkytMuDVGVcGS', '1', '0', '01033755779', 30, '1', 4, 7, 12, 1, 'fEvcdEJguG', '2025-04-08 09:13:01', '2025-04-08 09:13:01'),
// (166, 3023, 'رزان عبدالرحمن توفيق', 'rzan-aabdalrhmn-tofyk', 'raatofy', '$2y$12$xB.6JcjO9JQBRj5Ntfto4ui4Sq3BmyRMbl9UbeSzX8PYaiB3.ksRy', '1', '1', '01191585257', 45, '1', 6, 1, 27, 25, 'LWh8IxkziE', '2025-04-08 09:13:01', '2025-04-08 09:13:01'),
// (167, 9580, 'عبدالرزاق غالب مصلح', 'aabdalrzak-ghalb-mslh', 'aaghms', '$2y$12$R/Iuan0CF3W6mCutChOrvuwErfIa644yiij1PMExRqV9VNzsaWLxq', '0', '1', '01219965750', 45, '1', 1, 4, 20, 5, 'AfifbXBZWe', '2025-04-08 09:13:01', '2025-04-08 09:13:01'),
// (168, 1683, 'بسام سليم توفيق', 'bsam-slym-tofyk', 'bstofy', '$2y$12$XvTRQqjzVuExFKTI3A0UbeJU/HjRGIolrSchSeT/ruqE8h5orc6Gu', '0', '1', '01557692078', 30, '1', 3, 6, 24, 5, 'MjlIS1vBmV', '2025-04-08 09:13:02', '2025-04-08 09:13:02'),
// (169, 2861, 'حميد فؤاد نادر', 'hmyd-foad-nadr', 'hfnadr', '$2y$12$04IndqVrD6v1b3Whg6lMY.60P6ww9WWypc0318yUTb/2qsTaZP5Bq', '0', '1', '01537180522', 21, '1', 1, 9, 22, 15, '3jQMRLxELE', '2025-04-08 09:13:02', '2025-04-08 09:13:02'),
// (170, 9699, 'قيس نادر علوان', 'kys-nadr-aaloan', 'knaaloa', '$2y$12$ko3ldDuxNAjrxZZqEmsAmuIYFgfRkFw/AACPDainCyY.Ja/p/.VT6', '0', '0', '01214199430', 21, '1', 4, 7, 7, 3, 'HOYXoMMaLb', '2025-04-08 09:13:02', '2025-04-08 09:13:02'),
// (171, 4888, 'رحمة زكريا فواز', 'rhm-zkrya-foaz', 'rzfoaz', '$2y$12$4T8Nfm0XdwzkGZOC67LV1.iEFEVBY2Q4XWeQnWd6KfMZYnfpEU6mK', '1', '0', '01079207761', 45, '1', 7, 1, 25, 23, 'AMuiKt1vzq', '2025-04-08 09:13:02', '2025-04-08 09:13:02'),
// (172, 7025, 'سامي فهد عبدالقدوس', 'samy-fhd-aabdalkdos', 'sfaabd', '$2y$12$XK6B0jw6NegNjlPk618jMevu0/NHj91rrg/OOrMWcETu4ijOhaJhm', '0', '0', '01005647362', 45, '1', 4, 5, 25, 17, '7LdFKcBjsH', '2025-04-08 09:13:02', '2025-04-08 09:13:02'),
// (173, 2951, 'علوان أدهم خطاب', 'aaloan-adhm-khtab', 'aaakht', '$2y$12$BAj3TZHEWwlveF4kvgCB.u8yYogWHc.0ue4jDHkzpysWNILMY.g1y', '0', '1', '01544630031', 30, '1', 5, 6, 24, 11, '2BGhgjjWOx', '2025-04-08 09:13:02', '2025-04-08 09:13:02'),
// (174, 2239, 'عفاف مراد أشرف', 'aafaf-mrad-ashrf', 'aamashrf', '$2y$12$/unJp1Wpn7U7.4rwSZz4TOIP/Q3GPeUkfR9sQgP7zHxPoFDOIQOfS', '1', '1', '01091966741', 21, '1', 7, 7, 14, 17, 'uAc5YNh84L', '2025-04-08 09:13:03', '2025-04-08 09:13:03'),
// (175, 6571, 'لاما صبري زين', 'lama-sbry-zyn', 'lszyn', '$2y$12$4qyNF1LNES/y9NBxS1K3se.uUQAuG2WTstBQ5Zbm8DFwOPdlYr/JW', '1', '1', '01588580411', 45, '1', 5, 3, 16, 25, 'Vkxo1rmycz', '2025-04-08 09:13:03', '2025-04-08 09:13:03'),
// (176, 7730, 'كرمة زكريا هيثم', 'krm-zkrya-hythm', 'kzhythm', '$2y$12$oGiMiKTeICDAaMw80LDZHepTZCHmnPikE2Y2C1/oacpw7ypQyE7XS', '1', '0', '01156772285', 30, '1', 1, 2, 14, 12, '3WBJ3MvaXc', '2025-04-08 09:13:03', '2025-04-08 09:13:03'),
// (177, 9383, 'أيمن سهوان علاء', 'aymn-shoan-aalaaa', 'asaalaa', '$2y$12$tbMwby6.OKttv0Byd06HkuzkldrQIvBZqkYJT9q1H8PUrjCRRSRiK', '0', '1', '01156972942', 21, '1', 2, 8, 1, 10, '4ap8fIaLul', '2025-04-08 09:13:03', '2025-04-08 09:13:03'),
// (178, 7331, 'هبة الله محفوظ أنس', 'hb-allh-mhfoth-ans', 'hamans', '$2y$12$xOLKDKpgXUTxHumOb5hYt.ygrFG8XmktxJE50PAoRiPNxrNS0VgC2', '1', '1', '01128560066', 30, '1', 1, 3, 19, 21, 'v9w0rfgn8Q', '2025-04-08 09:13:03', '2025-04-08 09:13:03'),
// (179, 2005, 'مأمون عدنان لؤي', 'mamon-aadnan-loy', 'maaloy', '$2y$12$ljTyOhIT26nkfKYwRAdOgeHHSe5buvjNOCCnvbbmOziTmO3zMORxC', '0', '1', '01257966920', 45, '1', 5, 4, 6, 26, 'hdloEFXfGe', '2025-04-08 09:13:03', '2025-04-08 09:13:03'),
// (180, 2377, 'جود طاهر وجيه', 'god-tahr-ogyh', 'gtogyh', '$2y$12$6N9jELJMHG.RwDqJSnrCn.8l/2swKNool.0iJb1oKQdMDnZnpR9Oy', '1', '0', '01139873268', 30, '1', 2, 3, 22, 7, 'ybIKRlTeWC', '2025-04-08 09:13:03', '2025-04-08 09:13:03'),
// (181, 8357, 'صبري عبدالفتاح شاهين', 'sbry-aabdalftah-shahyn', 'saashahy', '$2y$12$iX.uswNVZTrtNZ6W4GtY7.V2NXSBDPmB0xSaDPetDHCBpYua0/Z.K', '0', '0', '01142429230', 45, '1', 4, 6, 1, 12, 'FQbZ81sOvd', '2025-04-08 09:13:03', '2025-04-08 09:13:03'),
// (182, 1995, 'رائف سائد علاء', 'rayf-sayd-aalaaa', 'rsaalaaa', '$2y$12$BYilvLzwRJqPr8sxo62CEee/B3jzz8lY5LAbLlX/IXLLFxikEVAyS', '0', '0', '01172167052', 30, '1', 3, 1, 7, 1, 'JoZSzrA2sS', '2025-04-08 09:13:03', '2025-04-08 09:13:03'),
// (183, 2881, 'نيرمين راغب سامر', 'nyrmyn-raghb-samr', 'nrsamr', '$2y$12$4/NKLFaP8e7LBU59vo2Os.xzTHQS7VT9k2Lnwrq.rYy2Ly1o77Lx2', '1', '1', '01518130442', 21, '1', 4, 5, 15, 26, 'DFcItCt7AH', '2025-04-08 09:13:03', '2025-04-08 09:13:03'),
// (184, 4304, 'ممتاز أديب طارق', 'mmtaz-adyb-tark', 'matark', '$2y$12$Y5bcm9AGxxy6TObYmgqY8esqL5FArU9hPBtYq76OwwtnUjt0dE60q', '0', '0', '01216061168', 30, '1', 5, 5, 22, 1, 'jP8dhqXMyu', '2025-04-08 09:13:04', '2025-04-08 09:13:04'),
// (185, 2469, 'منصور حيدر براء', 'mnsor-hydr-braaa', 'mhbraa', '$2y$12$S88vcdVcqokvr9J8m8ex6eGpyeTJnhuf3kGIHlSuKqsZo39PepzMy', '0', '1', '01039521506', 45, '1', 4, 9, 3, 11, '6VSIJ0wJAv', '2025-04-08 09:13:04', '2025-04-08 09:13:04'),
// (186, 2488, 'بديع نواف مصطفى', 'bdyaa-noaf-mstf', 'bnmstf', '$2y$12$hDHHM9A0CbFIC986YLAeK.g3T4IwreTr9BdZ2Ha/L3eYHJeXPCBma', '0', '0', '01175481112', 45, '1', 2, 3, 24, 26, '2PdA39tO6F', '2025-04-08 09:13:04', '2025-04-08 09:13:04'),
// (187, 7668, 'عبدالرزاق زكي صهيب', 'aabdalrzak-zky-shyb', 'aazshy', '$2y$12$ViAuGpK90mGKfs0yvqN8XOlHcY4fccLkCw4gXeaCJt9ZfuAQFI78O', '0', '0', '01202052412', 21, '1', 1, 7, 4, 19, '7B87Lw2pxZ', '2025-04-08 09:13:04', '2025-04-08 09:13:04'),
// (188, 5731, 'بياضة مقداد فارس', 'byad-mkdad-fars', 'bmfars', '$2y$12$EYyfQi4/nDX5loYwgCY1p.THL9.ixS.UasMFPCTh6F6CZJHwLL6.y', '1', '0', '01527375427', 45, '1', 2, 5, 15, 18, 'HVuoDY88Vt', '2025-04-08 09:13:04', '2025-04-08 09:13:04'),
// (189, 4429, 'وسيم فيصل نزار', 'osym-fysl-nzar', 'ofnzar', '$2y$12$9w3pyVNzmPBmEE/7BIEnduxxJX1p9LLVh.OemM03qUcs6urRJjkR6', '0', '1', '01067794723', 45, '1', 6, 6, 19, 9, 'd3OV89mH2r', '2025-04-08 09:13:04', '2025-04-08 09:13:04'),
// (190, 4487, 'يزن منيف نبراس', 'yzn-mnyf-nbras', 'ymnbra', '$2y$12$DDMNSS6uSNEqZYcLFjnQDuL6kuVXv7UZfOckAoQlpwxu/4QFSlaeq', '0', '0', '01182979519', 21, '1', 3, 9, 8, 5, 'yGuizgXmCi', '2025-04-08 09:13:05', '2025-04-08 09:13:05'),
// (191, 3953, 'ميرفت فخري عبدالمحسن', 'myrft-fkhry-aabdalmhsn', 'mfaabda', '$2y$12$oTlLBnHF1eOMaPgsIz/iLukJ6.mAhiUusQu3jvoUZ.jGaiWyF43Sq', '1', '1', '01501624220', 21, '1', 3, 9, 22, 12, 'EdrnISQ9vl', '2025-04-08 09:13:05', '2025-04-08 09:13:05'),
// (192, 2234, 'لينا عبدالسلام عطا', 'lyna-aabdalslam-aata', 'laaaat', '$2y$12$jnwKDF/e392hJjHdWNdiLOnCV4Sl3m5kvCw0U1YEThtegpnSahnpG', '1', '0', '01094647092', 30, '1', 6, 4, 27, 11, 'a6l4Ss9Mwp', '2025-04-08 09:13:05', '2025-04-08 09:13:05'),
// (193, 1236, 'ميرال مخلص حسان', 'myral-mkhls-hsan', 'mmhsan', '$2y$12$knlsN6LhpHBe.qrLMvc4.ukupPQdZ.uZLbHKc3WKKlenLBsPik0Oa', '1', '1', '01189685058', 21, '1', 5, 8, 4, 14, 'EdyhSi5uAI', '2025-04-08 09:13:05', '2025-04-08 09:13:05'),
// (194, 8462, 'تالة رجاء أديب', 'tal-rgaaa-adyb', 'tradyb', '$2y$12$cn6Ke0TdbpxyWGB1vT6AH.sR7qML6F8F3uOQ5luvKLvZ2YPjIFd8S', '1', '0', '01253476210', 45, '1', 6, 6, 5, 2, 'nfBYz8IYtN', '2025-04-08 09:13:05', '2025-04-08 09:13:05'),
// (195, 9127, 'خالد علاء أشرف', 'khald-aalaaa-ashrf', 'khaaas', '$2y$12$KOXkeYIuQXqnoIPTs4wc5OImpNLsCNLYnEhfvCYaBWTmaX5c.7M.e', '0', '0', '01589707085', 21, '1', 5, 4, 14, 22, 'sIq1Hh7Y4I', '2025-04-08 09:13:05', '2025-04-08 09:13:05');