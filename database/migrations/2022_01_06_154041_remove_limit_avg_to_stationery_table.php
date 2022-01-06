<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveLimitAvgToStationeryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stationery', function (Blueprint $table) {
            $table->dropColumn('limit_avg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stationery', function (Blueprint $table) {
            $table->unsignedTinyInteger('limit_avg');
        });
    }
}
