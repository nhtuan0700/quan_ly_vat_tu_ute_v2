<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThietbiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thietbi', function (Blueprint $table) {
            $table->string('id', 8);
            $table->string('name');
            $table->string('phong')->nullable();
            $table->date('ngay_mua')->nullable();
            $table->date('ngay_cap')->nullable();
            $table->string('thong_so')->nullable();

            $table->primary('id');
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
        Schema::dropIfExists('thietbi');
    }
}
