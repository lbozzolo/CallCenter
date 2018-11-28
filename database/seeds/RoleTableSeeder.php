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
                'name' => 'Operador IN',
                'slug' => 'operador.in',
                'description' => 'Operador IN de llamadas telefónicas',
                'level' => '1',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'name' => 'Operador OUT',
                'slug' => 'operador.out',
                'description' => 'Operador OUT de llmadas telefónicas',
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
            [
                'name' => 'Logística',
                'slug' => 'logistica',
                'description' => 'Logística',
                'level' => '1',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'name' => 'Facturación',
                'slug' => 'facturacion',
                'description' => 'Facturación',
                'level' => '1',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],
            [
                'name' => 'Atención al cliente',
                'slug' => 'atencion.al.cliente',
                'description' => 'Atención al cliente',
                'level' => '1',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],

        ]);
    }
}
