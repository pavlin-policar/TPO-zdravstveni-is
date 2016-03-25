<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDoctorDates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctorDates', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('patient')->unsigned()->nullable();
			$table->integer('doctor')->unsigned();
			$table->text('note')->nullable();
			$table->dateTime('time');
            $table->timestamps();
			
			$table->foreign('patient')->references('id')->on('users');
			$table->foreign('doctor')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('doctorDates');
    }
}
