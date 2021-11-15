<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailBuyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_buy', function (Blueprint $table) {
            $table->char('id_note', 9);
            $table->unsignedBigInteger('id_stationery');
            $table->integer('qty');
            $table->decimal('cost', 10, 0)->nullable();

            $table->primary(['id_note', 'id_stationery']);
            $table->foreign('id_note')->references('id')->on('request_note')->onDelete('cascade');
            $table->foreign('id_stationery')->references('id')->on('stationery')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_buy');
    }
}
