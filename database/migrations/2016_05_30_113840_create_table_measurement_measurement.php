<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMeasurementMeasurement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurement_measurement', function (Blueprint $table) {
            $table->increments('id');
			$table->text('note')->nullable();
			$table->softDeletes();
			$table->timestamps();

            $table->integer('big_measurement')->unsigned();
			$table->foreign('big_measurement')
                ->references('id')->on('codes')
                ->onUpdate('cascade');

            $table->integer('small_measurement')->unsigned();
			$table->foreign('small_measurement')
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
        Schema::drop('measurement_measurement');
    }
}
