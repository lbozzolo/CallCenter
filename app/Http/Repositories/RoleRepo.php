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
        $users = User::with(['roles' => function($query) use ($id){
            $query->where('roles.id', $id);
        }])->get()->filter(function($user) use ($id){
            foreach($user->roles as $rol){
                if($rol->id == $id)
                    return $user;
            }
        });
        return ($users->count() > 0)? $users : null;
    }

    public function setToSlug($slug, $name)
    {
        return ($slug)? str_slug(strtolower($slug), '.') : str_slug(strtolower($name), '.');
    }

    public function listWithoutLastComma($user)
    {
        return implode(', ', array_map(function($a){return $a['name'];}, $user->roles->toArray()));
    }

}
