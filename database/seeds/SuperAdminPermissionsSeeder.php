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
        $superadmin = Role::where('slug', '=', 'superadmin')->first();
        $permissions = Permission::all();

        foreach($permissions as $permission){
            DB::table('permission_role')->insert(['permission_id' => $permission->id, 'role_id' => $superadmin->id]);
        }
        
    }
}
