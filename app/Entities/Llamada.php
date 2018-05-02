<?php

namespace SmartLine\Entities;

use SmartLine\User;

class Llamada extends Entity
{
    protected $table = 'llamadas';
    protected $fillable = ['cliente_id', 'user_id', 'resultado_id', 'venta_id', 'reclamo_id', 'tipo_llamada', 'url', 'observaciones', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function resultado()
    {
        return $this->belongsTo(ResultadoLlamada::class);
    }

    public function venta()
    {
        return $this->hasOne(Venta::class, 'id');
    }

    public function reclamo()
    {
        return $this->belongsTo(Reclamo::class, 'id');
    }

}
