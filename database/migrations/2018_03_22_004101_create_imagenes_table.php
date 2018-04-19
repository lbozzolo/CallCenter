<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagenes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path');
            $table->string('title');
            $table->integer('imageable_id');
            $table->string('imageable_type');
            $table->tinyInteger('principal')->default(0);

            $table->softDeletes();
            $table->timestamps();

            $table->index('id');
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
        Schema::drop('imagenes');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
