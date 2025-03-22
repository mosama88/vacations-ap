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
            $table->foreignIdFor(Leave::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(FinanceCalendar::class)->nullable()->constrained()->nullOnDelete();
            $table->integer('total_days')->nullable();
            $table->integer('used_days')->nullable();
            $table->integer('remainig_days')->nullable();
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
