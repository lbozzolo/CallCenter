<?php

namespace SmartLine\Entities;

class EstadoVenta extends Entity
{
    protected $table = 'estados_ventas';


    public function getEstadoPluralAttribute()
    {
        return config('sistema.ventas.estados.'.$this->slug);
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

    public function updateable()
    {
        return $this->morphMany(Updateable::class, 'updateable');
    }

}
