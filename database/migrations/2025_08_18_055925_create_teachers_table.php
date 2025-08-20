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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('rank')->nullable();
            $table->date('birthday')->nullable();
            $table->integer('age')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('address')->nullable();
            $table->string('gender')->nullable();
            // $table->string('EDUCATIONALBACKGROUND')->nullable();
            // $table->string('COURSE_TRAININGS_SEMINARTAKEN')->nullable();
            // $table->string('SUBJECTTAUGHT')->nullable();
            // $table->string('COURSETAUGHT')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
