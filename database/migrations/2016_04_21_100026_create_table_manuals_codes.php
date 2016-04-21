<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableManualsCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manuals_codes', function (Blueprint $table) { //connection table beetwen cure manuals andcures 
            $table->increments('id');
			$table->text('note')->nullable();

            $table->integer('manual')->unsigned();
			$table->foreign('manual')
                ->references('id')->on('manuals')
                ->onUpdate('cascade');

            $table->integer('code')->unsigned();
			$table->foreign('code')
                ->references('id')->on('codes')
                ->onUpdate('cascade');
			
			$table->softDeletes();
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('manuals_codes');
    }
}
