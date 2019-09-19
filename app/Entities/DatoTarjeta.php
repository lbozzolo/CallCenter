<?php

namespace SmartLine\Entities;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DatoTarjeta extends Entity
{
    protected $table = 'datos_tarjeta';
    protected $fillable = ['marca_id', 'tipo_tarjeta', 'banco_id', 'numero_tarjeta', 'fecha_expiracion', 'titular', 'codigo_seguridad', 'created_at', 'updated_at'];

    // Mutators

    public function getCardNumberAttribute()
    {
        // Número válido de ejemplo: 5370517873215895
        $user = Auth::user();
        $tarjeta = $this->numero_tarjeta;
        $encrypted_card_number = substr($tarjeta, 0, 4) . str_repeat('X', strlen($tarjeta) - 8) . substr($tarjeta, -4);

        if(!$user->canDo('visualizar.numero.tarjeta'))
            return $encrypted_card_number;

        return $tarjeta;
    }

    public function getSecurityNumberAttribute()
    {
        $user = Auth::user();
        $codigoSeguridad = $this->codigo_seguridad;

        if(!$user->canDo('visualizar.numero.tarjeta'))
            return 'XXX';

        return $codigoSeguridad;
    }

    public function isExpired()
    {
        //$fecha_expiracion = Carbon::parse($this->fecha_expiracion)->format('m/Y');
        //$today = Carbon::today()->format('m/Y');
        $fecha_expiracion = Carbon::parse($this->fecha_expiracion);
        $today = Carbon::today();

        return $fecha_expiracion <= $today;
    }

    public function getExpirationDateAttribute()
    {
        return date("m/Y", strtotime($this->fecha_expiracion));
    }

    // Relationships

    public function marca()
    {
        return $this->belongsTo(MarcaTarjeta::class);
    }

    public function metodoPagoVenta()
    {
        return $this->hasMany(MetodoPagoVenta::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function formaPago()
    {
        return $this->belongsTo(FormaPago::class, 'forma_pago_id');
    }

    public function banco()
    {
        return $this->belongsTo(Banco::class);
    }

    public function metodoPago()
    {
        return $this->hasMany(MetodoPagoVenta::class);
    }

    public function updateable()
    {
        return $this->morphMany(Updateable::class, 'updateable');
    }

}
