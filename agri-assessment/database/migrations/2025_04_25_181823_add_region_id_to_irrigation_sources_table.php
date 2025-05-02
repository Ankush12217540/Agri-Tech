<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegionIdToIrrigationSourcesTable extends Migration
{
    public function up()
    {
        Schema::table('irrigation_sources', function (Blueprint $table) {
            $table->unsignedBigInteger('region_id'); // Add the region_id column

            // Assuming the regions table has a primary key of 'id'
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('irrigation_sources', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
            $table->dropColumn('region_id');
        });
    }
}
