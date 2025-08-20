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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('rank')->nullable();
            $table->date('birthday')->nullable();
            $table->integer('age')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('unit_assingment')->nullable();
            $table->string('etad_sot_date')->nullable();
            $table->string('skills')->nullable();
            $table->string('religion')->nullable();
            $table->string('bloodtype')->nullable();
            $table->string('swimming_profeciency')->nullable();
            $table->string('kin_next')->nullable();
            $table->string('kin_relation')->nullable();
            $table->string('kin_contact')->nullable();
            $table->integer('nr_dependents')->nullable();
            
            // $table->string('highest_military_course')->nullable();
            // $table->string('educational_attainment')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
