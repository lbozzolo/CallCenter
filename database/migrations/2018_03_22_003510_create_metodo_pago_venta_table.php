<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateMetodoPagoVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metodo_pago_venta', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('venta_id')->unsigned()->nullable();
            $table->integer('metodopago_id')->unsigned()->nullable();
            $table->integer('datostarjeta_id')->unsigned()->nullable();
            $table->integer('formadepago_id')->unsigned()->nullable();
            $table->string('importe');

            $table->index('id');
            $table->index('venta_id');
            $table->index('metodopago_id');
            $table->index('datostarjeta_id');
            $table->index('formadepago_id');
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
        Schema::drop('metodo_pago_venta');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
