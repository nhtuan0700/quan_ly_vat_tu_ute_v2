<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeQtyConstraintInTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stationery', function (Blueprint $table) {
            $table->unsignedInteger('limit_avg')->change();
        });
        Schema::table('limit_stationery', function (Blueprint $table) {
            $table->unsignedInteger('qty_used')->change();
            $table->unsignedInteger('qty_max')->change();
        });
        Schema::table('registration', function (Blueprint $table) {
            $table->unsignedInteger('qty')->change();
        });
        Schema::table('detail_buy', function (Blueprint $table) {
            $table->unsignedInteger('qty')->change();
            $table->unsignedInteger('qty_handovered')->change();
        });
        Schema::table('detail_handover_buy', function (Blueprint $table) {
            $table->unsignedInteger('qty')->change();
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
            $table->integer('limit_avg')->change();
        });
        Schema::table('limit_stationery', function (Blueprint $table) {
            $table->integer('qty_used')->change();
            $table->integer('qty_max')->change();
        });
        Schema::table('registration', function (Blueprint $table) {
            $table->integer('qty')->change();
        });
        Schema::table('detail_buy', function (Blueprint $table) {
            $table->integer('qty')->change();
            $table->integer('qty_handovered')->change();
        });
        Schema::table('detail_handover_buy', function (Blueprint $table) {
            $table->integer('qty')->change();
        });
    }
}
