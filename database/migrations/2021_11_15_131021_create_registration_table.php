<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration', function (Blueprint $table) {
            $table->string('id_user', 7);
            $table->unsignedBigInteger('id_stationery');
            $table->string('id_period', 4);
            $table->integer('qty');
            $table->dateTime('received_at')->nullable();

            $table->primary(['id_user', 'id_stationery', 'id_period']);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_stationery')->references('id')->on('stationery')->onDelete('cascade');
            $table->foreign('id_period')->references('id')->on('period_registration')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::disableForeignKeyConstraints();
        DB::statement('ALTER TABLE registration ADD CONSTRAINT ck_qty CHECK (qty >= 0)');
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registration');
    }
}
