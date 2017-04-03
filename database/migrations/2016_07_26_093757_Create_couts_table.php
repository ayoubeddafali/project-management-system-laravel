<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('libelle'); // libelle budget
            $table->string('pmh'); // profil moyens humains
            $table->string('bca'); // budget cible alloué
            $table->string('actif');
            $table->text('commentaire');

            

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
        Schema::drop('couts');
    }
}
