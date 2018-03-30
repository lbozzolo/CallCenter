<?php

use Illuminate\Database\Seeder;

class EstadosInstitucionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados_instituciones')->insert([
            [
                'nombre' => 'Activa',
                'slug' => 'activa',
            ],
            [
                'nombre' => 'Inactiva',
                'slug' => 'inactiva',
            ],
        ]);
    }
}
