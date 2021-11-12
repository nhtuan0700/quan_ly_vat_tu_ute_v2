<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChitietsuaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietsua', function (Blueprint $table) {
            $table->char('id_phieu', 9);
            $table->char('id_thietbi', 8);
            $table->string('reason')->nullable();
            $table->boolean('status')->nullable();
            $table->decimal('cost', 10, 0)->nullable();
            
            $table->primary(['id_phieu', 'id_thietbi']);
            $table->foreign('id_phieu')->references('id')->on('phieudenghi')->onDelete('cascade');
            $table->foreign('id_thietbi')->references('id')->on('thietbi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chitietsua');
    }
}
