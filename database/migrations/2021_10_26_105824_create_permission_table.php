<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name');
            $table->string('description');
        });

        Schema::create('role_permission', function (Blueprint $table) {
            $table->unsignedTinyInteger('id_role');
            $table->unsignedSmallInteger('id_permission');

            $table->foreign('id_role')->references('id')->on('role');
            $table->foreign('id_permission')->references('id')->on('permission');
            $table->primary(['id_role', 'id_permission']);
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
        Schema::dropIfExists('role_permission');
        Schema::dropIfExists('permission');
    }
}
