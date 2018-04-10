<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use CallCenter\Entities\Cliente;

class FakerClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createFakerClientes(25);
    }

    private function createFakerClientes($cantidad)
    {
        $faker = Faker::create();

        for ($i = 0; $i <= $cantidad; $i++) {
            $fecha = $faker->dateTime;
            Cliente::create([
                'nombre' => $faker->name,
                'apellido' => $faker->lastName,
                'direccion' => $faker->address,
                'telefono' => $faker->phoneNumber,
                'celular' => $faker->phoneNumber,
                'email' => $faker->email,
                'dni' => rand(20000000, 60000000),
                'referencia' => $faker->text,
                'observaciones' => $faker->text,
                'estado_id' => rand(1, 2),
                'puntos' => rand(0,9000),
                'created_at' => $fecha,
                'updated_at' => $fecha
            ]);

        }
    }
}
