<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCheckDiete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkDiete', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('check')->unsigned();
			$table->integer('diet')->unsigned();
			$table->text('note')->nullable();
			$table->timestamps();
			
			$table->foreign('check')->references('id')->on('checks');
			$table->foreign('diet')->references('id')->on('diets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('checkDiete');
    }
}
