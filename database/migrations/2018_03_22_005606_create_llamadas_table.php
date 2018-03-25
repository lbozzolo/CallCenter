<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLlamadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('llamadas', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('resultado_id')->unsigned();
            $table->integer('venta_id')->unsigned()->nullable();
            $table->tinyInteger('tipo_llamada');
            $table->string('observaciones');
            $table->softDeletes();

            $table->timestamps();

            $table->index('id');
            $table->index('cliente_id');
            $table->index('user_id');
            $table->index('resultado_id');
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
        Schema::drop('llamadas');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
