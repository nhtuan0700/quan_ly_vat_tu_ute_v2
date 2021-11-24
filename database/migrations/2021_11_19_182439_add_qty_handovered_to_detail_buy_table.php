<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQtyHandoveredToDetailBuyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_buy', function (Blueprint $table) {
            $table->integer('qty_handovered')->default(0);
        });

        Schema::disableForeignKeyConstraints();
        DB::statement('ALTER TABLE detail_buy ADD CONSTRAINT ck_qty CHECK (qty >= 0)');
        DB::statement('ALTER TABLE detail_buy ADD CONSTRAINT ck_qty_handovered CHECK (qty_handovered >= 0)');
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_buy', function (Blueprint $table) {
            $table->dropColumn(['qty_handovered']);
        });
    }
}
