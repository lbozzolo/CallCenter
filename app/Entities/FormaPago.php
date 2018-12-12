<?php

namespace SmartLine\Entities;


class FormaPago extends Entity
{
    protected $table = 'forma_pago';
    protected $fillable = ['marca_tarjeta_id', 'banco_id', 'cuota_cantidad', 'cuota_valor', 'interes', 'descuento'];


    public function ventasAbiertas($id)
    {
        $facturadaId = EstadoVenta::where('slug', 'facturada')->first()->id;
        $metodos = MetodoPagoVenta::where('formadepago_id', $id)->get(['venta_id'])->toArray();
        $ventas = Venta::whereIn('id', $metodos)->where('estado_id', '!=', $facturadaId)->count();

        return $ventas;
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

    public function tarjeta()
    {
        return $this->belongsTo(MarcaTarjeta::class, 'marca_tarjeta_id');
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
        return $this->hasMany(MetodoPagoVenta::class, 'formadepago_id');
    }

    public function updateable()
    {
        return $this->morphMany(Updateable::class, 'updateable');
    }

}
