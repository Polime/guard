<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('uuid');
            $table->string('external_userid')->nullable(false)->comment("外部联系人的userid");
            $table->string('name')->nullable()->comment("外部联系人的名称");
            $table->string('avatar')->nullable()->comment("外部联系人头像");
            $table->string("type")->nullable(false)->comment("外部联系人的类型，1表示该外部联系人是微信用户，2表示该外部联系人是企业微信用户");
            $table->tinyInteger("gender")->nullable(false)->comment("外部联系人性别 0-未知 1-男性 2-女性");
            $table->string("unionid")->nullable()->comment("外部联系人在微信开放平台的唯一身份标识（微信unionid），通过此字段企业可将外部联系人与公众号/小程序用户关联起来。");
            $table->string("position")->nullable()->comment("外部联系人的职位");
            $table->string("corp_name")->nullable()->comment("外部联系人所在企业的简称");
            $table->string("corp_full_name")->nullable()->comment("	外部联系人所在企业的主体名称");
            $table->timestamp('create_time')->nullable()->comment("创建时间");
            $table->timestamp('update_time')->nullable()->comment("修改时间");
            $table->tinyInteger("is_delete")->nullable()->comment("是否删除");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
