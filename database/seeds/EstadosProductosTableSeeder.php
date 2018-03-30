<?php

use Illuminate\Database\Seeder;

class EstadosProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados_productos')->insert([
            [
                'nombre' => 'Activo',
                'slug' => 'activo',
            ],
            [
                'nombre' => 'Inactivo',
                'slug' => 'inactivo',
            ],
        ]);
    }
}
