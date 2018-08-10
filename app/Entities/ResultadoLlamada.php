<?php

namespace SmartLine\Entities;


class ResultadoLlamada extends Entity
{
    protected $table = 'resultados_llamadas';


    public function llamadas()
    {
        return $this->hasMany(Llamada::class);
    }

}
