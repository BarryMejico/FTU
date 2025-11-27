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
        Schema::create('batch_students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('Batch_ID')->constrained('batches')->onDelete('cascade');
            $table->foreignId('Student_ID')->constrained('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batch_students');
    }
};
