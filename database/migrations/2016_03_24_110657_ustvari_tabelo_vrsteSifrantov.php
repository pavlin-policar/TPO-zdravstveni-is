<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UstvariTabeloVrsteSifrantov extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codeTypes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codeItemName');
			$table->text('codeItemDescription');
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
        Schema::drop('codeTypes');
    }
}
