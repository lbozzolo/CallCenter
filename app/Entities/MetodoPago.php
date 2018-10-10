<?php

namespace SmartLine\Entities;


class MetodoPago extends Entity
{
    protected $table = 'metodo_pago';

    public function ventas()
    {
        return $this->belongsToMany(Venta::class, 'metodo_pago_venta', 'metodopago_id', 'venta_id');
    }


}
