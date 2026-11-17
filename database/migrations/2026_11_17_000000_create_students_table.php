<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_number', 50)->unique();
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100);
            $table->string('gender', 20);
            $table->date('birth_date');
            $table->string('email')->nullable();
            $table->string('phone', 30)->nullable();
            $table->text('address');
            $table->string('course', 150);
            $table->string('year_level', 30);
            $table->string('section', 50);
            $table->timestamps();

            $table->index(['first_name', 'last_name']);
            $table->index('course');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
