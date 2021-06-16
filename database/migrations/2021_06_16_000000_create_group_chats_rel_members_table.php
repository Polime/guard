<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupChatsRelMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_chats_rel_members', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->autoIncrement();
            $table->uuid('member_uuid')->comment("群成员的uuid");
            $table->tinyInteger("type")->comment("成员类型。1 - 企业成员,2 - 外部联系人");
            $table->string("unionid")->comment("外部联系人在微信开放平台的唯一身份标识（微信unionid），通过此字段企业可将外部联系人与公众号/小程序用户关联起来。仅当群成员类型是微信用户（包括企业成员未添加好友）");
            $table->timestamp("join_time")->comment("入群时间");
            $table->tinyInteger("join_scene")->comment("入群方式。1 - 由成员邀请入群（直接邀请入群）,2 - 由成员邀请入群（通过邀请链接入群）,3 - 通过扫描群二维码入群");
            $table->uuid('invitor_uuid')->comment("邀请者的uuid");
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
        Schema::dropIfExists('group_chats_rel_members');
    }
}
