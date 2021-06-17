<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationships', function (Blueprint $table) {
            $table->bigIncrements('uuid');
            $table->unsignedBigInteger('customer_uuid')->nullable(false)->comment("客户的uuid");
            $table->unsignedBigInteger('user_uuid')->nullable(false)->comment("员工的uuid");
            $table->string('remark')->nullable()->comment("该成员对此外部联系人的备注");
            $table->string("description")->nullable()->comment("该成员对此外部联系人的描述");
            $table->timestamp("createtime")->nullable()->comment("该成员添加此外部联系人的时间");
            $table->string("remark_corp_name")->nullable()->comment("该成员对此客户备注的企业名称");
            $table->string("remark_mobiles")->nullable()->comment("该成员对此客户备注的手机号码,','隔开");
            //0	未知来源
            //1	扫描二维码
            //2	搜索手机号
            //3	名片分享
            //4	群聊
            //5	手机通讯录
            //6	微信联系人
            //7	来自微信的添加好友申请
            //8	安装第三方应用时自动添加的客服人员
            //9	搜索邮箱
            //201	内部成员共享
            //202	管理员/负责人分配
            $table->integer("add_way")->comment("该成员添加此客户的来源");
            $table->string("oper_userid")->comment("发起添加的userid，如果成员主动添加，为成员的userid；如果是客户主动添加，则为客户的外部联系人userid；如果是内部成员共享/管理员分配，则为对应的成员/管理员userid");
            $table->string("state")->comment("企业自定义的state参数，用于区分客户具体是通过哪个「联系我」添加");
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
        Schema::dropIfExists('relationships');
    }
}
