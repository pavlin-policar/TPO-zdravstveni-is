<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UstvariTabeloSifranti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sifranti', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('vrstaSifranta')->unsigned();
            $table->string('imeSifranta');
			$table->text('opisSifranta');
            $table->timestamps();
			
			$table->foreign('vrstaSifranta')->references('id')->on('vrsteSifrantov');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sifranti');
    }
}
