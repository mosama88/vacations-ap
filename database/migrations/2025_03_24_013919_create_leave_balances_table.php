<?php

use App\Models\Leave;
use App\Models\Employee;
use App\Models\FinanceCalendar;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leave_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(FinanceCalendar::class)->nullable()->constrained()->nullOnDelete();
            $table->integer('total_days_emergency')->nullable();
            $table->integer('used_days_emergency')->nullable();
            $table->integer('remainig_days_emergency')->nullable();
            $table->integer('total_days')->nullable();
            $table->integer('used_days')->nullable();
            $table->integer('remainig_days')->nullable();
            $table->enum('status', [0, 1])->default(1);
            $table->foreignId('created_by')->references('id')->on('employees')->onUpdate('cascade');
            $table->foreignId('updated_by')->nullable()->references('id')->on('employees')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_balances');
    }
};