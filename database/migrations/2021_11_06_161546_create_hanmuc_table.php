<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHanmucTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hanmuc', function (Blueprint $table) {
            $table->string('id_user', 7);
            $table->unsignedBigInteger('id_vanphongpham');
            $table->integer('qty_used');
            $table->integer('qty_max');
            $table->integer('quy');
            $table->integer('year');

            $table->primary(['id_user', 'id_vanphongpham']);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_vanphongpham')->references('id')->on('vanphongpham')->onDelete('cascade');
            $table->timestamps();
        });
        
        Schema::disableForeignKeyConstraints();
        DB::statement('ALTER TABLE hanmuc ADD CONSTRAINT ck_qty_used_qty CHECK (qty_used >= 0)');
        DB::statement('ALTER TABLE hanmuc ADD CONSTRAINT ck_qty_max_qty CHECK (qty_max >= 0)');
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hanmuc');
    }
}
