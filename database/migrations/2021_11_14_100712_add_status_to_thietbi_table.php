<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToThietbiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thietbi', function (Blueprint $table) {
            $table->tinyInteger('status')->comment('1: Bình thường, 2: Đang yêu cầu sửa, 3: Đã hỏng')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('thietbi', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
