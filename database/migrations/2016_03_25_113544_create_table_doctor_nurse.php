<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDoctorNurse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_nurse', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('nurse')->unsigned();
			$table->integer('doctor')->unsigned();
            $table->timestamps();
			
			$table->foreign('nurse')->references('id')->on('users');
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
        Schema::drop('doctor_nurse');
    }
}
