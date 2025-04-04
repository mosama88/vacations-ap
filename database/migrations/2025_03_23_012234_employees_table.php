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


// INSERT INTO `employees` (`id`, `employee_code`, `name`, `slug`, `username`, `password`, `gender`, `type`, `mobile`, `status`, `week_id`, `job_grade_id`, `branch_id`, `governorate_id`, `remember_token`, `created_at`, `updated_at`) VALUES
// (1, 6595, 'ندى مخلص سامح', 'nd-mkhls-samh', 'nmsamh', '$2y$12$XobtgJ8rTMD5XrWIlNU1MecyqGPkJ.sM2p0JkTR4fI6lvpqTehHSO', '1', '0', '01566831146', '1', 3, 1, 19, 15, 'bnJEtSaC5t', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (2, 4447, 'ثروت فضل قيس', 'throt-fdl-kys', 'thfkys', '$2y$12$xOEVzt78MuhKEmb8mFaQ8OWS/6vFTjhAF1BflASIZJxR22v/xw94q', '0', '1', '01247182046', '1', 4, 1, 9, 3, '16ZdOAW7IT', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (3, 5778, 'بثينة عبدالحكيم وسيم', 'bthyn-aabdalhkym-osym', 'baaosy', '$2y$12$9C7aYGDT2Ug4yKrvTTcpXe8Gh4zTk2qjDj/0hEakxvkUdiK9Hq0AC', '1', '1', '01299974065', '1', 6, 7, 5, 22, 'mDQFjwaJN1', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (4, 9302, 'فداء حسان عبدالبارئ', 'fdaaa-hsan-aabdalbary', 'fhaabda', '$2y$12$hyxdOETloFHgpkrA7ilvF.ZS2795iFds9Qet1lIODSPj8DQ0o9WR6', '1', '1', '01261539837', '1', 5, 6, 16, 26, 'mNflVdbYPA', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (5, 8516, 'سهيل آدم سعيد', 'shyl-adm-saayd', 'sasaayd', '$2y$12$IkChXG8qBEVscqY4O16BoOM9bBgJIWZJAaQyQKAvkT8mcjBVlRHVu', '0', '0', '01093994154', '1', 6, 2, 28, 28, '1e0oNM02DM', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (6, 4616, 'مهند عبدالباري عبدالصمد', 'mhnd-aabdalbary-aabdalsmd', 'maaaab', '$2y$12$pwZ3lk3wvwutzboH3qXyGO4LTAOVzMPM4TcX/6xsoN23D.xWH1R2m', '0', '0', '01076570051', '1', 5, 7, 24, 5, '65R3JsvapI', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (7, 4663, 'شعلان أيمن يونس', 'shaalan-aymn-yons', 'shayon', '$2y$12$U9.qz4o.O5rWTw3bYDWByOa8iIVK8Bg8Egy.jmrJAAO6It1dFhdNu', '0', '0', '01190177754', '1', 6, 2, 11, 20, 'tvgwUYozX5', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (8, 3649, 'نوف حكيم حيدر', 'nof-hkym-hydr', 'nhhydr', '$2y$12$7pJ6r1CZ1uoDUPFvA4GEcOORZoqHiGeHJ8sgg3fbZV9fq6ZsAWxaC', '1', '1', '01179729865', '1', 1, 1, 19, 3, 'mKHGIdWtr4', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (9, 5817, 'يسرى إيهاب عبدالرزاق', 'ysr-ayhab-aabdalrzak', 'yaaabda', '$2y$12$I/5TEjCWz7sQCnM/8Nofi.BESyaGJurg1KtypPfSuZurnNHvPV0AK', '1', '0', '01204876069', '1', 6, 8, 19, 1, 'SCAJP8j7jr', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (10, 4739, 'عزام مازن ناجي', 'aazam-mazn-nagy', 'aamnagy', '$2y$12$DEI4JwkfXxm5H3ImYFxEzuzm2KNwxg65up1ptPGr6vJlNjjpjwY0a', '0', '1', '01092653468', '1', 3, 6, 5, 15, '0FPrU9GfK1', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (11, 6147, 'وجيه مفيد عبدالودود', 'ogyh-mfyd-aabdalodod', 'omaabda', '$2y$12$46UevasxCKYWO2X9IRz5luFmj17Na7NRUishZZHK3FiNzmG5jEbAm', '0', '1', '01007233732', '1', 1, 4, 18, 26, 'uQ46RQeDO0', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (12, 9159, 'نورين عزام مبارك', 'noryn-aazam-mbark', 'naamba', '$2y$12$y9C37HplOxEsfAkcZ0bg9uPFXCCzJlgCCOV6ldzPA4U6bGMgWXdV6', '1', '1', '01270576509', '1', 4, 6, 12, 22, 'rpIkmF94Sv', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (13, 8935, 'عبدالكبير رشاد رامي', 'aabdalkbyr-rshad-ramy', 'aarramy', '$2y$12$m/1VQKxFcDq2U9LE/1qeCuiX8nzb2lzaPvRH85nzhYtpqGMDHlU4i', '0', '0', '01070767813', '1', 2, 6, 20, 14, 'dXZwaXQs9q', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (14, 7558, 'بلال نهاد ليث', 'blal-nhad-lyth', 'bnlyth', '$2y$12$ltkDRsTp7gfaZCSvNGGIROYuI/liCmOu0Z93F4Jkr.3I3QQJk4Zrq', '0', '0', '01030262086', '1', 6, 7, 15, 2, 'd8UxzSwZPS', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (15, 6961, 'نهى هاني عارف', 'nh-hany-aaarf', 'nhaaarf', '$2y$12$6VHCkN8PQqBrHt78a1yIgOqOFvZeKjsySdy5GmeSf0uKjWH.ojVkm', '1', '0', '01090270898', '1', 6, 5, 21, 21, 'IhQClxRW6c', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (16, 7412, 'ضحى شوقي سلامة', 'dh-shoky-slam', 'dshslam', '$2y$12$ir1/0XNIpJj5DlAz0ooFpu4ua6FOh0/urMHXFcm7ms/.0OlSq3j6q', '1', '0', '01249482755', '1', 2, 8, 19, 16, 'JAgzV60DT8', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (17, 8665, 'سرمد محسن زكريا', 'srmd-mhsn-zkrya', 'smzkry', '$2y$12$Itm5e67iEYkpIJNHUOeDPOHvYhX/wUnWejtUIF36z.F/sUifjqytG', '0', '0', '01089610558', '1', 5, 7, 15, 14, 'uqyQfwYxqD', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (18, 2478, 'روان عبدالمجيد مؤيد', 'roan-aabdalmgyd-moyd', 'raamoyd', '$2y$12$YsmSorVoApvNehmtiplMjeh5t.7.95I0GpOalU91FYP5Bl9Q1KSom', '1', '0', '01598252034', '1', 5, 9, 14, 27, 'sH5vu6oPR0', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (19, 1188, 'ساري كرم عبود', 'sary-krm-aabod', 'skaabo', '$2y$12$6mgvoFmmtuxNwK.gzMEqW.vdqSpFYjz9cWmMjdrNgLkpvgU0ryWoq', '0', '0', '01163526114', '1', 3, 9, 22, 17, 'N5oTbpkj8V', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (20, 6284, 'ريما يوسف لؤي', 'ryma-yosf-loy', 'ryloy', '$2y$12$iPH4eEqMo.nBtCwtucGPKeervnw/wbub1i84wwb.fcN7oFEJYc/ZC', '1', '1', '01136959515', '1', 2, 6, 13, 11, 'i7wSazPcCz', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (21, 8880, 'شاهين مشعل عبدالوهاب', 'shahyn-mshaal-aabdalohab', 'shmaabd', '$2y$12$yHH3Cs45N402DtuFHYoX0.PShr6vECyNLkFdLox96VHIfKfs7tcPi', '0', '1', '01248772638', '1', 2, 5, 9, 12, 'Zuw6Qsgm2n', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (22, 6175, 'نعمة منذر باسم', 'naam-mnthr-basm', 'nmbasm', '$2y$12$EIneZpMg4ps8NeQE69cURu/hz1Aqgi6qEGKbVAmSt7tBkCgPnWu9G', '1', '0', '01271292329', '1', 5, 2, 15, 9, 'kxOoErBtZ6', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (23, 4762, 'رائد عبدالودود كمال', 'rayd-aabdalodod-kmal', 'raakma', '$2y$12$VkEXiTmftRk38/bptnZejONMLXzDGaPilo.XIWJxHC/LDYGsm4Irm', '0', '1', '01078614775', '1', 6, 2, 9, 14, '9FZYUpIw2b', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (24, 3128, 'ناريمان زيد نجيب', 'naryman-zyd-ngyb', 'nzngyb', '$2y$12$SIJeaRHI6620PgM3Rb3z3.tz.O1puwGcZnIlO7SGf33Ug4xb2G2Zu', '1', '0', '01218403918', '1', 1, 6, 19, 25, 'JTCDGF6hbD', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (25, 6717, 'دارين ظافر لطفي', 'daryn-thafr-ltfy', 'dthltf', '$2y$12$ItDY7wukB1jeIwYt4pyTVe8NiWawrbXgmIcELqux6hfsFVPoZnRzy', '1', '1', '01018124185', '1', 6, 1, 14, 9, 'epsBp1zfrj', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (26, 2888, 'عبير مبارك وحيد', 'aabyr-mbark-ohyd', 'aamohyd', '$2y$12$3P8ReUpSCBU20KVaeUdUAuriR2Q1fJKXBZbHFMqfXR1BMLrRZJ8ZW', '1', '1', '01023206862', '1', 3, 1, 21, 14, 'GtrBKSTVUC', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (27, 4782, 'قيس مازن يونس', 'kys-mazn-yons', 'kmyons', '$2y$12$dgtx1PRRKLhJ5pXu6gTOmu9ukoJUO5lFufamkvE3OKvcQ7L0g6TeK', '0', '1', '01548908074', '1', 5, 9, 10, 23, 'AkpoPLclqO', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (28, 8719, 'لؤي رائف صالح', 'loy-rayf-salh', 'lrsalh', '$2y$12$qxoQpGVNtBILw7PTLTLyw.tK0tGq2Ahz/MsAeF4kz1Wbqe65WUa2K', '0', '1', '01087815083', '1', 2, 8, 13, 13, 'SoWi9QAbDc', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (29, 5375, 'هنادي بكر أصيل', 'hnady-bkr-asyl', 'hbasyl', '$2y$12$XZGsksC6o8917sUx6Xq2fesS40oyZi.WP.6XgoLXM/FMpHrqA.iTC', '1', '1', '01285448911', '1', 6, 8, 22, 20, 'x2jxRll95P', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (30, 4051, 'حنين وسام ساري', 'hnyn-osam-sary', 'hosary', '$2y$12$fBAyDFh1/KbegqI9Cap3a.5szoFdtMSlqKiWA05MX5sstnUP8Ywpy', '1', '1', '01113803590', '1', 1, 5, 20, 28, 'aOiaqmysxE', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (31, 3592, 'نوران وسيم شاكر', 'noran-osym-shakr', 'noshak', '$2y$12$j/7kPA/hdwGESR56X3SA6OZn.oMOadOdxeFkYiyXkQ9Qljlc45KKi', '1', '0', '01286566843', '1', 7, 9, 2, 12, 'EeKEbD7rN7', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (32, 2489, 'كرم علي مقداد', 'krm-aaly-mkdad', 'kaamkda', '$2y$12$TDS4V2rx24hWs30bcJb/a.5s9yZiEcHVni0AHqOCojbsu.SqU1Ouy', '0', '0', '01213351393', '1', 7, 6, 23, 21, 'MamT6Q5bpj', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (33, 1500, 'ربيع محسن جواد', 'rbyaa-mhsn-goad', 'rmgoad', '$2y$12$0WMJojypYPz6M1Ot3b6ukeiastZkdZB6baYLHE126KaqOa2w9ZyZm', '0', '0', '01508720779', '1', 5, 4, 11, 11, 'jNsfgtqt4t', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (34, 9095, 'وجيه لؤي سهيل', 'ogyh-loy-shyl', 'olshyl', '$2y$12$y7/CMvm64H12ycPpNuJaXOLC/5mYendfABS5MBqqKsenAEpNnCQeu', '0', '0', '01575818906', '1', 2, 1, 21, 13, '80EgzgdYGe', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (35, 9612, 'هبة أكرم كرم', 'hb-akrm-krm', 'hakrm', '$2y$12$Mo9H3CN5zmZsCe3X.vrjX./V/MGOvY2mPn8mivt5qBfbOJ89pMTiC', '1', '0', '01580337921', '1', 1, 1, 11, 12, 'fp8oGMEcrV', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (36, 7000, 'سهوان عبدالحافظ زيد', 'shoan-aabdalhafth-zyd', 'saazyd', '$2y$12$DVS9CLj4VFrt0WchbQwrV.ixHJjxYYwvRQq3k0Akl5r3/AMT4GBu2', '0', '0', '01048566505', '1', 1, 6, 27, 9, 'xLd91CAR49', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (37, 7684, 'رماح سامي طلال', 'rmah-samy-tlal', 'rstlal', '$2y$12$SqPtnVdnM0bFSoPd/6BHEuUWNIxcReJyaT8Mi.WUcEVW/SkfYygfq', '0', '1', '01519161164', '1', 5, 8, 17, 17, 'qFG93iu8Rs', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (38, 9135, 'إيهاب صفوان بدر', 'ayhab-sfoan-bdr', 'asbdr', '$2y$12$mMYuxmTONEEyK7kIbBzBvuTU5mrdK5bFhPCc6bKzc7YgtJhPJUUGC', '0', '1', '01505438007', '1', 7, 6, 21, 3, '3LX5sCn6Ua', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (39, 8756, 'لطفي عبداللطيف سامح', 'ltfy-aabdalltyf-samh', 'laasamh', '$2y$12$gOzEtSTeE06VEx0FPS6jX.yJoKY/EGPqYlpKTViDo9xzQtgjcbAcq', '0', '1', '01582809868', '1', 3, 9, 25, 2, '9SU1rObHpP', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (40, 6680, 'مبارك شعبان بكر', 'mbark-shaaban-bkr', 'mshbkr', '$2y$12$oTnLbQI3e4tfQJQAXoPVo.kiMhVMoYbYpyYum1F5C7jO./ZWguWs6', '0', '1', '01034265666', '1', 3, 5, 2, 13, 'TvWFT46kH7', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (41, 3496, 'نعيمة شاكر شهاب', 'naaym-shakr-shhab', 'nshshh', '$2y$12$j7MFM0JBA8hv0BnoHBV5j.RBA5866/aym14LwFv5ovWhUpIQ0FElO', '1', '1', '01149655819', '1', 6, 1, 2, 4, 'K5LUBwKIFf', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (42, 8298, 'نيرمين رماح عماد', 'nyrmyn-rmah-aamad', 'nraamad', '$2y$12$EzrnEfy1cYoNzrVUfwnhR.Wh3zyJHMSx8NZkwv.0b06ojGefnw60K', '1', '1', '01554294840', '1', 1, 8, 11, 9, 'Kj7NWCes3a', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (43, 8843, 'لبنى عبدالفتاح غازي', 'lbn-aabdalftah-ghazy', 'laagha', '$2y$12$31DbeRN0YBgeYy6JFwEKBO1C.xY8hx52.CQ9Tsz4mk/EtaxczquQW', '1', '0', '01190361479', '1', 5, 8, 11, 2, 'zn8ylTG1X1', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (44, 5317, 'أدهم سامر كمال', 'adhm-samr-kmal', 'askmal', '$2y$12$LIW4UIlcF0865B9tS3mKDui8Fj6UWJc0qbttVSb56LbZ2KVIgr6qS', '0', '0', '01255635013', '1', 4, 1, 3, 28, '3UQ3eGgh65', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (45, 6401, 'راغب عدنان ربيع', 'raghb-aadnan-rbyaa', 'raarby', '$2y$12$jJXfo7m3gtp5aMkNnWigO.eqomck5btotz.lLiKNgfkU8ASOB1ody', '0', '1', '01172833114', '1', 7, 5, 5, 5, '1EKFaWcet0', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (46, 3370, 'مؤمن مصطفى عبد', 'momn-mstf-aabd', 'mmaabd', '$2y$12$hPy7uYbRGSxHDcqQKPuRFOA7gpJa5BpZkI1IdStgo7OzcnQYohCXa', '0', '0', '01051081318', '1', 5, 7, 27, 23, 'QweDEIgcgT', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (47, 8328, 'هاني محمود بلال', 'hany-mhmod-blal', 'hmblal', '$2y$12$bZw4us5HhJX1PJ6.aRqzMu2yfB7gr6HRHhsRbob8UwC2RP1.3jYae', '0', '1', '01551034239', '1', 4, 8, 11, 28, 'XaL2lAiP4r', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (48, 5651, 'سهيل فضل جواد', 'shyl-fdl-goad', 'sfgoad', '$2y$12$w4tA5cn9TtowY5P1vQdMGeqTNrmzTZ70SB287ZaJDuWwZJ.2iVbV2', '0', '1', '01278101432', '1', 6, 3, 3, 3, 'fjx34f3Kal', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (49, 4535, 'عبير عبدالقدوس بديع', 'aabyr-aabdalkdos-bdyaa', 'aaaabd', '$2y$12$sho9LX/YPDzVkJZmgOh8HOIlihZWsspFYgLGybrjwwuVKfJ8YEeiy', '1', '1', '01547556888', '1', 6, 4, 21, 8, '01gZQjXBDU', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (50, 8565, 'جبر شوقي رائد', 'gbr-shoky-rayd', 'gshray', '$2y$12$tth8I6ZxrNw6aFOKLc01GukJe7psUQjGziNn0328kTBY1aKDZmuUm', '0', '1', '01237091263', '1', 5, 1, 1, 3, 'vssp0gHguj', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (51, 3199, 'صوفيا زهران حامد', 'sofya-zhran-hamd', 'szhamd', '$2y$12$tSNsfulUDBNwl4B1quiywewarFNGCeJdw/hbTs7Y2qiatPZ8uZ2ca', '1', '1', '01284655369', '1', 6, 7, 12, 18, '74bchMOtmO', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (52, 5057, 'حسان بسام منيف', 'hsan-bsam-mnyf', 'hbmnyf', '$2y$12$BA2ktNWmmuZAemZTZsCv.uctW2lmJd9YZz6DE5oA85yY/fFe4KIJy', '0', '0', '01595425063', '1', 2, 4, 6, 25, 'o2iPIZeu9i', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (53, 2539, 'تولين كنعان عبدالبارئ', 'tolyn-knaaan-aabdalbary', 'tkaabda', '$2y$12$cnmgJPku2HWBq/63JWmHWeRxoNrlULu4ik01UtDoIsasAOhaF/JIC', '1', '1', '01279425687', '1', 2, 1, 5, 7, 'Isg25ZXtPU', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (54, 9277, 'سناء فهد ربيع', 'snaaa-fhd-rbyaa', 'sfrbyaa', '$2y$12$Y5jZDUkWDT8Il4r5HX7VGO9Zf5Y/aotCQeA7UojMG41NNzKGD27S2', '1', '0', '01559373818', '1', 7, 7, 25, 14, 'aYy2u115gm', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (55, 4015, 'حياة نصار سالم', 'hya-nsar-salm', 'hnsalm', '$2y$12$.HtUJNmTogSHjjQLfBwIaexbrsj9AFiy/AFMMr5TXNAuEkavxKbVO', '1', '0', '01090420311', '1', 7, 5, 23, 25, 'PiYDA3uBRW', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (56, 2406, 'طلال سامح طلال', 'tlal-samh-tlal', 'tstlal', '$2y$12$e4BIN.UByUHsAKPSuxrqmOBWaq7UVGRbYjQEVkoTun0RFxVMAo4rC', '0', '1', '01165715249', '1', 5, 1, 15, 23, 'L0s4wWTPmi', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (57, 2613, 'أحمد ربيع هيثم', 'ahmd-rbyaa-hythm', 'arhythm', '$2y$12$QR23LMYd3fkPLOrWlS0yx.cbWiFKg2vYJxBqBreZ1yteCwlBPl58G', '0', '0', '01579229431', '1', 3, 7, 4, 26, 'SifKzI6Nz8', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (58, 8266, 'حياة عبدالفتاح رؤوف', 'hya-aabdalftah-roof', 'haaroof', '$2y$12$MsJZ8Uj8TlD27nMCrjBN7e4TzE0Y1GBiIrnAuM0Xfqj18YT22aPXi', '1', '0', '01003913180', '1', 3, 3, 18, 24, 'ZRlCXkD652', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (59, 5937, 'خلود رائد شاهين', 'khlod-rayd-shahyn', 'khrshahy', '$2y$12$1ZY6EVd5hOBbnucoK/G2fu7qROns4mLc9FlEQZ66jCJGkt0UZOuEu', '1', '0', '01165771214', '1', 6, 4, 2, 14, '8A2iyKwa2w', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (60, 3689, 'بيان وسام وجيه', 'byan-osam-ogyh', 'boogyh', '$2y$12$k0pv8M5o913P.MXKw7fiy.NhgSgtHJw25VQBHYMxgNYjyPElY5p2G', '1', '1', '01091195395', '1', 4, 9, 10, 11, 'fHz0ciCxzO', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (61, 8791, 'سهير حسان أصيل', 'shyr-hsan-asyl', 'shasyl', '$2y$12$UKayYRm2YewcuWeMfXZK3e/3.eixnU7XXgaowpcmN6LncFvbjdKQe', '1', '1', '01277342045', '1', 1, 5, 24, 25, '9zdxVo9ply', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (62, 3590, 'سلامة كريم إلياس', 'slam-krym-alyas', 'skalya', '$2y$12$T2RevJhZPOAIY1b.hr.ngud4cjt.xX9iyJKKwa6ay2SXXZqHUnPQW', '0', '1', '01535852067', '1', 2, 3, 21, 24, 'N5xdrHKIDb', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (63, 1429, 'روبي سهيل خطاب', 'roby-shyl-khtab', 'rskhta', '$2y$12$Oq0itbmvIvrLQSqkk.HyKeFQPfzlPSWHrxaso.HSBsPCZ6GJhk30q', '1', '0', '01038226331', '1', 7, 5, 13, 11, 't2vSegrunY', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (64, 2125, 'سجى سائد حسان', 'sg-sayd-hsan', 'sshsan', '$2y$12$d38oaONk1GYVeE/dbhj8Ge2CX/WyqM6h1HmUG27h/tYrkhO964qYC', '1', '1', '01540219007', '1', 6, 9, 1, 13, 'BWAQrGSXLW', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (65, 5772, 'ناهد سراجي نجيب', 'nahd-sragy-ngyb', 'nsngyb', '$2y$12$bP8utuxoagC29d8gif8Lg.78Ml8pvMcsNDDZ3QqrR2BZGI5OZnQVO', '1', '0', '01076010832', '1', 6, 4, 7, 22, 'ubplCOEY7Y', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (66, 2155, 'هند براء سعيد', 'hnd-braaa-saayd', 'hbsaay', '$2y$12$F8QK4ZYOyYG0S6GPWtZYQ.H1JC3CtoGHHjOELrb0mUyQ7msEjoew2', '1', '0', '01298067385', '1', 6, 7, 23, 26, 'P7bITB0m4J', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (67, 6179, 'حذيفة عبدالكريم أنيس', 'hthyf-aabdalkrym-anys', 'haaanys', '$2y$12$lC19OkDy/VxWgayYDf8JR.LCRZ3cgtL63lRisEQPmIn9u2lPA5TAi', '0', '1', '01177498059', '1', 6, 9, 13, 8, 'VWveqKIeDd', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (68, 8914, 'خولة قادر منصور', 'khol-kadr-mnsor', 'khkmnso', '$2y$12$ZogjHbk7TP0Vpiny3ywEv.LKLL/YZxIjp065LvtY/.nEaUqY18rDS', '1', '1', '01529653253', '1', 2, 3, 4, 4, 'Qo9LL6xcf6', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (69, 9009, 'أكرم رياض محجوب', 'akrm-ryad-mhgob', 'armhgo', '$2y$12$ujhrKlqcB7zZXGp7Xf1lqejeqyPiZghWVuITcq.6ApGpMWmRYprSu', '0', '0', '01291530996', '1', 2, 5, 6, 25, 'G9htUfLwey', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (70, 3538, 'حسان أنور مؤيد', 'hsan-anor-moyd', 'hamoyd', '$2y$12$17D/aEVyBGt15Q2hhN7KT.HSFh.6VWfrmqTvtKYdErrMVIHz1cpa.', '0', '1', '01578753621', '1', 2, 5, 27, 7, 'LZAT616Tw7', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (71, 2500, 'جنى مدحت طلال', 'gn-mdht-tlal', 'gmtlal', '$2y$12$.TaKf.50QFUVbRxBl8PIbuWYntaQK0mLExBPx6ZaeupWbbKM45lAO', '1', '1', '01535300485', '1', 5, 9, 17, 20, 'guOr3vpnqh', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (72, 6131, 'ندى منجد كنعان', 'nd-mngd-knaaan', 'nmknaaa', '$2y$12$BQlHSALrbofVEb1g0sHVneui0uieKDdhRlF3zGp1vVQTSadkbwIo2', '1', '1', '01059112581', '1', 6, 9, 23, 22, 'mJRgNq48Jq', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (73, 3842, 'منير شاهر مالك', 'mnyr-shahr-malk', 'mshmal', '$2y$12$bhXm/7ZDhA7KGwcTLeuYaeV/zLkIQvbdMNTo36qJIPdomOTigEL06', '0', '1', '01285061587', '1', 4, 2, 24, 20, 'gtbqwmNm19', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (74, 5872, 'سامي عبدالحليم وضاح', 'samy-aabdalhlym-odah', 'saaoda', '$2y$12$MmChcjn511OG2tckRabfD.hkLz3X0X1qqBKvZP5bvMSaSqwnqk04O', '0', '0', '01243525477', '1', 6, 4, 9, 20, 'pbgbR19pm2', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (75, 7355, 'خلود وليد علاء', 'khlod-olyd-aalaaa', 'khoaala', '$2y$12$zXN9h9JVHnCUeMPYsl2tbuorPvbEqvSn.aOLFzqnNKSsoB7UGQmPu', '1', '0', '01043288772', '1', 3, 4, 12, 16, 'qprVleLKFg', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (76, 7376, 'محفوظ وجيه عبدالكريم', 'mhfoth-ogyh-aabdalkrym', 'moaabd', '$2y$12$1kvRoxcKTgVlnNsJhCnW2.p.cR4qIK3MabdkBe2PhPkgnOg6QN/DS', '0', '1', '01198506829', '1', 1, 3, 18, 1, 'GiMlOm6UEx', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (77, 5175, 'ديما مبارك شعلان', 'dyma-mbark-shaalan', 'dmshaa', '$2y$12$IUTs1PHaPsk1.6b73T9MoOIxk0AFvmg0NDP/eXhsYio15I2PpnJOK', '1', '1', '01289587883', '1', 2, 3, 27, 3, '7jJ6AnmpRU', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (78, 3606, 'ريتال سهوان نور', 'rytal-shoan-nor', 'rsnor', '$2y$12$EB6HXDduf3xxTnXgs8ziyu8ecdgwq6YPLJUQHC.cZT7wVj2zD/qba', '1', '0', '01036352472', '1', 4, 6, 2, 9, 'ksBEDzWaD3', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (79, 4249, 'صفاء زهران شهاب', 'sfaaa-zhran-shhab', 'szshhab', '$2y$12$EmZ5eKSG74L/MwewnKs6s.yaBOScyOAiOxLxGI7DEQpztUQaszonq', '1', '0', '01181826378', '1', 4, 2, 4, 21, 'Ee5ktGgRgI', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (80, 5836, 'نورين عبدالرزاق أنور', 'noryn-aabdalrzak-anor', 'naaanor', '$2y$12$wjjH9OBt/2tRNe124nUJOeZqzqke5QMfNLDc9KXvnTw7ySPIWxBYa', '1', '0', '01270981497', '1', 2, 3, 6, 16, 'pLHYOOfQ4o', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (81, 6349, 'سهيل عبدالكبير عارف', 'shyl-aabdalkbyr-aaarf', 'saaaaar', '$2y$12$RRpqkerIg6PRKEOEdaPz/uRLRYu2QCZFLgjWs6xzu3gfAFxkc75py', '0', '1', '01284203060', '1', 2, 6, 27, 26, 'NwsHFQYjpt', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (82, 1179, 'عبدالرزاق أوس سهوان', 'aabdalrzak-aos-shoan', 'aaashoa', '$2y$12$Lt39jKtz548Nd7Kg8Ot3nuQhlwaQU/SVp/9lgyRCMZnOTmyl/0WE6', '0', '1', '01091260687', '1', 2, 8, 23, 20, 'bhwcNhlPre', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (83, 1094, 'رهف وسام حمود', 'rhf-osam-hmod', 'rohmod', '$2y$12$tgvN8frt9vWONSW7qoiBk.BkXgPpjY7c7vZfjdfxJHUn40Q/cmbdW', '1', '1', '01589799070', '1', 1, 6, 3, 24, 'UUKnvkvGrl', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (84, 3185, 'نورالدين جواد عبدالفتاح', 'noraldyn-goad-aabdalftah', 'ngaabda', '$2y$12$gc5hkmHCKgy0SQY5Y/ZfBehjLPC3obWLGGnZdpASFYtc/LCCoaNRe', '0', '0', '01192996193', '1', 3, 3, 26, 10, 'GMHBE78RMQ', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (85, 1432, 'نهال عزيز عبدالفتاح', 'nhal-aazyz-aabdalftah', 'naaaabd', '$2y$12$LLpI5R.vdeMjJYNH39kSaOHWGkv2GEpP32JjeUOIUevYyf4gUhy0q', '1', '1', '01212872044', '1', 5, 7, 4, 5, 'EQFpLX7z3K', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (86, 5822, 'ضحى عماد بلال', 'dh-aamad-blal', 'daablal', '$2y$12$FQuCk68vRbm3K/eOqdzWkeo2luYgA86e10nXrkYFV1udVGIdnHurS', '1', '0', '01071868262', '1', 6, 2, 2, 20, 'DSZSZnHol3', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (87, 7887, 'بدرية جواد عابد', 'bdry-goad-aaabd', 'bgaaab', '$2y$12$vpzZ.j2POpOe9CrXDIpaSOtrZmUbt3ZyRQ/m4nDjhUc6wYL18ajaS', '1', '1', '01186709031', '1', 5, 3, 4, 28, 'eYal2UAaFo', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (88, 2241, 'آلاء فرحان زكي', 'alaaa-frhan-zky', 'afzky', '$2y$12$cNwl4/E39PikueX/eV8wcuNyDrNVoCTB8.qV2SjIuX.Z7OYREwT3q', '1', '0', '01296784458', '1', 2, 2, 1, 23, 'm18Y7y8ZLo', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (89, 4811, 'وفاء زاهر سرمد', 'ofaaa-zahr-srmd', 'ozsrmd', '$2y$12$lSw7Ams//2o95lkVKF8qNeHthcBNWP2o9X1jq5v/ghSLmm5xnXxYC', '1', '1', '01095014291', '1', 2, 3, 16, 3, 'ZaHVwiWGdE', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (90, 1019, 'أيهم لؤي جواد', 'ayhm-loy-goad', 'algoad', '$2y$12$PVAZ9dotsgkvm3C1XQF91.lKvCA0JLu/sbH/D01WDURrhM1N05KYy', '0', '1', '01227124586', '1', 2, 2, 13, 17, 'Yfep7GKrmB', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (91, 3089, 'نور رائف مشعل', 'nor-rayf-mshaal', 'nrmshaal', '$2y$12$N1nxwk1ZgOGhMy8mrLEaqeohbQGibQzlwuYF87mXbd/TyMs/gGW9a', '1', '1', '01534916795', '1', 2, 7, 15, 6, 'xHlP1TQ623', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (92, 2313, 'مصطفى عزام خطاب', 'mstf-aazam-khtab', 'maakht', '$2y$12$ckJlaHfi6vnEBYmbNFOLveGo.3CAgOOS0R6/m0ZDtk7NfPDKrW0Cy', '0', '0', '01238977059', '1', 7, 2, 11, 26, 'hzPulfkmXH', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (93, 8278, 'رفيق غريب عبدالودود', 'rfyk-ghryb-aabdalodod', 'rghaabd', '$2y$12$umh/fP..7STUqtlEUXMPxuw.PX3fIdPi3tlsPb2.UoG8RBYGxfNXO', '0', '0', '01002941965', '1', 2, 9, 6, 8, 'qr3pHvOjjk', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (94, 3282, 'مرح مروان هيثم', 'mrh-mroan-hythm', 'mmhythm', '$2y$12$3Kynp1phMI10twzTbIKhZOwBst41cTCjDpH3ux/sw5ZxdSr9lI6aq', '1', '1', '01256450457', '1', 4, 1, 19, 12, 'BRTh1gKcDT', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (95, 4454, 'معين حامد عمران', 'maayn-hamd-aamran', 'mhaamra', '$2y$12$zcNCjn5PWKq8QrfJ81aOYeSQhyVDqznrE9a3mwcfyjc3.4POR79Nm', '0', '1', '01164058720', '1', 5, 9, 10, 26, 'LYGNEozcOM', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (96, 5850, 'جواد شعلان وجيه', 'goad-shaalan-ogyh', 'gshogy', '$2y$12$H.YurQ4l2x106Rr8d1y6TeY1jJ1XkOHRSPoweJX/lw5jbpHGB3iXy', '0', '1', '01146295042', '1', 3, 9, 2, 2, '5q0Xc8NMFA', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (97, 3178, 'محفوظ مبارك سامر', 'mhfoth-mbark-samr', 'mmsamr', '$2y$12$Sz6dPvwkHBzmnD4rCrnkU.cl6KRv2m2kXhd8GUdI.qZFvdt4ipuCq', '0', '1', '01088232338', '1', 3, 1, 3, 21, 'nRVHPSRsj9', '2025-04-03 15:57:53', '2025-04-03 15:57:53'),
// (98, 2154, 'سلمى وجيه عبدالعليم', 'slm-ogyh-aabdalaalym', 'soaabda', '$2y$12$KMqyZXA08dDIog7sPmv4aOkRj2LqGWBMRgVdCfuinEr6y81EzNDq2', '1', '1', '01063426514', '1', 4, 8, 10, 20, 'gZbUCMeVjA', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (99, 3345, 'سيرين رائد عمر', 'syryn-rayd-aamr', 'sraamr', '$2y$12$lhmFmdbETWpPHTJTwNSWJOmSfg6EZDAJDwfSYHrkP1emp5mnLnd3m', '1', '1', '01589132038', '1', 5, 4, 11, 10, 'IU4KY6S5t3', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (100, 7166, 'ناجي حمد معين', 'nagy-hmd-maayn', 'nhmaay', '$2y$12$nf0J86X3jkAjgrVn0ZI5T.C2rf6iClvD3XRaekiCt9k9zMICophaK', '0', '1', '01062399501', '1', 3, 6, 27, 8, 'hF0RRWYehr', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (101, 6542, 'شاهين سعيد مطيع', 'shahyn-saayd-mtyaa', 'shsmty', '$2y$12$N0rQRX07zEmfKdKoUgCeE.HWlYL4dEfDjhRJgTf8bl7ntKK5FSOWC', '0', '1', '01057145343', '1', 7, 6, 4, 12, 'aHT6ARmWuL', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (102, 1884, 'سراج وديع فتحي', 'srag-odyaa-fthy', 'softhy', '$2y$12$mmuwgAY85XWNIYHAJCtdRObV7KMRsi8LRSCyKt49Mld8uOQAV7nlu', '0', '1', '01084558763', '1', 5, 1, 5, 5, 'iA5It3qG8B', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (103, 7656, 'تولين عارف مازن', 'tolyn-aaarf-mazn', 'taamazn', '$2y$12$Sz3FnpJKS3xLEuPjMgHFQuC9lnifyB03/nfRgE56LWpAtC4phqj5q', '1', '1', '01139213503', '1', 5, 5, 15, 14, 't0ROnOcB9r', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (104, 8239, 'باسل لؤي زاهر', 'basl-loy-zahr', 'blzahr', '$2y$12$Js/Hpcr17VAeLxcPb4YmzeSWWZvzrvBweO3e4rD10BlMsWEq3Vgz6', '0', '0', '01150519890', '1', 7, 8, 17, 23, 'x3VCjBFNI2', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (105, 3631, 'صفوان راغب نصار', 'sfoan-raghb-nsar', 'srnsar', '$2y$12$dtvQePKpkraV4FUTIqMfm.cfk9JMTtAdTJB8Es00qp1p2yl0cqSVG', '0', '0', '01181497648', '1', 1, 4, 27, 7, 'eaCVeDrdE0', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (106, 5054, 'ماريا عبدالحليم أنيس', 'marya-aabdalhlym-anys', 'maaany', '$2y$12$Fm.ABBxFE1.aro/uFI.nquCKXCbBSq5oS5POiSJ7Ne7O/GgANDRpe', '1', '0', '01585133059', '1', 7, 4, 4, 19, 'ZUCuwMYEqf', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (107, 6851, 'سالم عبدالله كرم', 'salm-aabdallh-krm', 'saakrm', '$2y$12$fSArLA5hEkpZhhI7.ryFTe.w9W5OAqRytFw3Bydl1f4Mu5mQ4z5KS', '0', '0', '01140381404', '1', 1, 6, 23, 4, 's1tOyptQAJ', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (108, 6453, 'نجوان رامح عبدالباري', 'ngoan-ramh-aabdalbary', 'nraabda', '$2y$12$jfe2rIIUMA4bhPw1/KzSDOTNmlFjBG2xDbsXx7pgpa/G2LvNnnrJK', '1', '0', '01517610770', '1', 2, 6, 12, 17, 'aBx1CZL9Ei', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (109, 4624, 'شعلان هيثم رعد', 'shaalan-hythm-raad', 'shhraad', '$2y$12$cgVykiE93kN8VHtA9USV0.PdkfO3tumk5Mb.OADvQx/r3J/pmaxLi', '0', '0', '01519575211', '1', 6, 6, 5, 1, 'nZwdGsowzm', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (110, 1283, 'لجين تامر يوسف', 'lgyn-tamr-yosf', 'ltyosf', '$2y$12$wfGFTaGeL4IJRUXxumu/B.Gsnrp47wZpDvLjgNa8TqAyk3ljermOi', '1', '1', '01502452717', '1', 5, 3, 17, 23, 'pqVC38UehG', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (111, 4125, 'سهير سامح بكر', 'shyr-samh-bkr', 'ssbkr', '$2y$12$nDxfsM2jrin2PprUUcopcOsMUdmUq6l3tsRaq5F4ptzFvVSO43rC2', '1', '1', '01278084887', '1', 4, 1, 26, 21, 'FosM0vmJH3', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (112, 8192, 'عمرو طارق بشار', 'aamro-tark-bshar', 'aatbsha', '$2y$12$e.NzfVRhn8dX0q1D4aXz1.UiTMvg9pi288ZZlJPEIQpXUpc0v.N6y', '0', '1', '01268080699', '1', 2, 9, 26, 11, 'lKMAf2kAGt', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (113, 6313, 'زين مبارك سهيل', 'zyn-mbark-shyl', 'zmshyl', '$2y$12$RtHQHLITuL4ew1Mer5vF3eYmiUfhjNL7e/wgrvgPDi1tVBHwLYRce', '0', '0', '01022366047', '1', 3, 9, 12, 10, 'qEqsKNAsSl', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (114, 8940, 'ميساء رشيد ماهر', 'mysaaa-rshyd-mahr', 'mrmahr', '$2y$12$yuKMZ65D7.cfNa9O.vdBMO4oB0KcbMJPNmuJ.OBPqhzw4uRDCB4vq', '1', '1', '01528188062', '1', 4, 3, 19, 11, 'jaDQqJPJx8', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (115, 8946, 'عبدالرزاق مالك حمود', 'aabdalrzak-malk-hmod', 'aamhmo', '$2y$12$KPRQlovlGPdTbkjx7btcbOcyWiYadBQXqcKsBxbNvz6yzeEyYdW8m', '0', '1', '01076456917', '1', 5, 8, 13, 27, 'WAEI1gQkfq', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (116, 4327, 'ناصيف عليان مرشد', 'nasyf-aalyan-mrshd', 'naamrsh', '$2y$12$NaBG2icuTDsnSl5t0XMMY.PZhS8KlKJH.FiG67KCI2KNOwhfzFAdq', '0', '0', '01164932190', '1', 2, 6, 21, 15, 'hqueI8ghx3', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (117, 4384, 'هبة الله شادي مختار', 'hb-allh-shady-mkhtar', 'hashmkh', '$2y$12$UsAQsF08Tb1GBFrtD3cOf.SdN7Vmhuw2Mh1zGIG1v0qcWdCK9TQUy', '1', '1', '01182580397', '1', 3, 9, 26, 16, '2BbMPmtFfO', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (118, 1594, 'شادي أيهم كنعان', 'shady-ayhm-knaaan', 'shaknaaa', '$2y$12$iRN8usdghwD9mU2XLusq2ehajsPTaMjzQoaHuS7Mr00QOvoBOCNd6', '0', '1', '01098541039', '1', 1, 2, 25, 26, 'TQOxUmUqul', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (119, 3449, 'مأمون عبدالحي ساري', 'mamon-aabdalhy-sary', 'maasary', '$2y$12$Ly0fzO3RKUI.6f.gZ3MpMuO126JkJO2tUjFK0Lm14/LB5tOIn7DNu', '0', '1', '01562156063', '1', 3, 5, 3, 10, 'JRWVmVWahs', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (120, 9151, 'مفيد فؤاد عبدالرازق', 'mfyd-foad-aabdalrazk', 'mfaabda', '$2y$12$X7xLjY1IPhHLEYCbYMoAt.8c8AGR6pBNN0.hCisvtIICq82HXo8xS', '0', '1', '01144351243', '1', 1, 9, 5, 2, 'XHGM7ccd9X', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (121, 6258, 'خلود إلياس طارق', 'khlod-alyas-tark', 'khatar', '$2y$12$1zHUSB8rztaHFcan3ktUVO8ndQ8YKTY8lbmvYsjlgEulfoZsu45g2', '1', '0', '01217945153', '1', 2, 5, 28, 10, 'wHLEFr7vEZ', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (122, 2183, 'حسنة أمين يوسف', 'hsn-amyn-yosf', 'hayosf', '$2y$12$OI3OHJRgBuCqwG/IA3hseO8c6JnQI3cSGgHjZ.MlGkMheqV8g9hTa', '1', '0', '01107609738', '1', 5, 1, 10, 8, 'Jd4SUm9Yq3', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (123, 4166, 'صبري مهدي سامح', 'sbry-mhdy-samh', 'smsamh', '$2y$12$Paw4eFmABXwM.hhP8ogD1.jrIsOMK5t9590V0yk30TqNkZ6ZdrL8y', '0', '0', '01205318037', '1', 3, 9, 27, 6, 'AXCnSRrnZq', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (124, 5963, 'هشام عفيف نور', 'hsham-aafyf-nor', 'haanor', '$2y$12$8ze8wSiSaPergBnaDlzEDuyhDWD/jkU7D/XTUOkw9mWB7xXDrDEam', '0', '0', '01597369946', '1', 7, 5, 3, 17, 'lswdfUEyDG', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (125, 6946, 'ليندا صابر عزام', 'lynda-sabr-aazam', 'lsaazam', '$2y$12$tWkh5VIFqbibFqQ7QYOu9e1wSH7ZKy5P9s0wbovDU27xMge8g2.M.', '1', '0', '01583830617', '1', 4, 9, 24, 1, 'WDnrm2e1lC', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (126, 9072, 'نجوى عصمت خطاب', 'ngo-aasmt-khtab', 'naakhta', '$2y$12$qcSQr1jb0D61B07K/YtZlOR9aISfgfd9GFDey8h13dv2Tea5cv6Sm', '1', '1', '01125969027', '1', 3, 8, 10, 14, 'Q9WOgVjtjy', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (127, 3470, 'وسام زكريا فطين', 'osam-zkrya-ftyn', 'ozftyn', '$2y$12$/KTr/Md1uWqZLRvNECaFXuI8YzoP8iC.8jwv0I1sC/i6scdJNtaz.', '1', '0', '01246892823', '1', 7, 3, 16, 1, '35IPm8LEFk', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (128, 3332, 'مروة أيمن مصلح', 'mro-aymn-mslh', 'mamslh', '$2y$12$SOrnve4GaC6vMq3nMktAR.5bwueexQZ6wYSux.Zs3UfWiRDVTaoB2', '1', '1', '01095235871', '1', 6, 1, 15, 20, '3OH1AlcL6d', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (129, 4132, 'منصور بشار عبدالعليم', 'mnsor-bshar-aabdalaalym', 'mbaabda', '$2y$12$ECmzOtdxzoABnqJB.nnpgeUq3K5X6422T1Qt.X7.1h/IErfNBkKpy', '0', '0', '01118730470', '1', 2, 5, 5, 8, 'fnRixPdMOf', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (130, 4423, 'مؤمن عمرو أيمن', 'momn-aamro-aymn', 'maaaymn', '$2y$12$1Rycwbst4uRskfB0ScoNxOQ62S1TLkAl.yp/TWGvFl4XxNxJ8u9Ce', '0', '0', '01050838316', '1', 5, 1, 20, 18, 'a9IGo7mhqh', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (131, 3894, 'بشار نبيل سالم', 'bshar-nbyl-salm', 'bnsalm', '$2y$12$aIWYYn61HE/Tk8an8BkBXuoCLhaPouuT4r13hJq24fzagh2BDopTa', '0', '1', '01166061733', '1', 5, 9, 12, 25, 'ufwOdvgi23', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (132, 3856, 'نجلاء مؤيد معروف', 'nglaaa-moyd-maarof', 'nmmaar', '$2y$12$8ZuuU6vcUIaiCNshVHKaMeRxoTWVyVxeI3vxuQXixcRcj.1j/EoqS', '1', '0', '01191893582', '1', 5, 2, 21, 20, 'C8ilAYNF7G', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (133, 7943, 'سهاد مليح نواف', 'shad-mlyh-noaf', 'smnoaf', '$2y$12$4LnUpoARNMzfgk6KM5rJjO8K4V/CwLJfhOeHLK7Jz5wv7GqyYaN02', '1', '1', '01155026793', '1', 7, 7, 15, 6, 'wnosxb5piG', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (134, 2975, 'ماهر وسيم عبود', 'mahr-osym-aabod', 'moaabod', '$2y$12$EPnjqQkgC/crVrfh4YSqAepa2kdw0RHUs3BgaL3lJ2gBov8mSa7Oy', '0', '0', '01226576743', '1', 2, 9, 16, 27, 'wODZbYrJty', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (135, 4814, 'عبدالفتاح بسام باسم', 'aabdalftah-bsam-basm', 'aabbasm', '$2y$12$zSNSPQ9Mj/3Pay7BpDUyq.FlDEZ5oyX2.xLsI0X46uN5Yhv1rl2za', '0', '0', '01209782956', '1', 2, 3, 7, 23, 'JpYsYtDc8g', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (136, 4070, 'كنزي ضياء عابد', 'knzy-dyaaa-aaabd', 'kdaaab', '$2y$12$R5FTX8.JTJ2uIShm5rncI.vT9.wH42o12Nx8HsRxjV5bpZ0eoR6Iu', '1', '0', '01085036860', '1', 5, 5, 15, 28, 'lwkQ7NCSW2', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (137, 4134, 'هند شعلان شادي', 'hnd-shaalan-shady', 'hshsha', '$2y$12$CkZawJ9m3AjkWafjI/P10.bHaNyHu15NJKXwv80.wu66mYGjXiX4e', '1', '1', '01219053725', '1', 1, 7, 24, 3, 'YPSV6UvlLS', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (138, 3412, 'يحيى نبيل شمس', 'yhy-nbyl-shms', 'ynshms', '$2y$12$ZKxvxwenXN4t9qmAHT07EOOwU.EfTAVIcgoYjdVHf6nV5abmgjif.', '0', '1', '01599305217', '1', 3, 3, 2, 23, 'xkfv3vETZI', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (139, 5428, 'شاهين براء وسيم', 'shahyn-braaa-osym', 'shbosym', '$2y$12$2z.QwupFqLRnRfu/BlM4buQOk6SsV8m/w3TjStFNEJPTfv6bDV/.m', '0', '0', '01173848838', '1', 3, 6, 5, 3, 'OEUp8WPYYG', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (140, 9991, 'ماريا يوسف زكريا', 'marya-yosf-zkrya', 'myzkry', '$2y$12$G2Taic1j1cajjJnZE.g8..ySTqp2bCDxAQcrhFv8v5msGZrkMDPTa', '1', '0', '01064396903', '1', 3, 7, 9, 24, 'NmnCpeOozv', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (141, 9273, 'مقداد جبر طلال', 'mkdad-gbr-tlal', 'mgtlal', '$2y$12$VkLCPQCfDIXYwoxLqZgc.eAtGSus4USdArvAqkbCsObQYQcWSe20i', '0', '1', '01095976159', '1', 7, 7, 26, 7, 'IhzztuLP0H', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (142, 4424, 'سهاد شاكر سلطان', 'shad-shakr-sltan', 'sshslta', '$2y$12$w7Sh9UoPX..Oa3N6Xs.OdeuLPvyoMG7naZRAhv8q3rizOha6XloOu', '1', '1', '01168028527', '1', 4, 9, 22, 17, 'd46KWlIqAF', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (143, 5052, 'عابد حاتم هيثم', 'aaabd-hatm-hythm', 'aahhythm', '$2y$12$qQoG79ohGnlPxHahNP5AdeP6oW8wQkSvrtPGkFt9PthK7Q4UN1wS.', '0', '1', '01001523082', '1', 6, 9, 21, 14, 'ujDIXyumwr', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (144, 4553, 'عبدالباري حبيب نضال', 'aabdalbary-hbyb-ndal', 'aahndal', '$2y$12$EPy/guUnsgmndVHMwp5acOgIIQH60HZ7yw13dSoVOWB4E/2GxRWp6', '0', '1', '01571048235', '1', 7, 8, 25, 28, 'ckBSPnMlvH', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (145, 9111, 'ربيع عبدالحي سهوان', 'rbyaa-aabdalhy-shoan', 'raasho', '$2y$12$xQ5SZGQ8MuSVVT4pyFl1qOT.IPlIw3i36FSo2HBYA1q8E7pOSwyqe', '0', '1', '01163051609', '1', 5, 6, 17, 22, '74sQNkAZu7', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (146, 7679, 'حلا معاوية عبدالحليم', 'hla-maaaoy-aabdalhlym', 'hmaabd', '$2y$12$oDy5TKqRA8Ok5WaLzHLUjeN96Yqlx4qvFBAL.inHFpJFSQTSKOTV6', '1', '1', '01261174878', '1', 4, 5, 17, 20, 'FgOfsTys3X', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (147, 1433, 'آسيا إبراهيم جمال', 'asya-abrahym-gmal', 'aagmal', '$2y$12$dyS3bJ99BtdKfXJE9zScDeErXCqG9BSxHKCmxwarYPSYteW2I.kKq', '1', '1', '01121355818', '1', 4, 5, 8, 4, 'NFqCpnvfct', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (148, 1728, 'تاليا مختار منصور', 'talya-mkhtar-mnsor', 'tmmnso', '$2y$12$fH8LpCz8iL2B2n.dXOnGAurM2YDgnclx4gLvvm9wMeOdXTXDW7/8G', '1', '0', '01085575200', '1', 1, 2, 2, 18, '8UrRPdtJXF', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (149, 9695, 'آلاء حارث رفيق', 'alaaa-harth-rfyk', 'ahrfyk', '$2y$12$r7PRJmsx/JhlKZ.clrFdvuA7mSP4pBqi9nR4aO25v4VkTpVBuBhJ6', '1', '0', '01111557617', '1', 5, 9, 5, 7, 'nKwE1TBiVb', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (150, 2781, 'كريم سهوان إبراهيم', 'krym-shoan-abrahym', 'ksabra', '$2y$12$kS6wG3ijy3qDh3LKVPbDYegPuR5h4.Oj5F1axy6ytz1RoIPazRd6u', '0', '0', '01036157198', '1', 3, 1, 2, 21, 'NaLHDIvXaX', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (151, 2298, 'لمار ناجي أنس', 'lmar-nagy-ans', 'lnans', '$2y$12$qNHabF4mfaRGCoN27O8hVuqRpx6IPyPX23d6ur.8tmCLSidJwoSeG', '1', '1', '01222639315', '1', 4, 1, 27, 11, 'B79PzzNjdG', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (152, 2057, 'سامر أنور مصطفى', 'samr-anor-mstf', 'samstf', '$2y$12$JiznlhFysRbd12LOAbaRd.nPM7Toilnn6J/ddgO3SEpQJ1FoFbwBK', '0', '0', '01148444039', '1', 2, 3, 22, 8, 's0DQ32IHTO', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (153, 2157, 'شادي كرم صابر', 'shady-krm-sabr', 'shksabr', '$2y$12$Ry.QVseHEg831apvOMXK1erHUODtaebTk8oAJrPm2pOrskVFA762e', '0', '0', '01278646672', '1', 7, 3, 1, 6, 'tWI1GidxWM', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (154, 2223, 'هيثم أيمن بلال', 'hythm-aymn-blal', 'hablal', '$2y$12$E1g.kodAblDYsGF8Fiy01.EBFW.i1opxGjUpaK0P1qZis5dglkZkG', '0', '1', '01182741758', '1', 1, 2, 15, 4, 'l3pQHGxuV4', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (155, 1938, 'يوسف مختار عطاالله', 'yosf-mkhtar-aataallh', 'ymaataa', '$2y$12$Z09dn9YrJjezJ3B/6SgjlOMlfF5ZMR6yyphFq7uTO.dmCyWUXhxA2', '0', '1', '01264450339', '1', 3, 6, 12, 1, 'IMbt2Gs5ct', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (156, 1895, 'سامح أسامة رامح', 'samh-asam-ramh', 'saramh', '$2y$12$KJNfXppnULE1km8x0WEefOO49qOlWxuNz/5nkFaUn5KEj2dh6IS2C', '0', '1', '01591124346', '1', 1, 1, 26, 6, 'Rmjrpo30lO', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (157, 2647, 'عابد أسامة وائل', 'aaabd-asam-oayl', 'aaaoay', '$2y$12$9of27cP6aybexW6YAiiuSumwQGxMpUbqo/KaS.49EZ9WjswTa6eEW', '0', '1', '01056248076', '1', 5, 5, 12, 1, 'U4QsuHACF4', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (158, 7360, 'شوق إسماعيل مخلص', 'shok-asmaaayl-mkhls', 'shamkhls', '$2y$12$HA0tuSlIcP.pDRSoJYBCfOd30Zu71eFL4YGwpawtsRfZOOHdGiAvy', '1', '0', '01166967433', '1', 5, 5, 27, 12, 'sq2UbUwH20', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (159, 8563, 'وفيق سراج نزار', 'ofyk-srag-nzar', 'osnzar', '$2y$12$TWJioLMxnESfOCBwiIHK3uyLEDihER61k5JPuMtKWxMLHJvjSW/5.', '0', '0', '01255749150', '1', 5, 1, 18, 24, 'JeIhsl73da', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (160, 7459, 'رزان ناجي زكريا', 'rzan-nagy-zkrya', 'rnzkry', '$2y$12$2PT4pwC0AYRAQn9uksTVFeScV1ZXfKAVdD7gOsaRqHDy2kEsYevWa', '1', '0', '01127339574', '1', 5, 5, 1, 12, 'quHcTuE76O', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (161, 1069, 'عبدالحي نافع هارون', 'aabdalhy-nafaa-haron', 'aanharo', '$2y$12$wl8xALvbwEytQrmJIaBo7OV925AFRIw7h79vBZZC7lcI11vZVxmIm', '0', '1', '01115458022', '1', 4, 1, 24, 25, 'KAyRPjNwYf', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (162, 2243, 'نايا رشيد سعيد', 'naya-rshyd-saayd', 'nrsaayd', '$2y$12$R3UJz8uTqPiS22YXPwQ7JunVYS/wHU4TElVIu.N4.rcrw7XR6x8ki', '1', '0', '01185143925', '1', 2, 6, 25, 24, '08gtmhXyVS', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (163, 7391, 'محمود سراج إيهاب', 'mhmod-srag-ayhab', 'msayha', '$2y$12$ydXMeBPEyBLj3VAJ9BjIm.fmdceJouIV6Zd/I65Ia4SFFxyF11znG', '0', '0', '01052498050', '1', 7, 4, 3, 12, 'tZdzpd9Wu1', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (164, 8248, 'جود بسام ليث', 'god-bsam-lyth', 'gblyth', '$2y$12$kpjn6pcvjxS6jcJI0NLJhesxrVTy7VZ49h68cdKzUwA9H6Fcoig1O', '1', '1', '01508553232', '1', 2, 1, 24, 3, 'RRht5Pl0aJ', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (165, 1442, 'شوقي محيي عدنان', 'shoky-mhyy-aadnan', 'shmaadna', '$2y$12$vwxwnDl205NdZBB.uM9aYOgXZTiZmPUH3AHYpgKfbazF4/z9/ASY.', '0', '0', '01000412780', '1', 6, 2, 19, 6, 'VvhvLFfOhl', '2025-04-03 15:57:54', '2025-04-03 15:57:54'),
// (166, 6808, 'صفاء شوقي بشار', 'sfaaa-shoky-bshar', 'sshbshar', '$2y$12$mPaPhEYFgqHNhQ9E/geI0u1HfRcl9ftQhdJ/r0plrp3wH0yTjXx.u', '1', '1', '01067369983', '1', 2, 9, 20, 25, 'lgqdES7xdN', '2025-04-03 15:57:54', '2025-04-03 15:57:54');
