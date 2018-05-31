<?php

namespace SmartLine\Entities;

use SmartLine\User;

class Venta extends Entity
{
    protected $table = 'ventas';
    protected $fillable = ['user_id', 'cliente_id', 'producto_id', 'estado_id', 'metodo_pago_id', 'forma_pago_id', 'observaciones', 'etapa_id', 'promocion_id', 'created_at', 'updated_at'];


    public function getEstadoPluralAttribute()
    {
        return config('sistema.ventas.estados.'.$this->estado->slug);
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function estado()
    {
        return $this->belongsTo(EstadoVenta::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function llamada()
    {
        return $this->belongsTo(Llamada::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class);
    }

    public function formaPago()
    {
        return $this->belongsTo(FormaPago::class);
    }

    public function datosTarjeta()
    {
        return $this->hasOne(DatoTarjeta::class);
    }

    public function promocion()
    {
        return $this->belongsTo(Promocion::class);
    }

    public function etapa()
    {
        return $this->belongsTo(Etapa::class);
    }

    public function reclamos()
    {
        return $this->hasMany(Reclamo::class);
    }

}
