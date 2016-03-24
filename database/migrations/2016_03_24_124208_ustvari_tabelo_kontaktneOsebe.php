<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UstvariTabeloKontaktneOsebe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontaktneOsebe', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('prvaOseba')->unsigned();
			$table->integer('drugaOseba')->unsigned();
			$table->integer('razmerje')->unsigned();
            $table->timestamps();
			
			$table->foreign('prvaOseba')->references('id')->on('uporabniki');
			$table->foreign('drugaOseba')->references('id')->on('uporabniki');
            $table->foreign('razmerje')->references('id')->on('sifranti');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kontaktneOsebe');
    }
}
