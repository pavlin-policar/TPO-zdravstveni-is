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
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('address')->nullable();
			$table->integer('post')->unsigned()->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phoneNumber')->nullable();
			$table->integer('ZZCardNumber')->unique()->unsigned()->nullable();
			$table->date('birthDate')->nullable();
			$table->integer('gender')->unsigned()->nullable();
			$table->integer('personalDoctor')->unsigned()->nullable();
			$table->integer('personalDentist')->unsigned()->nullable();
			$table->integer('personType')->unsigned()->nullable();
			$table->integer('delegate')->unsigned()->nullable();
			$table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
			
			$table->foreign('post')->references('id')->on('posts');
			$table->foreign('personalDoctor')->references('id')->on('users');
			$table->foreign('personalDentist')->references('id')->on('users');
			$table->foreign('personType')->references('id')->on('codes');
			$table->foreign('gender')->references('id')->on('codes');
			$table->foreign('delegate')->references('id')->on('codes'); //skrbnik
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
