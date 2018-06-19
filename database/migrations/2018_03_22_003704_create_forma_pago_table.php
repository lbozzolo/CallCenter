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
            $table->tinyInteger('cuota_valor');
            $table->tinyInteger('interes')->nullable();
            $table->tinyInteger('descuento')->nullable();

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
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::drop('forma_pago');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
