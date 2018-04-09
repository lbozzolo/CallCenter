<?php namespace CallCenter\Http\Repositories;

use Bican\Roles\Models\Permission;
use CallCenter\User;

class PermissionsRepo extends BaseRepo
{
    public function getModel()
    {
        return new Permission;
    }

    public function permissionHasActiveUsers($id)
    {
        $users = User::with(['permissions' => function($query) use ($id){
            $query->where('permissions.id', $id);
        }])->get()->filter(function($user) use ($id){
            foreach($user->permissions as $permission){
                if($permission->id == $id)
                    return $user;
            }
        });
        return ($users->count() > 0)? $users : null;
    }

}
