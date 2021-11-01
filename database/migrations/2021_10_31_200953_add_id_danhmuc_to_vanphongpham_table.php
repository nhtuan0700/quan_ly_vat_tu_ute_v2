<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdDanhmucToVanphongphamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vanphongpham', function (Blueprint $table) {
            $table->unsignedTinyInteger('id_danhmuc');
            $table->foreign('id_danhmuc')->references('id')->on('danhmuc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vanphongpham', function (Blueprint $table) {
            $table->dropForeign(['id_danhmuc']);
            $table->dropColumn(['id_danhmuc']);
        });
    }
}
