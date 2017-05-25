<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('alias')->unique();
            $table->timestamps();
        });

        DB::table('project')->insert(
            [
                'id' => 1,
                'title' => 'default',
                'alias' => '/',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('project');
    }
}