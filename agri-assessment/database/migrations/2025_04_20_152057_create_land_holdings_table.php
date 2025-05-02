<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('land_holdings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('farmer_id');
            
            $table->decimal('area', 8, 2); // in acres or hectares
            $table->string('land_type')->nullable(); // e.g., irrigated, non-irrigated
            $table->timestamps();

            $table->foreign('farmer_id')->references('id')->on('farmers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('land_holdings');
    }
};
