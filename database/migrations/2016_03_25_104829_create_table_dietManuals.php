<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableDietManuals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diet_manuals', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->timestamps();

            $table->integer('diet')->unsigned();
            $table->foreign('diet')
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
        Schema::drop('diet_manuals');
    }
}
