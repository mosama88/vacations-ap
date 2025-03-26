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
            $table->string('password');
            $table->enum('gender', [0, 1]);
            $table->enum('type', [0, 1]);
            $table->string('mobile');
            $table->foreignIdFor(Week::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(JobGrade::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Branch::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Governorate::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignId('created_by')->references('id')->on('admins')->onUpdate('cascade');
            $table->foreignId('updated_by')->nullable()->references('id')->on('admins')->onUpdate('cascade');
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