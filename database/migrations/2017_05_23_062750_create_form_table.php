<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('visible')->nullable();
            $table->string('form_title')->nullable();
            $table->string('name_label')->nullable();
            $table->string('phone_label')->nullable();
            $table->string('name_placeholder')->nullable();
            $table->string('phone_placeholder')->nullable();
            $table->string('button_title')->nullable();
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
        Schema::drop('form');
    }
}