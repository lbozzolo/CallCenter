<?php

namespace SmartLine\Entities;


class MetodoPago extends Entity
{
    protected $table = 'metodo_pago';

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }


}
