<?php

use Illuminate\Database\Seeder;

class UnidadesMedidaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unidades_medida')->insert([
            ['nombre' => 'unidad', 'slug' => 'unidad'],
            ['nombre' => 'par', 'slug' => 'par'],
            ['nombre' => 'mt', 'slug' => 'mt'],
            ['nombre' => 'mt2', 'slug' => 'mt2'],
            ['nombre' => 'mg', 'slug' => 'mg'],
            ['nombre' => 'gr', 'slug' => 'gr'],
            ['nombre' => 'kg', 'slug' => 'kg'],
            ['nombre' => 'cm3', 'slug' => 'cm3'],
            ['nombre' => 'ml', 'slug' => 'ml'],
            ['nombre' => 'litro', 'slug' => 'l'],
            ['nombre' => 'mm', 'slug' => 'mm'],
            ['nombre' => 'mm3', 'slug' => 'mm3'],
            ['nombre' => 'cm', 'slug' => 'cm'],
            ['nombre' => 'docena', 'slug' => 'docena'],
            ['nombre' => 'pack', 'slug' => 'pack'],
            ['nombre' => 'muestra', 'slug' => 'muestra'],
        ]);
    }

}
