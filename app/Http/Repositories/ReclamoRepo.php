<?php namespace SmartLine\Http\Repositories;

use Illuminate\Support\Facades\Auth;
use SmartLine\Entities\EstadoReclamo;
use SmartLine\Entities\Reclamo;
use SmartLine\Entities\Venta;

class ReclamoRepo extends BaseRepo
{
    public function getModel()
    {
        return new Reclamo;
    }

    public function reclamosOperador($estado)
    {
        $ventas = Venta::has('reclamos')->where('user_id', Auth::user()->id)->get();
        $estadoReclamo = ($estado)? EstadoReclamo::where('slug', $estado)->first() : EstadoReclamo::where('slug', 'abierto')->first();

        $reclamos = collect();

        foreach($ventas as $venta){
            foreach($venta->reclamos as $reclamo){
                if($reclamo->estado_id == $estadoReclamo->id)
                    $reclamos->push($reclamo);
            }
        }

        return $reclamos;
    }


}
