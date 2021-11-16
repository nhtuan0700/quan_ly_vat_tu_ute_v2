<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLimitStationeryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('limit_stationery', function (Blueprint $table) {
            $table->string('id_user', 7);
            $table->unsignedBigInteger('id_stationery');
            $table->integer('qty_used');
            $table->integer('qty_max');
            $table->integer('quarter_year');
            $table->integer('year');

            $table->primary(['id_user', 'id_stationery']);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_stationery')->references('id')->on('stationery')->onDelete('cascade');
            $table->timestamps();
        }); 
        
        Schema::disableForeignKeyConstraints();
        DB::statement('ALTER TABLE limit_stationery ADD CONSTRAINT ck_qty_used CHECK (qty_used >= 0)');
        DB::statement('ALTER TABLE limit_stationery ADD CONSTRAINT ck_qty_max CHECK (qty_max >= 0)');
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('limit_stationery');
    }
}
