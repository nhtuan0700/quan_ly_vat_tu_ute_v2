<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailHandoverBuyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_handover_buy', function (Blueprint $table) {
            $table->char('id_note', 9);
            $table->unsignedBigInteger('id_stationery');
            $table->integer('qty');

            $table->primary(['id_note', 'id_stationery']);
            $table->foreign('id_note')->references('id')->on('handover_note')->onDelete('cascade');
            $table->foreign('id_stationery')->references('id')->on('stationery')->onDelete('cascade');
        });

        Schema::disableForeignKeyConstraints();
        DB::statement('ALTER TABLE detail_handover_buy ADD CONSTRAINT ck_qty CHECK (qty >= 0)');
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_handover_buy');
    }
}
