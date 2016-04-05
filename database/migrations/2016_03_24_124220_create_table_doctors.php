<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDoctors extends Migration
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
			$table->integer('doctor_number')->unique()->unsigned()->nullable();
			$table->integer('max_patients')->unsigned()->nullable();
            $table->timestamps();

            $table->integer('profile')->unsigned();
            $table->foreign('profile')
                ->references('id')->on('users')
                ->onUpdate('cascade');

            $table->integer('doctor_type')->unique()->unsigned()->nullable();
			$table->foreign('doctor_type')
                ->references('id')->on('codes')
                ->onUpdate('cascade');

            $table->integer('institution')->unique()->unsigned()->nullable();
			$table->foreign('institution')
                ->references('id')->on('codes')
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
        Schema::drop('doctor');
    }
}
