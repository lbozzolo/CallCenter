<?php

namespace SmartLine\Entities;


class MetodoPago extends Entity
{
    protected $table = 'metodo_pago';

    public function isCardMethod()
    {
        return ($this->slug == 'credito' || $this->slug == 'debito');
    }

    // Relationships

    public function metodoPagoVenta()
    {
        return $this->hasMany(MetodoPagoVenta::class);
    }

    public function updateable()
    {
        return $this->morphMany(Updateable::class, 'updateable');
    }

}
