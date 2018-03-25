<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtapasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etapas', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('nombre');
            $table->integer('dias_pendiente');
            $table->integer('etapa_anterior_id')->unsigned()->nullable();
            $table->integer('etapa_proxima_id')->unsigned()->nullable();

            $table->index('id');
            $table->index('etapa_anterior_id');
            $table->index('etapa_proxima_id');
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
        Schema::drop('etapas');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
