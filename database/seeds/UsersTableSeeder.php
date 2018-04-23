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
                'email' => 'lucas@bamdig.com',
                'telefono' => '1163583276',
                'dni' => '26966447',
                'estado_id' => '1',
                'password' => bcrypt('golf'),
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'nombre' => 'Tomás',
                'apellido' => 'Milgrond',
                'email' => 'tomas@bamdig.com',
                'telefono' => '',
                'dni' => '',
                'estado_id' => '1',
                'password' => bcrypt('1234'),
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'nombre' => 'Fernando',
                'apellido' => 'Alfonso',
                'email' => 'fernando@bamdig.com',
                'telefono' => '',
                'dni' => '',
                'estado_id' => '1',
                'password' => bcrypt('1234'),
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
        ]);

        $lucas = User::where('email', '=', 'lucas@bamdig.com')->first();
        $tomy = User::where('email', '=', 'tomas@bamdig.com')->first();
        $pelado = User::where('email', '=', 'fernando@bamdig.com')->first();

        $superAdmin = Role::where('slug', '=', 'superadmin')->first();
        $lucas->roles()->attach($superAdmin);
        $tomy->roles()->attach($superAdmin);
        $pelado->roles()->attach($superAdmin);
        

    }

}
