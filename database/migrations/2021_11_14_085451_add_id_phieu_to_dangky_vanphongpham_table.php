<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdPhieuToDangkyVanphongphamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dangky_vanphongpham', function (Blueprint $table) {
            $table->string('id_phieu', 9)->nullable();

            $table->foreign('id_phieu')->references('id')->on('phieudenghi')->onDelete('set null');
            $table->dropColumn('is_tonghop');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dangky_vanphongpham', function (Blueprint $table) {
            $table->dropForeign(['id_phieu']);
            $table->dropColumn('id_phieu');
            $table->boolean('is_tonghop');
        });
    }
}
