<?php

namespace SmartLine\Entities;


class Promocion extends Entity
{
    protected $table = 'promociones';


    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

}
