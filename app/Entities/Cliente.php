<?php

namespace CallCenter\Entities;

class Cliente extends Entity
{
    protected $table = 'clientes';
    protected $fillable = ['nombre', 'apellido', 'direccion', 'telefono', 'celular', 'email', 'dni', 'referencia', 'observaciones', 'puntos', 'estado_id', 'created_at', 'updated_at'];

    public function getFullNameAttribute()
    {
        return $this->nombre.' '.$this->apellido;
    }

    public function estado()
    {
        return $this->belongsTo(EstadoCliente::class);
    }

}
