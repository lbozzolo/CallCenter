<?php

namespace SmartLine\Entities;

class Domicilio extends Entity
{
    protected $table = 'domicilios';
    protected $fillable = ['cliente_id', 'calle', 'numero', 'piso', 'departamento', 'codigo_postal', 'entre_calles', 'barrio', 'localidad_id', 'partido_id', 'provincia_id'];
    public $timestamps = false;


    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }

    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }

    public function updateable()
    {
        return $this->morphMany(Updateable::class, 'updateable');
    }

}
