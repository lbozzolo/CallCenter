<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomiciliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domicilios', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->string('calle');
            $table->integer('numero');
            $table->tinyInteger('piso');
            $table->string('departamento', 20);
            $table->integer('codigo_postal');
            $table->string('entre_calles');
            $table->integer('localidad_id')->unsigned();
            $table->integer('partido_id')->unsigned();
            $table->integer('provincia_id')->unsigned();

            $table->index('id');
            $table->index('cliente_id');
            $table->index('localidad_id');
            $table->index('partido_id');
            $table->index('provincia_id');
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
        Schema::drop('domicilios');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
