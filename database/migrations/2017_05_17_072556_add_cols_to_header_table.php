<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('header', function (Blueprint $table) {
            $table->string('description')->nullable();
            $table->string('button')->nullable();
            $table->string('add_1')->nullable();
            $table->string('add_2')->nullable();
            $table->string('add_3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('header', function (Blueprint $table) {
            //
        });
    }
}
