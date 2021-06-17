<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('uuid');
            $table->integer("id")->nullable(false)->comment("部门id，32位整型，指定时必须大于1。若不填该参数，将自动生成id");
            $table->string('name')->nullable()->comment("部门名称。同一个层级的部门名称不能重复。长度限制为1~32个字符，字符不能包括\:?”<>｜");
            $table->string('name_en')->nullable()->comment("英文名称。同一个层级的部门名称不能重复。需要在管理后台开启多语言支持才能生效。长度限制为1~32个字符，字符不能包括\:?”<>｜");
            $table->integer('parentid')->nullable(false)->comment("父部门id");
            $table->integer('order')->nullable(false)->comment("在父部门中的次序值。order值大的排序靠前。有效的值范围是[0, 2^32)");
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
        Schema::dropIfExists('departments');
    }
}
