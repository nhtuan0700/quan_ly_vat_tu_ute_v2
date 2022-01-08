<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogLimitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_limit', function (Blueprint $table) {
            $table->id();
            $table->string('id_updater', 7);
            $table->string('id_confirmer', 7)->nullable();
            $table->string('file')->nullable();
            $table->string('data')->nullable();
            $table->boolean('is_confirm')->nullable();
            $table->dateTime('processed_at')->nullable();

            $table->foreign('id_confirmer')->references('id')->on('users');
            $table->foreign('id_updater')->references('id')->on('users');
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
        Schema::dropIfExists('log_limit');
    }
}
