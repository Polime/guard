<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactWaysRelConclutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_ways_rel_conclutions', function (Blueprint $table) {
            $table->bigIncrements('uuid');
            $table->unsignedBigInteger('contact_way_uuid')->comment("联系我的uuid");
            $table->string("type")->nullable(false)->comment("类型:1-text-文字,2-image-图片,3-link-链接,4-miniprogram-小程序");
            $table->string("text_content")->nullable()->comment("消息文本内容,最长为4000字节");
            $table->string("image_media_id")->nullable()->comment("图片的media_id");
            $table->string("link_title")->nullable()->comment("图文消息标题，最长为128字节");
            $table->string("link_picurl")->nullable()->comment("图文消息封面的url");
            $table->string("link_desc")->nullable()->comment("图文消息的描述，最长为512字节");
            $table->string("link_url")->nullable()->comment("图文消息的链接");
            $table->string("miniprogram_title")->nullable()->comment("小程序消息标题，最长为64字节");
            $table->string("miniprogram_pic_media_id")->nullable()->comment("小程序消息封面的mediaid");
            $table->string("miniprogram_appid")->nullable()->comment("小程序appid");
            $table->string("miniprogram_page")->nullable()->comment("小程序page路径");
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
        Schema::dropIfExists('contact_ways_rel_conclutions');
    }
}
