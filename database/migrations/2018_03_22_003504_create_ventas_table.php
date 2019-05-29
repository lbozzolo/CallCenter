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
            $table->integer('estado_id')->unsigned();
            $table->integer('forma_pago_id')->unsigned()->nullable();
            $table->text('observaciones')->nullable();
            $table->string('numero_guia');
            $table->integer('etapa_id')->unsigned()->nullable();
            $table->integer('promocion_id')->unsigned()->nullable();
            $table->integer('plan_cuotas')->nullable();
            $table->float('ajuste');
            $table->tinyInteger('cobrada')->default(0);
            $table->string('numero_transaccion')->nullable();
            $table->string('motivo')->nullable();
            $table->softDeletes();

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');

            $table->index('id');
            $table->index('user_id');
            $table->index('cliente_id');
            $table->index('estado_id');
            $table->index('forma_pago_id');
            $table->index('etapa_id');
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
