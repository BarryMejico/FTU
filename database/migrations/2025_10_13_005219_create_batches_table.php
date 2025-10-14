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
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('Batch_Name');
            $table->string('Batch_Code')->unique();
            $table->string('Batch_Description')->nullable();
            $table->string('Batch_Start_Date');
            $table->string('Batch_End_Date');
            $table->string('Batch_Status');
            $table->foreignId('Course_ID')->constrained('courses')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
