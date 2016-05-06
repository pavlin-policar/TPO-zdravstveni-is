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
        Schema::create('doctor_dates', function (Blueprint $table) {
            $table->increments('id');
			$table->text('note')->nullable();
			$table->dateTime('time');
            $table->timestamps();

            $table->integer('patient')->unsigned()->nullable();
			$table->foreign('patient')
                ->references('id')->on('users')
                ->onUpdate('cascade');

            $table->integer('doctor')->unsigned();
			$table->foreign('doctor')
                ->references('id')->on('users')
                ->onUpdate('cascade');
				
			$table->integer('who_inserted')->unsigned()->nullable();
			$table->foreign('who_inserted')
                ->references('id')->on('users')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('doctor_dates');
    }
}
