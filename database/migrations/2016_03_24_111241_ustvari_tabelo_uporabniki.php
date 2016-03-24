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
        Schema::create('uporabniki', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ime')->nullable();
            $table->string('priimek')->nullable();
            $table->string('naslov')->nullable();
			$table->integer('posta')->unsigned()->nullable();
            $table->string('email')->unique();
            $table->string('geslo');
            $table->string('telefon')->nullable();
			$table->integer('stevilkaKarticeZZ')->unique()->unsigned()->nullable();
			$table->date('datumRojstva')->nullable();
			$table->tinyInteger('spol')->nullable();
			$table->integer('osebniZdravnik')->unsigned()->nullable();
			$table->integer('osebniZobozdravnik')->unsigned()->nullable();
			$table->integer('rang')->unsigned()->nullable();
			$table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
			
			$table->foreign('posta')->references('id')->on('poste');
			$table->foreign('osebniZdravnik')->references('id')->on('uporabniki');
			$table->foreign('osebniZobozdravnik')->references('id')->on('uporabniki');
			$table->foreign('rang')->references('id')->on('sifranti');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('uporabniki');
    }
}
