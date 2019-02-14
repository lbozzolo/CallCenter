<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;
use Illuminate\Support\Facades\DB;

class SuperAdminPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$superadmin = Role::where('slug', '=', 'superadmin')->first();

        $roles = Role::all();
        $permissions = Permission::all();

        foreach($roles as $role){
            foreach($permissions as $permission){
                DB::table('permission_role')->insert(['permission_id' => $permission->id, 'role_id' => $role->id]);
            }
        }
        
    }
}
