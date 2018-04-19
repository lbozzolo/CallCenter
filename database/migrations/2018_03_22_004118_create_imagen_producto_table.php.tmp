<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagenProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagen_producto', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('imagen_id')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->tinyInteger('principal');

            $table->timestamps();

            $table->index('id');
            $table->index('imagen_id');
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
        Schema::drop('imagen_producto');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
