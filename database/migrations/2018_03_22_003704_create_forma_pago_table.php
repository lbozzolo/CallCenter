<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormaPagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forma_pago', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('marca_tarjeta_id')->unsigned();
            $table->integer('banco_id')->unsigned()->nullable();
            $table->tinyInteger('cuota_cantidad');
            $table->tinyInteger('interes')->nullable();
            $table->tinyInteger('descuento')->nullable();

            $table->timestamps();

            $table->index('id');
            $table->index('marca_tarjeta_id');
            $table->index('banco_id');
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
        Schema::drop('forma_pago');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
