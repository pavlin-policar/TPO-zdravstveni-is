<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableCodes extends Migration
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
            $table->string('key')->unique()->nullable();
            $table->string('name');
			$table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->double('min_value', 15, 6)->nullable();
            $table->double('max_value', 15, 6)->nullable();
			$table->softDeletes();
            $table->timestamps();

            $table->integer('code_type')->unsigned();
            $table->foreign('code_type')
                ->references('id')->on('code_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
