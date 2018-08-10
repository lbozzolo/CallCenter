<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use SmartLine\User;
use Bican\Roles\Models\Role;

class UsuariosDePruebaSeeder extends Seeder
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
                'nombre' => 'admin',
                'email' => 'admin@mail.com',
                'estado_id' => '1',
                'password' => bcrypt('1234'),
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'nombre' => 'operador',
                'email' => 'operador@mail.com',
                'estado_id' => '1',
                'password' => bcrypt('1234'),
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'nombre' => 'auditor',
                'email' => 'auditor@mail.com',
                'estado_id' => '1',
                'password' => bcrypt('1234'),
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'nombre' => 'supervisor',
                'email' => 'supervisor@mail.com',
                'estado_id' => '1',
                'password' => bcrypt('1234'),
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
        ]);

        $adminUser = User::where('email', '=', 'admin@mail.com')->first();
        $operadorUser = User::where('email', '=', 'operador@mail.com')->first();
        $auditorUser = User::where('email', '=', 'auditor@mail.com')->first();
        $supervisorUser = User::where('email', '=', 'supervisor@mail.com')->first();

        $admin = Role::where('slug', '=', 'admin')->first();
        $operador = Role::where('slug', '=', 'operador')->first();
        $auditor = Role::where('slug', '=', 'auditor')->first();
        $supervisor = Role::where('slug', '=', 'supervisor')->first();

        $adminUser->attachRole($admin->id);
        $operadorUser->attachRole($operador->id);
        $auditorUser->attachRole($auditor->id);
        $supervisorUser->attachRole($supervisor->id);
    }
}
