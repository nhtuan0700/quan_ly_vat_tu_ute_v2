<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChitietmuaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietmua', function (Blueprint $table) {
            $table->char('id_phieu', 9);
            $table->unsignedBigInteger('id_vanphongpham');
            $table->integer('qty');
            $table->decimal('cost', 10, 0)->nullable();

            $table->primary(['id_phieu', 'id_vanphongpham']);
            $table->foreign('id_phieu')->references('id')->on('phieudenghi')->onDelete('cascade');
            $table->foreign('id_vanphongpham')->references('id')->on('vanphongpham')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chitietmua');
    }
}
