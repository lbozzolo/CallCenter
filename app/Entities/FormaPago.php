<?php

namespace SmartLine\Entities;


class FormaPago extends Entity
{
    protected $table = 'forma_pago';


    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }


}
