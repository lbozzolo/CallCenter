<?php

namespace SmartLine\Entities;


class Partido extends Entity
{
    protected $table = 'tbl_partidos';

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function localidades()
    {
        return $this->hasMany(Localidad::class);
    }

    public function domicilios()
    {
        return $this->hasMany(Domicilio::class);
    }

}
