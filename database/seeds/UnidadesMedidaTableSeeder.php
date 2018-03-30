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
            [
                'nombre' => 'mts',
                'slug' => 'mts',
            ],
            [
                'nombre' => 'kg',
                'slug' => 'kg',
            ],
            [
                'nombre' => 'litro',
                'slug' => 'l',
            ],
            [
                'nombre' => 'centímetro',
                'slug' => 'cm',
            ],
        ]);
    }
}
