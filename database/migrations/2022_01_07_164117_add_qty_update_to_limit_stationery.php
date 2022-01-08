<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQtyUpdateToLimitStationery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('limit_stationery', function (Blueprint $table) {
            $table->unsignedInteger('qty_update')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('limit_stationery', function (Blueprint $table) {
            $table->dropColumn('qty_update');
        });
    }
}
