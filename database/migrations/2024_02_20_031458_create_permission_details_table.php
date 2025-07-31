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
        Schema::create('permission_details', function (Blueprint $table) {
            // $table->id();
            $table->timestamps();
            $table->string('permiCode');
            $table->foreign('permiCode')->references('permCode')->on('permissions')->onDelete('cascade');
            
            $table->unsignedBigInteger('id')->nullable();
            $table->foreign('id')->references('id')->on('menus')->onDelete('cascade');

            // $table->string('CoCode')->nullable();
            // $table->foreign('CoCode')->references('CoCode')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_details');
    }
};
