<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersRelDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_rel_departments', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->autoIncrement();
            $table->uuid('user_uuid')->comment("成员id");
            $table->uuid('department_uuid')->comment("部门id");
            $table->tinyInteger('is_leader_in_dept')->comment("表示在所在的部门内是否为上级");
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
        Schema::dropIfExists('users_rel_departments');
    }
}
