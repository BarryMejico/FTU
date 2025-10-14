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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('Course_Name');
            $table->string('Course_Code')->unique();
            $table->string('Course_Description')->nullable();
            $table->string('Course_Duration');
            $table->string('Course_Level');
            $table->string('Course_Type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
