<?php

namespace SmartLine\Entities;

use SmartLine\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asignacion extends Entity
{
    use SoftDeletes;

    protected $table = 'asignaciones';
    protected $fillable = ['supervisor_id', 'operador_id', 'cliente_id', 'motivo_id', 'observaciones'];
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

    public function motivo()
    {
        return $this->belongsTo(MotivoReasignacion::class);
    }

    public function updateable()
    {
        return $this->morphMany(Updateable::class, 'updateable');
    }

}
