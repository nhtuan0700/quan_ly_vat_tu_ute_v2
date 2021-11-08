<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDangkyVanphongphamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dangky_vanphongpham', function (Blueprint $table) {
            $table->string('id_user', 7);
            $table->unsignedBigInteger('id_vanphongpham');
            $table->string('id_dotdk', 4);
            $table->integer('qty');
            $table->boolean('status');
            $table->boolean('is_received');

            $table->primary(['id_user', 'id_vanphongpham', 'id_dotdk']);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_vanphongpham')->references('id')->on('vanphongpham')->onDelete('cascade');
            $table->foreign('id_dotdk')->references('id')->on('dotdangky')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::disableForeignKeyConstraints();
        DB::statement('ALTER TABLE dangky_vanphongpham ADD CONSTRAINT ck_qty CHECK (qty >= 0)');
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dangky_vanphongpham');
    }
}
