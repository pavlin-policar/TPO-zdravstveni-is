<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDietManuals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dietManuals', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
			$table->integer('diet')->unsigned();
            $table->timestamps();
			
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
        Schema::drop('dietManuals');
    }
}
