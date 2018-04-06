<?php

use Illuminate\Database\Seeder;
use CallCenter\User;
use Bican\Roles\Models\Role;
use Faker\Factory as Faker;

class FakerUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createFakerUsers(25);
    }

    private function createFakerUsers($cantidad)
    {
        $roles = Role::all();
        $faker = Faker::create();
        $superAdmin = Role::where('slug', '=', 'superadmin')->first();

        for ($i = 0; $i <= $cantidad; $i++) {
            $user = User::create([
                'nombre' => $faker->name,
                'apellido' => $faker->lastName,
                'email' => $faker->email,
                'telefono' => $faker->phoneNumber,
                'dni' => rand(20000000,60000000),
                'estado_id' => '1',
                'password' => bcrypt('1234'),
            ]);

            $user->attachRole($roles->except($superAdmin->id)->random());
        }
    }
}
