<?php

use Illuminate\Database\Seeder;

class BancosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bancos = config('sistema.bancos.principales');
        DB::table('bancos')->insert($bancos);
    }
}
