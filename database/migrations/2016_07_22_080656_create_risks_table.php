<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRisksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('famille');
            $table->string('libelle');
            $table->string('type_mesure');
            $table->string('severite');
            $table->string('actif');
            $table->text('commentaire');
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
        Schema::drop('risks');
    }
}
