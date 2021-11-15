<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->string('id', 8);
            $table->string('name');
            $table->string('room')->nullable();
            $table->date('date_grant')->nullable();
            $table->date('date_buy')->nullable();
            $table->tinyInteger('status')->comment('1: Bình thường, 2: Đang yêu cầu sửa, 3: Đã hỏng')->default(1);
            $table->text('description')->nullable();

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
        Schema::dropIfExists('equipment');
    }
}
