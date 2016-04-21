<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableChecksCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checks_codes', function (Blueprint $table) {
            $table->increments('id');
			$table->text('note')->nullable();
			$table->dateTime('start')->nullable();
			$table->dateTime('end')->nullable();
			$table->timestamps();

            $table->integer('check')->unsigned();
			$table->foreign('check')
                ->references('id')->on('checks')
                ->onUpdate('cascade');

            $table->integer('code')->unsigned();
			$table->foreign('code')
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
        Schema::drop('checks_codes');
    }
}
