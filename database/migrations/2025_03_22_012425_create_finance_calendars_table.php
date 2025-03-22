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
        Schema::dropIfExists('finance_calendars');
    }
};
