<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLimitDefaultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('limit_default', function (Blueprint $table) {
            $table->string('id_department', 6);
            $table->unsignedTinyInteger('id_position');
            $table->unsignedBigInteger('id_stationery');
            $table->unsignedBigInteger('qty');
            
            $table->primary(['id_department', 'id_position', 'id_stationery']);
            $table->foreign('id_department')->references('id')->on('department')
                ->onDelete('cascade');
            $table->foreign('id_position')->references('id')->on('position')
                ->onDelete('cascade');
            $table->foreign('id_stationery')->references('id')->on('stationery')
                ->onDelete('cascade');
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
        Schema::dropIfExists('limit_default');
    }
}
