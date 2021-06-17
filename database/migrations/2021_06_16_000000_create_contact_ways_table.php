<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactWaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_ways', function (Blueprint $table) {
            $table->bigIncrements('uuid');
            $table->string('config_id')->nullable(false)->comment("新增联系方式的配置id");
            $table->tinyInteger("type")->nullable(false)->comment("联系方式类型，1-单人，2-多人");
            $table->tinyInteger("scene")->nullable(false)->comment("场景，1-在小程序中联系，2-通过二维码联系");
            $table->tinyInteger("style")->nullable()->comment("小程序中联系按钮的样式，仅在scene为1时返回");
            $table->string("remark")->nullable()->comment("联系方式的备注信息，用于助记");
            $table->tinyInteger("skip_verify")->nullable(false)->comment("是否配置了客户联系");
            $table->string("state")->nullable(false)->comment("企业自定义的state参数，用于区分不同的添加渠道");
            $table->string("qr_code")->nullable()->comment("联系二维码的URL，仅在scene为2时返回");
            $table->tinyInteger("is_temp")->nullable(false)->comment("是否临时会话模式，默认为false，true表示使用临时会话模式");
            $table->integer("expires_in")->nullable()->comment("临时会话二维码有效期，以秒为单位");
            $table->integer("chat_expires_in")->nullable()->comment("临时会话有效期，以秒为单位");
            $table->string("unionid")->nullable()->comment("可进行临时会话的客户unionid");
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
        Schema::dropIfExists('contact_ways');
    }
}
