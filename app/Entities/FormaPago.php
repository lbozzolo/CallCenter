<?php

namespace SmartLine\Entities;


class FormaPago extends Entity
{
    protected $table = 'forma_pago';
    protected $fillable = ['marca_tarjeta_id', 'banco_id', 'cuota_cantidad', 'cuota_valor', 'interes', 'descuento'];

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

    public function tarjeta()
    {
        return $this->belongsTo(Marca::class);
    }

    public function banco()
    {
        return $this->belongsTo(Banco::class);
    }

    public function datosTarjeta()
    {
        return $this->hasMany(DatoTarjeta::class);
    }

    public function metodoPagoVenta()
    {
        return $this->hasMany(MetodoPagoVenta::class);
    }

    public function updateable()
    {
        return $this->morphMany(Updateable::class, 'updateable');
    }

}
