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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('Course_ID')->nullable();
            $table->foreign('Course_ID')->references('id')->on('courses')->onDelete('set null');
            $table->string('Module_Name');
            $table->text('Module_Description');
            $table->decimal('Module_percentage', 5, 2);
            $table->integer('Module_nr_hrs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
