<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('address')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken()->nullable();
            $table->string('phone_number')->nullable();
			$table->integer('zz_card_number')->unique()->unsigned()->nullable();
			$table->date('birth_date')->nullable();
			$table->boolean('confirmed')->nullable();
			$table->string('confirmation_code')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->integer('post')->unsigned()->nullable();
			$table->foreign('post')
                ->references('id')->on('posts')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->integer('personal_doctor_id')->unsigned()->nullable();
			$table->foreign('personal_doctor_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->integer('personal_dentist_id')->unsigned()->nullable();
			$table->foreign('personal_dentist_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->integer('caretaker_id')->unsigned()->nullable();
            $table->foreign('caretaker_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->integer('person_type')->unsigned()->nullable();
			$table->foreign('person_type')
                ->references('id')->on('codes')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->integer('gender')->unsigned()->nullable();
			$table->foreign('gender')
                ->references('id')->on('codes')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
