<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableChecks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checks', function (Blueprint $table) {
            $table->increments('id');
   			$table->integer('patient')->unsigned();
			$table->integer('doctor')->unsigned();
			$table->integer('doctorDate')->unsigned()->nullable();
			$table->text('note')->nullable();
            $table->timestamps();
			
			$table->foreign('patient')->references('id')->on('users');
			$table->foreign('doctor')->references('id')->on('users');
			$table->foreign('doctorDate')->references('id')->on('doctorDates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('checks');
    }
}
