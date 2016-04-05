<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserRelationships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_relationships', function (Blueprint $table) {
            $table->integer('user_1')->unsigned();
			$table->foreign('user_1')
                ->references('id')->on('users')
                ->onUpdate('cascade');

            $table->integer('user_2')->unsigned();
			$table->foreign('user_2')
                ->references('id')->on('users')
                ->onUpdate('cascade');

            $table->primary(['user_1', 'user_2']);

            $table->integer('relation_id')->unsigned();
            $table->foreign('relation_id')
                ->references('id')->on('codes')
                ->onUpdate('cascade');

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
        Schema::drop('user_relationships');
    }
}
