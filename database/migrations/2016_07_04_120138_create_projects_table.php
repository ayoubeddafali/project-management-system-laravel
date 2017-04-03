<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void 
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('libelle');
            $table->string('libelle_long');
            $table->string('logo');
            $table->string('charte');
            $table->string('status');
            $table->string('chef');
            $table->date('debut');
            $table->date('fin');
            $table->string('continent');
            $table->string('pays');
            $table->string('site');
            $table->string('entreprise');
            $table->string('direction');
            $table->integer('cout_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('cout_id')
                ->references('id')->on('couts')
                ->onUpdate('cascade');
            $table->foreign('status')
                ->referenecs('id')->on('statuses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projects');
    }
}
