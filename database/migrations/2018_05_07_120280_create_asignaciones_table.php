<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('supervisor_id')->unsigned();
            $table->integer('operador_id')->unsigned();
            $table->integer('cliente_id')->unsigned();
            $table->integer('motivo_id')->unsigned()->nullable();
            $table->string('observaciones')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->index('id');
            $table->index('supervisor_id');
            $table->index('operador_id');
            $table->index('cliente_id');
            $table->index('motivo_id');
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
        Schema::drop('asignaciones');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
