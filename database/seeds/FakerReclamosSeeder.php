<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use SmartLine\Entities\Reclamo;
use SmartLine\Entities\Venta;
use SmartLine\Entities\Producto;
use SmartLine\Entities\EstadoReclamo;
use SmartLine\User;


class FakerReclamosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createFakerReclamos(25);
    }

    private function createFakerReclamos($cantidad)
    {
        $faker = Faker::create();
        $ventas = Venta::all();
        $productos = Producto::all();
        $estadosReclamos = EstadoReclamo::all();
        $user = User::all();

        for ($i = 0; $i <= $cantidad; $i++) {
            $fecha = $faker->dateTime;
            Reclamo::create([
                'venta_id' => ($ventas->count() > 0)? $ventas->random()->id : null,
                'titulo' => $faker->text(30),
                'descripcion' => $faker->text,
                'producto_id' => ($productos->count() > 0)? $productos->random()->id : null,
                'estado_id' => ($estadosReclamos->count() > 0)? $estadosReclamos->random()->id : null,
                'solucionado' => rand(0, 1),
                'owner_id' => ($user->count() > 0)? $user->random()->id : null,
                'derivador_id' => ($user->count() > 0)? $user->random()->id : null,
                'responsable_id' => ($user->count() > 0)? $user->random()->id : null,
                'created_at' => $fecha,
                'updated_at' => $fecha
            ]);

        }
    }

}
