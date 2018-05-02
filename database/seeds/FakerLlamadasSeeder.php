<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use SmartLine\Entities\Llamada;
use SmartLine\Entities\Cliente;
use SmartLine\User;
use SmartLine\Entities\ResultadoLlamada;
use SmartLine\Entities\Venta;
use SmartLine\Entities\Reclamo;

class FakerLlamadasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createFakerLlamadas(26);
    }

    private function createFakerLlamadas($cantidad)
    {
        $faker = Faker::create();
        $clientes = Cliente::all();
        $ventas = Venta::all();
        $users = User::all();
        $resultados = ResultadoLlamada::all();
        $reclamos = Reclamo::all();

        for ($i = 0; $i <= $cantidad; $i++) {
            $fecha = $faker->dateTime;
            Llamada::create([
                'cliente_id' => ($clientes->count() != 0)? $clientes->random()->id : null,
                'user_id' => ($users->count() != 0)? $users->random()->id : null,
                'resultado_id' => ($resultados->count() != 0)? $resultados->random()->id : null,
                'venta_id' => ($i <= ($cantidad / 2))? $ventas->random()->id : null,
                'reclamo_id' => ($i > ($cantidad / 2))? $reclamos->random()->id : null,
                'tipo_llamada' => rand(0,1),
                'url' => $faker->word.'.'.$faker->fileExtension,
                'observaciones' => $faker->text,
                'created_at' => $fecha,
                'updated_at' => $fecha
            ]);

        }
    }
}
