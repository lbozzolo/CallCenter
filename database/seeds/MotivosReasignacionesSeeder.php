<?php

use Illuminate\Database\Seeder;

class MotivosReasignacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('motivos_reasignaciones')->insert([
            ['motivo' => 'no responde'],
            ['motivo' => 'programado'],
            ['motivo' => 'teléfono incorrecto'],
            ['motivo' => 'reasignar TM'],
            ['motivo' => 'reasignar TT'],
        ]);
    }
}
