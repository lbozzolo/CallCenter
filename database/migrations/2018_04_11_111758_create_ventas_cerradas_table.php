<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasCerradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_cerradas', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('venta_id')->unsigned();
            $table->string('user_fullname');
            $table->string('cliente_fullname');
            $table->string('dni');
            $table->string('cuit')->nullable();
            $table->string('cuil')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('importe');
            $table->string('calle')->nullable();
            $table->string('numero')->nullable();
            $table->string('piso')->nullable();
            $table->string('departamento')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->string('entre_calles')->nullable();
            $table->string('barrio')->nullable();
            $table->string('localidad')->nullable();
            $table->string('partido')->nullable();
            $table->string('provincia')->nullable();

            $table->softDeletes();

            $table->timestamps();

            $table->index('id');
            $table->index('user_fullname');
            $table->index('cliente_fullname');
            $table->index('dni');
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
        Schema::drop('ventas_cerradas');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
