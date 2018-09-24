<?php

namespace SmartLine\Entities;

use SmartLine\User;
use SmartLine\Entities\Cliente;

class Asignacion extends Entity
{
    protected $table = 'asignaciones';
    protected $fillable = ['supervisor_id', 'operador_id', 'cliente_id'];
    protected $dates = ['deleted_at'];

    // Relationships

    public function supervisor()
    {
        return $this->belongsTo(User::class);
    }

    public function operador()
    {
        return $this->belongsTo(User::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

}
