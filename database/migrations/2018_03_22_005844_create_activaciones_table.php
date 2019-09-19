<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activaciones', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->tinyInteger('estado')->default(0);
            $table->tinyInteger('notificado')->default(0);

            $table->timestamps();

            $table->index('cliente_id');
            $table->index('producto_id');
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
        Schema::drop('activaciones');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
