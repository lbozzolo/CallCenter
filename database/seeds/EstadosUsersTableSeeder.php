<?php

use Illuminate\Database\Seeder;

class EstadosUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados_users')->insert([
            [
                'nombre' => 'Habilitado',
                'slug' => 'habilitado'
            ],
            [
                'nombre' => 'Deshabilitado',
                'slug' => 'deshabilitado'
            ],
        ]);
    }
}
