<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Models\TypeParametersInterface;


class AddSum1Tables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products_label', function (Blueprint $table) {
            $table->integer('project_id')->unsigned()->default(1);
            $table->foreign('project_id')->references('id')->on('project');

            $table->integer('type_id')->default(TypeParametersInterface::TYPE_LIST);
            $table->integer('is_small')->default(false);
        });

        DB::table('products_label')->insert(
            [
                'type_id' => TypeParametersInterface::TYPE_BUTTON,
                'visible' => true,
                'name' => 'button',
                'label' => 'Купить (yes)',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]
        );

        Schema::table('products', function (Blueprint $table) {
            $table->integer('project_id')->unsigned()->default(1);
            $table->foreign('project_id')->references('id')->on('project');

            $table->integer('type_id')->default(TypeParametersInterface::TYPE_LIST);
            $table->integer('is_small')->default(false);
            $table->string('button')->nullable();

        });

        Schema::table('form', function (Blueprint $table) {
            $table->integer('project_id')->unsigned()->default(1);
            $table->foreign('project_id')->references('id')->on('project');

            $table->text('form_description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
