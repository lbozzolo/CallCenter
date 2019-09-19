<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use SmartLine\Entities\Cliente;

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
        $faker = Faker::create('es_AR');

        for ($i = 0; $i <= $cantidad; $i++) {
            $fecha = $faker->dateTime;
            $name = $faker->name;
            $lastname = $faker->lastName;
            $username = str_slug(strtolower($name[0].$lastname));

            Cliente::create([
                'nombre' => $name,
                'apellido' => $lastname,
                'telefono' => $faker->phoneNumber,
                'celular' => $faker->phoneNumber,
                'email' => $faker->email,
                'username' => $username,
                'dni' => rand(20000000, 60000000),
                'referencia' => $faker->text,
                'observaciones' => $faker->text,
                'estado_id' => rand(1, 4),
                'puntos' => rand(0,9000),
                'created_at' => $fecha,
                'updated_at' => $fecha
            ]);

        }
    }
}
