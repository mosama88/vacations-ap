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
        Schema::create('finance_cln_periods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('finance_calendars_id')->references('id')->on('finance_calendars')->onDelete('cascade')->onUpdate('cascade');
            $table->string('finance_yr')->comment('السنة المالية');
            $table->foreignId('month_id')->references('id')->on('months')->onDelete('cascade')->onUpdate('cascade')->comment('كود الشهر المالى');
            $table->string('year_and_month', 10)->comment('محتاج ان اقوم بالتسجيل بالشهر و السنه و ليس باليوم');
            $table->date('start_date_m');
            $table->date('end_date_m');
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
