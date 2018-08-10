<?php

use Illuminate\Database\Seeder;

class ResultadosLlamadasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resultados_llamadas')->insert([
            ['nombre' => 'Rellamar', 'slug' => 'rellamar'],
            ['nombre' => 'Venta', 'slug' => 'venta'],
            ['nombre' => 'No venta', 'slug' => 'no.venta'],
            ['nombre' => 'Nuevo', 'slug' => 'nuevo'],
            ['nombre' => 'No responde', 'slug' => 'no.responde'],
            ['nombre' => 'Dato erróneo', 'slug' => 'dato.erroneo']
        ]);
    }
}
