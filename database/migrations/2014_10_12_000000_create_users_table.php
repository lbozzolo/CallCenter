<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->unique();
            $table->string('telefono');
            $table->string('dni');
            $table->integer('imagen_id')->unsigned()->nullable();
            $table->integer('estado_id')->unsigned();
            $table->string('password', 60);
            $table->rememberToken();
            $table->softDeletes();

            $table->timestamps();

            $table->index('id');
            $table->index('email');
            $table->index('estado_id');
            $table->index('imagen_id');

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
        Schema::drop('users');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
