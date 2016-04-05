<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContactInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_info', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('primary')->unsigned();
			$table->foreign('primary')
                ->references('id')->on('users')
                ->onUpdate('cascade');

            $table->integer('secondary')->unsigned();
			$table->foreign('secondary')
                ->references('id')->on('users')
                ->onUpdate('cascade');

            $table->integer('relation')->unsigned();
            $table->foreign('relation')
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
        Schema::drop('contact_info');
    }
}
