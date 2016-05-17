<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNursePermits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurse_permits', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('nurse')->unsigned();
			$table->integer('doctor')->unsigned();
			$table->integer('permit')->unsigned()->nullable();
			$table->foreign('permit_type')
                ->references('id')->on('codes')
                ->onUpdate('cascade');
			$table->dateTime('start')->nullable();
			$table->dateTime('end')->nullable();
			$table->softDeletes();
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
        Schema::drop('nurse_permits');
    }
}
