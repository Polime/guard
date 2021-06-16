<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupChatsRelAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_chats_rel_admins', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->autoIncrement();
            $table->uuid('admin_uuid')->comment("管理员的uuid-员工");
            $table->timestamp('create_time')->comment("创建时间");
            $table->timestamp('update_time')->comment("修改时间");
            $table->tinyInteger("is_delete")->comment("是否删除");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_chats');
    }
}
