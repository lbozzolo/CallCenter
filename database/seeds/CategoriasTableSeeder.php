<?php

use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            ['nombre' => 'Fitness', 'slug' => 'fitness',],
            ['nombre' => 'Cuidado Personal', 'slug' => 'cuidado.personal',],
            ['nombre' => 'Salud', 'slug' => 'salud',],
            ['nombre' => 'Cocina', 'slug' => 'cocina',],
            ['nombre' => 'Sexual', 'slug' => 'sexual',],
            ['nombre' => 'Electrónica', 'slug' => 'electronica',],
            ['nombre' => 'Promociones', 'slug' => 'promociones',],
        ]);
    }

}
