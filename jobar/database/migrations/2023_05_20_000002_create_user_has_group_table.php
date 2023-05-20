<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHasGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('user_has_group')) {
            return;
        }
        Schema::create('user_has_group', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('使用者 id');
            $table->integer('group_id')->comment('群組的 id');
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
        Schema::dropIfExists('user_has_group');
    }
}
