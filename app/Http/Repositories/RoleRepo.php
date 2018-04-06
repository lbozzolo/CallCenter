<?php namespace CallCenter\Http\Repositories;

use Bican\Roles\Models\Role;
use CallCenter\User;

class RoleRepo extends BaseRepo
{
    public function getModel()
    {
        return new Role;
    }

    public function roleHasActiveUsers($id)
    {

        $role = Role::find($id);

        $users = User::with(['roles' => function($query) use ($role){

            $query->where('roles.id', '=', $role->id);

        }])->get()->filter(function($user) use ($role){

            foreach($user->roles as $rol){
                if($rol->id == $role->id){
                    return $user;
                }
            }

        });

        return ($users->count() > 0)? $users : null;

    }


}
