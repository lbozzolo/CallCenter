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
            ['nombre' => 'Programada', 'slug' => 'programada',],
            ['nombre' => 'Cancelada', 'slug' => 'cancelada',],
            ['nombre' => 'Auditable', 'slug' => 'auditable',],
            ['nombre' => 'Confirmada', 'slug' => 'confirmada',],
            ['nombre' => 'Rechazada', 'slug' => 'rechazada',],
            ['nombre' => 'Cobrada', 'slug' => 'cobrada',],
            ['nombre' => 'Facturada', 'slug' => 'facturada',],
            ['nombre' => 'Enviada', 'slug' => 'enviada',],
            ['nombre' => 'Entregado', 'slug' => 'entregado',],
            ['nombre' => 'No entregado', 'slug' => 'noentregado',],
            ['nombre' => 'Devuelto', 'slug' => 'devuelto',],
            ['nombre' => 'Desconocimiento', 'slug' => 'desconocimiento']
        ]);
    }
}
