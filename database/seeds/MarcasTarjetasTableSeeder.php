<?php

use Illuminate\Database\Seeder;

class MarcasTarjetasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marcas_tarjetas')->insert([
            [
                'nombre' => 'VISA - CREDITO',
                'slug' => 'visacredito',
                'tipo' => 'credito'
            ],
            [
                'nombre' => 'VISA - DEBITO',
                'slug' => 'visadebito',
                'tipo' => 'debito'
            ],
            [
                'nombre' => 'MASTERCARD - CREDITO',
                'slug' => 'mastercredito',
                'tipo' => 'credito'
            ],
            [
                'nombre' => 'MASTERCARD - DEBITO',
                'slug' => 'masterdebito',
                'tipo' => 'debito'
            ],
            [
                'nombre' => 'AMERICAN EXPRESS',
                'slug' => 'amex',
                'tipo' => 'credito'
            ],
            [
                'nombre' => 'CABAL',
                'slug' => 'cabal',
                'tipo' => 'credito'
            ],
            [
                'nombre' => 'DINERS',
                'slug' => 'diners',
                'tipo' => 'credito'
            ],
            [
                'nombre' => 'NARANJA',
                'slug' => 'naranja',
                'tipo' => 'credito'
            ],
            [
                'nombre' => 'NATIVA',
                'slug' => 'nativa',
                'tipo' => 'credito'
            ],
        ]);
    }
}
