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
        Schema::create('codes', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('codeType')->unsigned();
            $table->string('codeName');
			$table->text('codeDescription');
            $table->timestamps();
			
			$table->foreign('codeType')->references('id')->on('codeTypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('codes');
    }
}
