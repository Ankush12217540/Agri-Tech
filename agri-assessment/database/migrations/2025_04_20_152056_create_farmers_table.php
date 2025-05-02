<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('farmers', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->foreignId('region_id')->constrained()->onDelete('cascade');
        $table->decimal('land_holding', 8, 2);  // Ensure land_holding is a decimal with two places for precision
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('farmers');
    }
};
