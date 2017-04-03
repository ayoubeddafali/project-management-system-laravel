<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

        });
        Schema::create('role_user',function(Blueprint $table){

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')
                ->references('id')->on('roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('project_id')->unsigned();
          

            $table->primary(['user_id','role_id','project_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roles');
        Schema::drop('role_user');
    }
}
