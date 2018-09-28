<?php

namespace SmartLine\Entities;

use SmartLine\User;

class Noticia extends Entity
{
    protected $table = 'noticias';
    protected $fillable = ['user_id', 'titulo', 'descripcion'];


    // Relationships

    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}