<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReclamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclamos', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('venta_id')->unsigned();
            $table->string('descripcion');
            $table->integer('estado_id')->unsigned();
            $table->tinyInteger('solucionado');
            $table->integer('owner_id')->unsigned();
            $table->integer('derivador_id')->unsigned()->nullable();
            $table->integer('responsable_id')->unsigned();
            $table->softDeletes();

            $table->timestamps();

            $table->index('id');
            $table->index('venta_id');
            $table->index('estado_id');
            $table->index('owner_id');
            $table->index('derivador_id');
            $table->index('responsable_id');
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
        Schema::drop('reclamos');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
