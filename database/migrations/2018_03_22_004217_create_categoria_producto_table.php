<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_producto', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('categoria_id')->unsigned();
            $table->integer('producto_id')->unsigned();

            $table->timestamps();

            $table->index('id');
            $table->index('categoria_id');
            $table->index('producto_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::drop('categoria_producto');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
