<?php namespace SmartLine\Http\Repositories;

use SmartLine\Entities\MarcaTarjeta;

class MarcaTarjetaRepo extends BaseRepo
{

    public function getModel()
    {
        return new MarcaTarjeta;
    }


    public function hasCuotas($marcaId, $cuotas)
    {
        $tarjeta = $this->findOrFail($marcaId);

        $result = $tarjeta->formasPago->filter(function($item) use ($cuotas){
            return $item->cuota_cantidad == $cuotas;
        });

        return $result;
    }


}
