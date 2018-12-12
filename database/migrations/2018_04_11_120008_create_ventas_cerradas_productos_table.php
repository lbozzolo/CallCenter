<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasCerradasProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_cerradas_productos', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('venta_cerrada_id')->unsigned();
            $table->string('nombre');
            $table->string('marca')->nullable();
            $table->string('institucion')->nullable();

            $table->index('id');
            $table->index('venta_cerrada_id');

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
        Schema::drop('ventas_cerradas_productos');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
