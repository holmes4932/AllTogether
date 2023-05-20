<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('groups')) {
            return;
        }
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('團購名稱');
            $table->integer('owner_user_id')->comment('擁有者 user id');
            $table->integer('max_people')->comment('最大容納人數');
            $table->integer('min_people')->comment('最小需要人數');
            $table->integer('current_people')->comment('現在參與人數');
            $table->dateTime('deadline')->comment('期限');
            $table->dateTime('deleted_at')->nullable()->comment('期限');
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
        Schema::dropIfExists('groups');
    }
}
