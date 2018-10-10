<?php

namespace SmartLine\Entities;


class MetodoPagoVenta extends Entity
{
    protected $table = 'metodo_pago_venta';
    protected $fillable = ['venta_id', 'metodopago_id', 'datostarjeta_id'];


    public function datosTarjeta()
    {
        return $this->hasOne(DatoTarjeta::class, 'datostarjeta_id');
    }


}
