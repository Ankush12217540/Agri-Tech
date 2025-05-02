<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('land_holdings', function (Blueprint $table) {
        $table->string('ownership_type')->after('area');
    });
}

public function down()
{
    Schema::table('land_holdings', function (Blueprint $table) {
        $table->dropColumn('ownership_type');
    });
}

};
