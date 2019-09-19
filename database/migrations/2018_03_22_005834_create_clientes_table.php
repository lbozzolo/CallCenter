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
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('nombre_completo')->nullable();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->nullable();
            $table->string('username')->nullable();
            $table->string('dni')->nullable();
            $table->string('cuit')->nullable();
            $table->string('cuil')->nullable();
            $table->string('referencia')->nullable();
            $table->string('horario_contacto')->nullable();
            $table->string('observaciones')->nullable();
            $table->time('from_date')->nullable();
            $table->time('to_date')->nullable();
            $table->integer('puntos')->nullable();
            $table->integer('estado_id')->unsigned();
            $table->tinyInteger('notificado')->default(0);
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
