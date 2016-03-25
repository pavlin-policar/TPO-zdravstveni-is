<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAllergyAndDiseaseMedical extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allergyAndDiseaseMedical', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('allergyOrDisease')->unsigned();
			$table->integer('cure')->unsigned();
			$table->text('note')->nullable();
			$table->text('sideEffects')->nullable();
			$table->timestamps();
			
			$table->foreign('allergyOrDisease')->references('id')->on('allergysAndDiseases');
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
        Schema::drop('allergyAndDiseaseMedical');
    }
}
