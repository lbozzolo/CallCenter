d<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpdateablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('updateables', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id');
            $table->integer('updateable_id');
            $table->string('updateable_type');
            $table->string('field');
            $table->string('former_value');
            $table->string('updated_value');
            $table->string('reason')->nullable();

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
        Schema::drop('updateables');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
