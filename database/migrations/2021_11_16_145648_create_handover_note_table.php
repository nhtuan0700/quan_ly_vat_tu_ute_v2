<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHandoverNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('handover_note', function (Blueprint $table) {
            $table->char('id', 9);
            $table->char('id_request_note', 9);
            $table->char('id_creator', 7);
            $table->dateTime('confirmed_at')->nullable();
            $table->timestamps();

            $table->primary('id');
            $table->foreign('id_request_note')->references('id')->on('request_note');
            $table->foreign('id_creator')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('handover_note');
    }
}
