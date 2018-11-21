<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosTicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados_tickets')->insert([
            ['nombre' => 'Abierto', 'slug' => 'abierto'],
            ['nombre' => 'Cerrado', 'slug' => 'cerrado'],
        ]);
    }
}
