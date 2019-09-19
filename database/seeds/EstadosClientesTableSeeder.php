<?php

use Illuminate\Database\Seeder;

class EstadosClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados_clientes')->insert([
            [
                'nombre' => 'Nuevo',
                'slug' => 'nuevo',
            ],
            [
                'nombre' => 'Frecuente',
                'slug' => 'frecuente',
            ],
            [
                'nombre' => 'Habilitado',
                'slug' => 'habilitado',
            ],
            [
                'nombre' => 'Deshabilitado',
                'slug' => 'deshabilitado',
            ],
        ]);
    }
}
