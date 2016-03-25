<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCheckMedical extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkMedical', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('check')->unsigned();
			$table->integer('cure')->unsigned();
			$table->text('note')->nullable();
			$table->timestamps();
			
			$table->foreign('check')->references('id')->on('checks');
			$table->foreign('cure')->references('id')->on('cures');
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
