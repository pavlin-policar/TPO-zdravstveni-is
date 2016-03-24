<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UstvariTabeloZdravniki extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zdravnik', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('profil')->unsigned();
			$table->integer('stevilkaZdravnika')->unique()->unsigned()->nullable();
			$table->integer('moznoSteviloPacientov')->unsigned()->nullable();
            $table->timestamps();
			
			$table->foreign('profil')->references('id')->on('uporabniki');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('zdravnik');
    }
}
