<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('celular');
            $table->string('email');
            $table->string('dni');
            $table->string('referencia');
            $table->string('observaciones');
            $table->integer('puntos');
            $table->integer('estado_id')->unsigned();
            $table->softDeletes();

            $table->timestamps();

            $table->index('id');
            $table->index('estado_id');
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
        Schema::drop('clientes');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
