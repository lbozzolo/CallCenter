<?php

namespace SmartLine\Entities;

use SmartLine\User;

class EstadoUser extends Entity
{
    protected $table = 'estados_users';


    public function users()
    {
        return $this->hasMany(User::class);
    }

}
