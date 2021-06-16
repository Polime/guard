<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->autoIncrement();
            $table->string("type")->comment("媒体文件类型，分别有图片（image）、语音（voice）、视频（video），普通文件(file)");
            $table->string("media_id")->comment("媒体文件上传后获取的唯一标识，3天内有效");
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
        Schema::dropIfExists('medias');
    }
}
