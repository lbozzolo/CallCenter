<?php

namespace SmartLine\Entities;
use Illuminate\Support\Facades\Auth;

class DatoTarjeta extends Entity
{
    protected $table = 'datos_tarjeta';
    protected $fillable = ['marca_id', 'tipo_tarjeta', 'banco_id', 'numero_tarjeta', 'fecha_expiracion', 'titular', 'codigo_seguridad', 'created_at', 'updated_at'];
    protected $touches = ['venta'];

    // Mutators

    public function getCardNumberAttribute()
    {
        // Número válido de ejemplo: 5370517873215895
        $user = Auth::user();
        $tarjeta = $this->numero_tarjeta;
        $encrypted_card = substr($tarjeta, 0, 4) . str_repeat('X', strlen($tarjeta) - 8) . substr($tarjeta, -4);

        if(!$user->canDo('ver.datos.de.tarjeta'))
            return $encrypted_card;

        return $tarjeta;
    }

    public function getSecurityNumberAttribute()
    {
        $user = Auth::user();
        $codigoSeguridad = $this->codigo_seguridad;

        if(!$user->canDo('ver.datos.de.tarjeta'))
            return 'XXX';

        return $codigoSeguridad;
    }

    public function getExpirationDateAttribute()
    {
        return date("d/m/Y", strtotime($this->fecha_expiracion));
    }

    // Relationships

    public function marca()
    {
        return $this->belongsTo(MarcaTarjeta::class);
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function formaPago()
    {
        return $this->belongsTo(FormaPago::class, 'forma_pago_id');
    }

    public function banco()
    {
        return $this->belongsTo(Banco::class);
    }

}
