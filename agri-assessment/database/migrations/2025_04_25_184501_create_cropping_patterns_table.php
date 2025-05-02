<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('cropping_patterns', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('region_id');
        $table->unsignedBigInteger('farmer_id');
        $table->string('crop_name');
        $table->string('season');
        $table->timestamps();

        $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
        $table->foreign('farmer_id')->references('id')->on('farmers')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cropping_patterns');
    }
};
