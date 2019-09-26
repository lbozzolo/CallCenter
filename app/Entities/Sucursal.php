<?php

namespace SmartLine\Entities;

use SmartLine\User;

class Sucursal extends Entity
{
    protected $table = 'sucursales';
    protected $fillable = ['nombre', 'direccion', 'telefono', 'estado'];
    public $timestamps = false;


    public function scopeActive()
    {
        return $this->where('estado', 1);
    }

    // Relationships
    public function users()
    {
        return $this->belongsToMany(User::class, 'sucursales_users');
    }

    public function updateable()
    {
        return $this->morphMany(Updateable::class, 'updateable');
    }

}
