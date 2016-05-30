<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNursesInstitutions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurses_institutions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('nurse_id')->unsigned();
            $table->foreign('nurse_id')
                ->references('id')->on('users')
                ->onUpdate('cascade');

            $table->integer('institution_id')->unsigned();
			$table->foreign('institution_id')
                ->references('id')->on('codes')
                ->onUpdate('cascade');
				
			$table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nurses_institutions');
    }
}
