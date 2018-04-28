<?php namespace SmartLine\Http\Repositories;

use Illuminate\Database\Eloquent\SoftDeletes;
use SmartLine\Entities\Venta;
use SmartLine\Entities\EstadoVenta;

class VentaRepo extends BaseRepo
{
    use SoftDeletes;

    public function getModel()
    {
        return new Venta;
    }

    public function getVentasByEstado($estado)
    {
        $ventas = Venta::with('estado')->get()->filter(function ($value) use ($estado) {
            if(!$estado) return $value;
            return $value->estado->slug == $estado;
        });

        $estadoVenta = EstadoVenta::where('slug', $estado)->first();
        $ventas->title = (!$estado)? 'todas' : $estadoVenta->nombre;

        return $ventas;
    }

}
