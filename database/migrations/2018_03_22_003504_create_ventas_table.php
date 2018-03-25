<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('cliente_id')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->integer('estado_id')->unsigned();
            $table->integer('metodo_pago_id')->unsigned();
            $table->integer('forma_pago_id')->unsigned();
            $table->integer('promocion_id')->unsigned()->nullable();
            $table->softDeletes();

            $table->timestamps();

            $table->index('id');
            $table->index('user_id');
            $table->index('cliente_id');
            $table->index('producto_id');
            $table->index('estado_id');
            $table->index('metodo_pago_id');
            $table->index('forma_pago_id');
            $table->index('promocion_id');
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
        Schema::drop('ventas');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
