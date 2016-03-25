<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UstvariTabeloKontaktneOsebe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactPersons', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('firstPerson')->unsigned();
			$table->integer('secondPerson')->unsigned();
			$table->integer('relation')->unsigned();
            $table->timestamps();
			
			$table->foreign('firstPerson')->references('id')->on('users');
			$table->foreign('secondPerson')->references('id')->on('users');
            $table->foreign('relation')->references('id')->on('codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contactPersons');
    }
}
