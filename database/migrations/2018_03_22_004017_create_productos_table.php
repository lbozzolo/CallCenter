<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->dateTime('fecha_inicio')->nullable();
            $table->dateTime('fecha_finalizacion')->nullable();
            $table->integer('estado_id')->unsigned();
            $table->integer('unidad_medida_id')->unsigned()->nullable();
            $table->integer('cantidad_medida');
            $table->integer('stock');
            $table->integer('alerta_stock');
            $table->integer('marca_id')->unsigned()->nullable();
            $table->integer('precio');
            $table->integer('etapa_id')->unsigned()->nullable();
            $table->integer('institucion_id')->unsigned()->nullable();
            $table->softDeletes();

            $table->timestamps();

            $table->index('id');
            $table->index('estado_id');
            $table->index('unidad_medida_id');
            $table->index('marca_id');
            $table->index('etapa_id');
            $table->index('institucion_id');
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
        Schema::drop('productos');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
