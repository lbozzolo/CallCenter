<?php

namespace CallCenter\Entities;

use CallCenter\User;

class EstadoUser extends Entity
{
    protected $table = 'estados_users';


    public function users()
    {
        return $this->hasMany(User::class);
    }

}
