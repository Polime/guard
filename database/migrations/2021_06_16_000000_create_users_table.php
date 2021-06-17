<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('uuid');
            $table->string('userid')->nullable(false)->comment("成员UserID。对应管理端的帐号，企业内必须唯一。不区分大小写，长度为1~64个字节");
            $table->string('name')->nullable()->comment("成员名称");
            $table->string('mobile')->nullable()->comment("手机号码");
            $table->string("position")->nullable()->comment("职务信息");
            $table->tinyInteger("gender")->nullable(false)->comment("性别。0表示未定义，1表示男性，2表示女性");
            $table->string("email")->nullable()->comment("邮箱");
            $table->string("avatar")->nullable(false)->comment("头像url");
            $table->string("thumb_avatar")->nullable(false)->comment("头像缩略图url");
            $table->string("telephone")->nullable()->comment("	座机");
            $table->string("alias")->nullable()->comment("	别名");
            $table->tinyInteger("status")->nullable(false)->comment("激活状态: 1=已激活，2=已禁用，4=未激活，5=退出企业。
已激活代表已激活企业微信或已关注微工作台（原企业号）。未激活代表既未激活企业微信又未关注微工作台（原企业号）");
            $table->string("qr_code")->nullable()->comment("员工个人二维码，扫描可添加为外部联系人(注意返回的是一个url，可在浏览器上打开该url以展示二维码)");
            $table->string("external_position")->nullable()->comment("对外职务，如果设置了该值，则以此作为对外展示的职务，否则以position来展示");
            $table->string("address")->nullable()->comment("地址");
            $table->integer("main_department")->nullable(false)->comment("主部门");
            $table->tinyInteger("is_follow_user")->nullable(false)->comment("是否配置了客户联系");
            $table->tinyInteger("is_message_user")->nullable(false)->comment("是否配置了会话存档");
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
        Schema::dropIfExists('users');
    }
}
