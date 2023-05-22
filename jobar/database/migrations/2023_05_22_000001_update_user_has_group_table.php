<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserHasGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_has_group', function (Blueprint $table) {
            $table->string('order_list')->comment('訂單資訊');
            $table->integer('people')->comment('人數');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_has_group', function (Blueprint $table) {
            $table->dropColumn(['order_list']);
            $table->dropColumn(['people']);
        });
    }
}
