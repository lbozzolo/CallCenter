<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosTarjetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_tarjeta', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('venta_id')->unsigned();
            $table->integer('marca_id')->unsigned()->nullable();
            $table->integer('banco_id')->unsigned()->nullable();
            $table->string('numero_tarjeta', 16);
            $table->integer('forma_pago_id')->unsigned()->nullable();
            $table->dateTime('fecha_expiracion');
            $table->string('titular', 100);
            $table->integer('codigo_seguridad');

            $table->timestamps();

            $table->index('id');
            $table->index('venta_id');
            $table->index('marca_id');
            $table->index('banco_id');
            $table->index('forma_pago_id');
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
        Schema::drop('datos_tarjeta');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
