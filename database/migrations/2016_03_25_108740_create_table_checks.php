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
			$table->text('note')->nullable();
            $table->timestamps();

            $table->integer('patient')->unsigned();
			$table->foreign('patient')->references('id')->on('users');

            $table->integer('doctor')->unsigned();
			$table->foreign('doctor')->references('id')->on('users');

            $table->integer('doctor_date')->unsigned()->nullable();
			$table->foreign('doctor_date')->references('id')->on('doctor_dates');
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
