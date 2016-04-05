<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableCheckAllergyAndDisease extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_allergy_and_disease', function (Blueprint $table) {
            $table->increments('id');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->integer('check')->unsigned();
            $table->foreign('check')
                ->references('id')->on('checks')
                ->onUpdate('cascade');

            $table->integer('allergy_or_disease')->unsigned();
            $table->foreign('allergy_or_disease')
                ->references('id')->on('allergies_and_diseases')
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
        Schema::drop('check_allergy_and_disease');
    }
}
