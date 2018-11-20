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
            $table->integer('related_model_id')->nullable();
            $table->string('related_model_type')->nullable();
            $table->string('action')->nullable();
            $table->string('field')->nullable();
            $table->string('former_value')->nullable();
            $table->string('updated_value')->nullable();
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
