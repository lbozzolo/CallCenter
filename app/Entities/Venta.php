<?php

namespace SmartLine\Entities;


class Venta extends Entity
{
    protected $table = 'ventas';


    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function llamada()
    {
        return $this->belongsTo(Llamada::class);
    }

}
