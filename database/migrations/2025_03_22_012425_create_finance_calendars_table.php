<?php

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
        Schema::create('finance_calendars', function (Blueprint $table) {
            $table->id();
            $table->string('finance_yr');
            $table->string('finance_yr_desc', 225); //تفاصيل كود السنه المالية
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status',[0,1,2])->default(0); //غير مفعله او مفعله
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_calendars');
    }
};



// INSERT INTO `finance_calendars` (`id`, `finance_yr`, `finance_yr_desc`, `start_date`, `end_date`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
// (1, '2024', 'السنه المالية لسنه 2024', '2024-06-30', '2025-07-01', '0', 11, NULL, '2025-03-25 22:35:38', '2025-03-25 22:35:38');