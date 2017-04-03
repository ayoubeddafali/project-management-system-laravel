<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('object');
            $table->string('status');
            $table->string('transmitter');
            $table->string('assigned');
            $table->string('priority');
            $table->string('category');
            $table->string('attached_milestone');
            $table->string('risk');
            $table->string('description');
            $table->date('start');
            $table->date('due');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')
                ->references('id')->on('projects')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks');
    }
}
