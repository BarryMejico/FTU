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
        Schema::create('course_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('Course_ID')->constrained('courses')->onDelete('cascade');
            $table->foreignId('Subject_ID')->constrained('subjects')->onDelete('cascade')->nulable();
            $table->string('Subject');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_details');
    }
};
