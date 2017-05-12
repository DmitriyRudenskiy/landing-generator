<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('visible');
            $table->integer('priority')->default(10);
            $table->string('photo')->nullable();
            $table->string('equipment');
            $table->string('engine');
            $table->string('power');
            $table->string('transmission');
            $table->string('drive_unit');
            $table->string('body_type');
            $table->string('colour');
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
        Schema::drop('products');
    }
}