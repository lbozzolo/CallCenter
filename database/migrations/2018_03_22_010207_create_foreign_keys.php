<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table){
            $table->foreign('estado_id')
                ->references('id')
                ->on('estados_users')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });

        Schema::table('ventas', function(Blueprint $table){
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('producto_id')
                ->references('id')
                ->on('productos')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('estado_id')
                ->references('id')
                ->on('estados_users')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('metodo_pago_id')
                ->references('id')
                ->on('metodo_pago')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('forma_pago_id')
                ->references('id')
                ->on('forma_pago')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('promocion_id')
                ->references('id')
                ->on('promociones')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });

        Schema::table('metodo_pago', function(Blueprint $table){
            $table->foreign('banco_id')
                ->references('id')
                ->on('bancos')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });

        Schema::table('etapas', function(Blueprint $table){
            $table->foreign('etapa_anterior_id')
                ->references('id')
                ->on('etapas')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('etapa_proxima_id')
                ->references('id')
                ->on('etapas')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });

        Schema::table('categorias', function(Blueprint $table){
            $table->foreign('parent_id')
                ->references('id')
                ->on('categorias')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });

        Schema::table('productos', function(Blueprint $table){
            $table->foreign('estado_id')
                ->references('id')
                ->on('estados_productos')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('unidad_medida_id')
                ->references('id')
                ->on('unidades_medida')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });

        Schema::table('imagen_producto', function(Blueprint $table){
            $table->foreign('imagen_id')
                ->references('id')
                ->on('imagenes')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('producto_id')
                ->references('id')
                ->on('productos')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });

        Schema::table('categoria_producto', function(Blueprint $table){
            $table->foreign('categoria_id')
                ->references('id')
                ->on('categorias')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('producto_id')
                ->references('id')
                ->on('productos')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });

        Schema::table('llamadas', function(Blueprint $table){
            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('resultado_id')
                ->references('id')
                ->on('resultados_llamadas')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('venta_id')
                ->references('id')
                ->on('ventas')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });

        Schema::table('reclamos', function(Blueprint $table){
            $table->foreign('venta_id')
                ->references('id')
                ->on('ventas')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('estado_id')
                ->references('id')
                ->on('estados_reclamos')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('owner_id')
                ->references('id')
                ->on('users')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('derivador_id')
                ->references('id')
                ->on('users')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('responsable_id')
                ->references('id')
                ->on('users')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });

        Schema::table('instituciones', function(Blueprint $table){
            $table->foreign('estado_id')
                ->references('id')
                ->on('estados_instituciones')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });

        Schema::table('categoria_institucion', function(Blueprint $table){
            $table->foreign('categoria_id')
                ->references('id')
                ->on('categorias')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('institucion_id')
                ->references('id')
                ->on('instituciones')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });

        Schema::table('clientes', function(Blueprint $table){
            $table->foreign('estado_id')
                ->references('id')
                ->on('estados_clientes')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });

        Schema::table('categoria_cliente', function(Blueprint $table){
            $table->foreign('categoria_id')
                ->references('id')
                ->on('categorias')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}