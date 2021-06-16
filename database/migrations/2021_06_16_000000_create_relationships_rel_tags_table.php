<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationshipsRelTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationships_rel_tags', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->autoIncrement();
            $table->uuid('relationship_uuid')->comment("关系的uuid");
            $table->uuid('tag_uuid')->comment("标签的uuid");
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
        Schema::dropIfExists('relationships_rel_tags');
    }
}
