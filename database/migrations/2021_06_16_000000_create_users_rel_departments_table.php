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
            $table->bigIncrements('uuid');
            $table->unsignedBigInteger('user_uuid')->nullable(false)->comment("成员id");
            $table->unsignedBigInteger('department_uuid')->nullable(false)->comment("部门id");
            $table->tinyInteger('is_leader_in_dept')->nullable(false)->comment("表示在所在的部门内是否为上级");
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
        Schema::dropIfExists('users_rel_departments');
    }
}
