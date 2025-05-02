<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('farmers', function (Blueprint $table) {
        $table->float('land_holding', 8, 2)->nullable(); // Add this column as float
    });
}

public function down()
{
    Schema::table('farmers', function (Blueprint $table) {
        $table->dropColumn('land_holding');
    });
}

};
