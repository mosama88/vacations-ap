<?php

use App\Models\Employee;
use App\Models\LeaveBalance;
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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->integer('leave_code')->unique();
            $table->foreignIdFor(Employee::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(FinanceCalendar::class)->nullable()->constrained()->nullOnDelete();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('days_taken')->nullable();
            $table->enum('leave_type', [1, 2, 3, 4])->default(1);
            $table->enum('leave_status', [1, 2, 3])->default(1);
            $table->text('description')->nullable();
            $table->text('reason_for_rejection')->nullable();
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
        Schema::dropIfExists('leaves');
    }
};