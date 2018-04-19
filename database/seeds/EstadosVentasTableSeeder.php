<?php

use Illuminate\Database\Seeder;

class EstadosVentasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados_ventas')->insert([
            ['nombre' => 'Iniciada', 'slug' => 'iniciada',],
            ['nombre' => 'Auditada', 'slug' => 'auditada',],
            ['nombre' => 'Confirmada', 'slug' => 'confirmada',],
            ['nombre' => 'Rechazada', 'slug' => 'rechazada',],
            ['nombre' => 'Cobrada', 'slug' => 'cobrada',],
            ['nombre' => 'Facturada', 'slug' => 'facturada',],
            ['nombre' => 'Enviada', 'slug' => 'enviada',],
            ['nombre' => 'Entregado', 'slug' => 'entregado',],
            ['nombre' => 'No entregado', 'slug' => 'no.entragado',],
            ['nombre' => 'Devuelto', 'slug' => 'devuelto',]
        ]);
    }
}
