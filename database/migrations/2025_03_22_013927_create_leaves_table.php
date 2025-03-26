<?php

use App\Models\Employee;
use App\Models\LeaveBalance;
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
            $table->foreignIdFor(Employee::class)->nullable()->constrained()->nullOnDelete();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('leave_type', [1, 2, 3, 4])->default(1);
            $table->enum('leave_status', [1, 2, 3])->default(1);
            $table->text('description')->nullable();
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