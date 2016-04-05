<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCheckMedical extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_medical', function (Blueprint $table) {
            $table->increments('id');
			$table->text('note')->nullable();
			$table->timestamps();

            $table->integer('check')->unsigned();
			$table->foreign('check')
                ->references('id')->on('checks')
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
        Schema::drop('check_medical');
    }
}
