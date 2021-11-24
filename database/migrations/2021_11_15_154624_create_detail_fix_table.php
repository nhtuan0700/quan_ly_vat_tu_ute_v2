<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailFixTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_fix', function (Blueprint $table) {
            $table->char('id_note', 9);
            $table->char('id_equipment', 8);
            $table->string('reason')->nullable();
            $table->decimal('cost', 10, 0)->nullable();
            
            $table->primary(['id_note', 'id_equipment']);
            $table->foreign('id_note')->references('id')->on('request_note')->onDelete('cascade');
            $table->foreign('id_equipment')->references('id')->on('equipment')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_fix');
    }
}