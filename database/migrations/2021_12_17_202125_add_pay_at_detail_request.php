<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPayAtDetailRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_buy', function (Blueprint $table) {
            $table->dateTime('pay_at')->nullable();
            $table->dropTimestamps();
        });
        Schema::table('detail_fix', function (Blueprint $table) {
            $table->dateTime('pay_at')->nullable();
            $table->dropTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_buy', function (Blueprint $table) {
            $table->dropColumn('pay_at');
            $table->timestamps();
        });
        Schema::table('detail_fix', function (Blueprint $table) {
            $table->dropColumn('pay_at');
            $table->timestamps();
        });
    }
}
