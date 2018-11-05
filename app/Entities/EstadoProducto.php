<?php

namespace SmartLine\Entities;


class EstadoProducto extends Entity
{
    protected $table = 'estados_productos';


    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function updateable()
    {
        return $this->morphMany(Updateable::class, 'updateable');
    }

}
