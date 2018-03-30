<?php

use Illuminate\Database\Seeder;

class EstadosReclamosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados_reclamos')->insert([
            [
                'nombre' => 'Abierto',
                'slug' => 'abierto',
            ],
            [
                'nombre' => 'Cerrado',
                'slug' => 'cerrado',
            ],
        ]);
    }
}
