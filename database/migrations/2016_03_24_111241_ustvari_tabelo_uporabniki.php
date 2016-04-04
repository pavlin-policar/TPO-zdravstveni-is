<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UstvariTabeloUporabniki extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('address')->nullable();
			$table->integer('post')->unsigned()->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_number')->nullable();
			$table->integer('zz_card_number')->unique()->unsigned()->nullable();
			$table->date('birth_date')->nullable();
			$table->integer('gender')->unsigned()->nullable();
			$table->integer('personal_doctor')->unsigned()->nullable();
			$table->integer('personal_dentist')->unsigned()->nullable();
			$table->integer('person_type')->unsigned()->nullable();
			$table->integer('caretaker')->unsigned()->nullable();
			$table->boolean('confirmed')->nullable();
			$table->string('confirmation_code')->nullable();
			$table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
            $table->dateTime('last_login')->nullable();
			
			$table->foreign('post')->references('id')->on('posts');
			$table->foreign('personal_doctor')->references('id')->on('users');
			$table->foreign('personal_dentist')->references('id')->on('users');
			$table->foreign('person_type')->references('id')->on('codes');
			$table->foreign('gender')->references('id')->on('codes');
			$table->foreign('caretaker')->references('id')->on('codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
