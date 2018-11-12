<?php

namespace SmartLine\Entities;

use Bican\Roles\Models\Role;

class Destinatario extends Entity
{
    protected $table = 'destinatarios';
    protected $fillable = ['role_id', 'noticia_id'];


    // Relationships

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function noticia()
    {
        return $this->belongsTo(Noticia::class);
    }

}