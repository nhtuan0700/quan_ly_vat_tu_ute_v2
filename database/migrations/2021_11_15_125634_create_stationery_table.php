<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationeryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationery', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('unit');
            $table->integer('limit_avg');
            $table->unsignedTinyInteger('id_category')->nullable();
            $table->foreign('id_category')->references('id')->on('category');
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stationery');
    }
}
