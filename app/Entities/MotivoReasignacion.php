<?php

namespace SmartLine\Entities;

use SmartLine\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use SmartLine\Entities\Cliente;
use Carbon\Carbon;

class MotivoReasignacion extends Entity
{
    protected $table = 'motivos_reasignaciones';
    protected $fillable = ['motivo'];

    // Relationships

    public function asignacion()
    {
        return $this->hasMany(Asignacion::class);
    }

    public function updateable()
    {
        return $this->morphMany(Updateable::class, 'updateable');
    }

}
