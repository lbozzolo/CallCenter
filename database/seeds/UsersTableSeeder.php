<?php

use Illuminate\Database\Seeder;
use SmartLine\User;
use Bican\Roles\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'nombre' => 'Lucas',
                'apellido' => 'Bozzolo',
                'email' => 'lucas@verticedigital.com.ar',
                'telefono' => '1163583276',
                'dni' => '26966447',
                'estado_id' => '1',
                'password' => bcrypt('golf'),
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'nombre' => 'Fernando',
                'apellido' => 'Alfonso',
                'email' => 'fernando@verticedigital.com.ar',
                'telefono' => '',
                'dni' => '',
                'estado_id' => '1',
                'password' => bcrypt('1234'),
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
        ]);

        $lucas = User::where('email', '=', 'lucas@verticedigital.com.ar')->first();
        $pelado = User::where('email', '=', 'fernando@verticedigital.com.ar')->first();

        $superAdmin = Role::where('slug', '=', 'superadmin')->first();
        $lucas->attachRole($superAdmin->id);
        $pelado->attachRole($superAdmin->id);

    }

}
