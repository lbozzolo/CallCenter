<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->insert([

            [
                'name' => 'SuperAdmin',
                'slug' => 'superadmin',
                'description' => 'SuperAdministrador del sistema',
                'level' => '1',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Administrador del sistema',
                'level' => '1',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'name' => 'Operador',
                'slug' => 'operador',
                'description' => 'Operador de llamadas telefónicas',
                'level' => '1',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'name' => 'Auditor',
                'slug' => 'auditor',
                'description' => 'Auditor de las llamadas telefónicas',
                'level' => '1',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'name' => 'Supervisor',
                'slug' => 'supervisor',
                'description' => 'Supervisor de ventas',
                'level' => '1',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],

        ]);
    }
}
