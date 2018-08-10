<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblLocalidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_localidades', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('idLocalidad');
            $table->string('localidad');
            $table->string('codProvincia', 4);
            $table->integer('idPartido');

            $table->index('id');
            $table->index('idLocalidad');
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
        Schema::drop('tbl_localidades');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
