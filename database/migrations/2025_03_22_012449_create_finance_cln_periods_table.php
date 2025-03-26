<?php

use App\Models\FinanceCalendar;
use App\Models\Month;
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
        Schema::create('finance_cln_periods', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(FinanceCalendar::class)->nullable()->constrained()->nullOnDelete();
            $table->string('finance_yr')->comment('السنة المالية');
            $table->foreignIdFor(Month::class)->nullable()->constrained()->nullOnDelete();
            $table->string('year_and_month', 10)->comment('محتاج ان اقوم بالتسجيل بالشهر و السنه و ليس باليوم');
            $table->date('start_date_month');
            $table->date('end_date_month');
            $table->integer('number_of_days')->comment('عدد الايام فى الشهر');
            $table->enum('status', [0, 1, 2])->default(0); //غير مفعله او مفعله
            $table->foreignId('created_by')->references('id')->on('admins')->onUpdate('cascade');
            $table->foreignId('updated_by')->nullable()->references('id')->on('admins')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_cln_periods');
    }
};


// INSERT INTO `finance_cln_periods` (`id`, `finance_calendar_id`, `finance_yr`, `month_id`, `year_and_month`, `start_date_month`, `end_date_month`, `number_of_days`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
// (1, 1, '2024', 6, '2024-06', '2024-06-01', '2024-06-30', 30, '0', 11, 11, '2025-03-25 22:35:38', '2025-03-25 22:35:38'),
// (2, 1, '2024', 7, '2024-07', '2024-07-01', '2024-07-31', 31, '0', 11, 11, '2025-03-25 22:35:38', '2025-03-25 22:35:38'),
// (3, 1, '2024', 8, '2024-08', '2024-08-01', '2024-08-31', 31, '0', 11, 11, '2025-03-25 22:35:38', '2025-03-25 22:35:38'),
// (4, 1, '2024', 9, '2024-09', '2024-09-01', '2024-09-30', 30, '0', 11, 11, '2025-03-25 22:35:38', '2025-03-25 22:35:38'),
// (5, 1, '2024', 10, '2024-10', '2024-10-01', '2024-10-31', 31, '0', 11, 11, '2025-03-25 22:35:38', '2025-03-25 22:35:38'),
// (6, 1, '2024', 11, '2024-11', '2024-11-01', '2024-11-30', 30, '0', 11, 11, '2025-03-25 22:35:38', '2025-03-25 22:35:38'),
// (7, 1, '2024', 12, '2024-12', '2024-12-01', '2024-12-31', 31, '0', 11, 11, '2025-03-25 22:35:38', '2025-03-25 22:35:38'),
// (8, 1, '2024', 1, '2025-01', '2025-01-01', '2025-01-31', 31, '0', 11, 11, '2025-03-25 22:35:38', '2025-03-25 22:35:38'),
// (9, 1, '2024', 3, '2025-03', '2025-03-01', '2025-03-31', 31, '0', 11, 11, '2025-03-25 22:35:38', '2025-03-25 22:35:38'),
// (10, 1, '2024', 4, '2025-04', '2025-04-01', '2025-04-30', 30, '0', 11, 11, '2025-03-25 22:35:38', '2025-03-25 22:35:38'),
// (11, 1, '2024', 5, '2025-05', '2025-05-01', '2025-05-31', 31, '0', 11, 11, '2025-03-25 22:35:38', '2025-03-25 22:35:38'),
// (12, 1, '2024', 6, '2025-06', '2025-06-01', '2025-06-30', 30, '0', 11, 11, '2025-03-25 22:35:38', '2025-03-25 22:35:38'),
// (13, 1, '2024', 7, '2025-07', '2025-07-01', '2025-07-31', 31, '0', 11, 11, '2025-03-25 22:35:38', '2025-03-25 22:35:38');