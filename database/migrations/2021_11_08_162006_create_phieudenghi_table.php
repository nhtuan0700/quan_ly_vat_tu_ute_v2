<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhieudenghiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieudenghi', function (Blueprint $table) {
            $table->char('id', 9);
            $table->char('id_creator', 7);
            $table->char('id_csvc', 7)->nullable();
            $table->char('id_dotdk', 4)->nullable();
            $table->char('id_donvi', 4);
            $table->string('note')->nullable();
            $table->boolean('is_mua');
            $table->tinyInteger('status')->comment('1: Chờ duyệt, 2: Chờ bàn giao, 3: Đã hoàn thành');
            $table->dateTime('confirmed_at')->nullable();
            $table->timestamps();

            $table->primary('id');
            $table->foreign('id_creator')->references('id')->on('users');
            $table->foreign('id_csvc')->references('id')->on('users');
            $table->foreign('id_dotdk')->references('id')->on('dotdangky');
            $table->foreign('id_donvi')->references('id')->on('donvi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phieudenghi');
    }
}
