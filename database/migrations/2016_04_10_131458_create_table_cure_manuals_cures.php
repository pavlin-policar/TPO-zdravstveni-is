<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCureManualsCures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cure_manuals_cures', function (Blueprint $table) { //connection table beetwen cure manuals andcures 
            $table->increments('id');
			$table->text('note')->nullable();
			$table->timestamps();

            $table->integer('cure_manual')->unsigned();
			$table->foreign('cure_manual')
                ->references('id')->on('codes')
                ->onUpdate('cascade');

            $table->integer('cure')->unsigned();
			$table->foreign('cure')
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
        Schema::drop('cure_manuals_cures');
    }
}
