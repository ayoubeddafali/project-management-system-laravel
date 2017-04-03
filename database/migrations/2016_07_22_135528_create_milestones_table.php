<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMilestonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milestones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numero');
            $table->string('genre');
            $table->text('commentaire');
            $table->dateTime('due');
            $table->string('dependance');
            $table->string('actif');
            $table->string('dependant');
            $table->string('livrable_type');
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
        Schema::drop('milestones');
    }
}
