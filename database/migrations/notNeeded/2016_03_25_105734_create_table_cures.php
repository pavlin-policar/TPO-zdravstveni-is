<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cures', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('manual')->unsigned();
			$table->timestamps();
			
			$table->foreign('manual')
                ->references('id')->on('cure_manuals')
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
        Schema::drop('cures');
    }
}
