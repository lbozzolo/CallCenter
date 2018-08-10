<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_venta', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('producto_id')->unsigned()->nullable();
            $table->integer('venta_id')->unsigned()->nullable();

            $table->index('id');
            $table->index('producto_id');
            $table->index('venta_id');
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
        Schema::drop('producto_venta');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
