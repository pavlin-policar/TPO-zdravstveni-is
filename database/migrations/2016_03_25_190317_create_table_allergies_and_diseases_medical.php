<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAllergiesAndDiseasesMedical extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allergies_and_diseases_medical', function (Blueprint $table) {
            $table->increments('id');
			$table->text('note')->nullable();
			$table->text('sideEffects')->nullable();
			$table->timestamps();

            $table->integer('allergy_or_disease')->unsigned();
			$table->foreign('allergy_or_disease')
                ->references('id')->on('allergies_and_diseases')
                ->onUpdate('cascade');

            $table->integer('cure')->unsigned();
			$table->foreign('cure')
                ->references('id')->on('cures')
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
        Schema::drop('allergies_and_diseases_medical');
    }
}
