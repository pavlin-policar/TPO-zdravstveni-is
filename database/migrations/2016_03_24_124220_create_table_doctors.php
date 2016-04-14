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
			$table->string('doctor_number')->unique()->nullable();
			$table->integer('max_patients')->unsigned()->nullable();
            $table->timestamps();

            $table->integer('user_id')->unique()->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade');

            $table->integer('doctor_type_id')->unsigned()->nullable();
			$table->foreign('doctor_type_id')
                ->references('id')->on('codes')
                ->onUpdate('cascade');

            $table->integer('institution_id')->unsigned()->nullable();
			$table->foreign('institution_id')
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
