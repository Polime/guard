<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactWaysRelUsersOrDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_ways_rel_users_or_departments', function (Blueprint $table) {
            $table->bigIncrements('uuid');
            $table->unsignedBigInteger('contact_way_uuid')->nullable(false)->comment("联系我的uuid");
            $table->unsignedBigInteger('rel_uuid')->nullable(false)->comment("关联的uuid");
            $table->tinyInteger('rel_type')->nullable(false)->comment("关联的类型:1-员工,2-部门");
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
        Schema::dropIfExists('contact_ways_rel_users_or_departments');
    }
}
