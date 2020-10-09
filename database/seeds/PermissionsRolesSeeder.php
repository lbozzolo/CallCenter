<?php

use Illuminate\Database\Seeder;

class PermissionsRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::unprepared(
            File::get(
                storage_path('app/database/permission_role_table.sql')
            )
        );
        $data = [];
        $roles = ['admin' => 'admin', 'operadorIn' => 'operador.in', 'operadorOut' => 'operador.out', 'auditor' => 'auditor', 'supervisor' => 'supervisor', 'logistica' => 'logistica', 'facturacion' => 'facturacion', 'atencionCliente' => 'atencion.al.cliente'];
        $permissionsFlatten = config('sistema.permission-flatten');

        foreach($roles as $name => $slug){

            $role = \Bican\Roles\Models\Role::where('slug', $slug)->first();
            $slugged = str_replace(".","-",$slug);
            $permissions = $permissionsFlatten;
            $deniedPermissions = config('sistema.permissions-roles.'.$slugged);

            foreach ($deniedPermissions as $key => $value) {
                unset($permissions[array_search($value, $permissions)]);
            }

            $data['permissions'][$slug] = $permissions;

            foreach($data['permissions'][$slug] as $permissionSlug){
                $permissionId = \Bican\Roles\Models\Permission::where('slug', $permissionSlug)->first()->id;
                DB::table('permission_role')->insert([
                    'permission_id' => $permissionId,
                    'role_id' => $role->id
                ]);
            }

        }

    }

}
