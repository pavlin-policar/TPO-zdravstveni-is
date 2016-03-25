<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCheckAllergyAndDisease extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkAllergyAndDisease', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('check')->unsigned();
			$table->integer('allergyOrDisease')->unsigned();
			$table->text('note')->nullable();
			$table->timestamps();
			
			$table->foreign('check')->references('id')->on('checks');
			$table->foreign('allergyOrDisease')->references('id')->on('allergysAndDiseases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('checkAllergyAndDisease');
    }
}
