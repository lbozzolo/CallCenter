<?php

namespace SmartLine\Entities;

class EstadoVenta extends Entity
{
    protected $table = 'estados_ventas';


    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

}
