<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_note', function (Blueprint $table) {
            $table->char('id', 9);
            $table->char('id_creator', 7);
            $table->char('id_handler', 7)->nullable();
            $table->char('id_period', 4)->nullable();
            $table->char('id_department', 6);
            $table->dateTime('processed_at')->nullable();
            $table->boolean('is_buy');
            $table->tinyInteger('status')->comment('1: Chờ duyệt, 2: Chờ bàn giao, 3: Đã hoàn thành');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->primary('id');
            $table->foreign('id_creator')->references('id')->on('users');
            $table->foreign('id_handler')->references('id')->on('users');
            $table->foreign('id_period')->references('id')->on('period_registration');
            $table->foreign('id_department')->references('id')->on('department');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_note');
    }
}
