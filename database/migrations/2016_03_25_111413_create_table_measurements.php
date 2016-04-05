<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMeasurements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('provider')->unsigned();
			$table->integer('patient')->unsigned();
			$table->integer('type')->unsigned();
			$table->integer('check')->unsigned()->nullable();
			$table->dateTime('time');
            $table->timestamps();
			
			$table->foreign('provider')->references('id')->on('users')->onUpdate('cascade'); //izvajalec
			$table->foreign('patient')->references('id')->on('users')->onUpdate('cascade'); //pacient
			$table->foreign('check')->references('id')->on('checks')->onUpdate('cascade'); //pregled
			$table->foreign('type')->references('id')->on('codes')->onUpdate('cascade'); //tip meritve
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('measurements');
    }
}
