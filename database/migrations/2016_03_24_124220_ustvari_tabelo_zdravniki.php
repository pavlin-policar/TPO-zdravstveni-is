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
        Schema::create('doctor', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('profile')->unsigned();
			$table->integer('doctorNumber')->unique()->unsigned()->nullable();
			$table->integer('doctorType')->unique()->unsigned()->nullable();
			$table->integer('institution')->unique()->unsigned()->nullable();
			$table->integer('maxPatients')->unsigned()->nullable();
            $table->timestamps();
			
			$table->foreign('profile')->references('id')->on('users');
			$table->foreign('doctorType')->references('id')->on('codes');
			$table->foreign('institution')->references('id')->on('codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('doctor');
    }
}
