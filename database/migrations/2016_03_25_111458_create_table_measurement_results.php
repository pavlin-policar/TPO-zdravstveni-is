<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMeasurementResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurement_results', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('measurement')->unsigned();
			$table->integer('type')->unsigned();
			$table->double('result', 15, 6);
            $table->timestamps();
			
			$table->foreign('measurement')->references('id')->on('measurements')->onUpdate('cascade'); //izvajalec
			$table->foreign('type')->references('id')->on('codes')->onUpdate('cascade'); //tip meritve
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('measurement_results');
    }
}
