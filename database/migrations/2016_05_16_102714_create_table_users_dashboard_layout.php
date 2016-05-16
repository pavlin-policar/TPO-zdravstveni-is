<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsersDashboardLayout extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_dashboard_layout', function (Blueprint $table) {
            $table->increments('id');
            $table->text('layout_json')->nullable();
            $table->dateTime('visible_json')->nullable();
            $table->timestamps();

            $table->integer('user_dashboard_id')->unsigned();
            $table->foreign('user_dashboard_id')
                ->references('id')->on('users')
                ->onUpdate('cascade');

            $table->integer('active_user_id')->unsigned();
            $table->foreign('active_user_id')
                ->references('id')->on('users')
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
        Schema::drop('users_dashboard_layout');
    }
}
