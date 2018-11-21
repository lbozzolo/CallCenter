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

        $estadoVenta = (EstadoVenta::where('slug', $estado)->first())? EstadoVenta::where('slug', $estado)->first()->nombre : 'todas';
        $ventas->title = (!$estado)? 'todas' : $estadoVenta;

        return $ventas;
    }

    public function getVentasFacturadas()
    {
        // Este método incluye también ventas que se enviaron, se entregaron, no se entregaron, o se devolvieron
        $ventas = $this->getVentasByEstado('enviada');
        $ventas = $ventas->merge($this->getVentasByEstado('entregado'));
        $ventas = $ventas->merge($this->getVentasByEstado('noentregado'));
        $ventas = $ventas->merge($this->getVentasByEstado('devuelto'));
        $ventas = $ventas->merge($this->getVentasByEstado('facturada'));

        return $ventas;
    }

    public function getFacturacion()
    {
        $ventas = $this->getVentasFacturadas();
        $total = 0;
        foreach($ventas as $venta){
            $total = $total + $venta->total();
        }
        return $total;
    }

    public function getFacturacionByEstado($estado)
    {
        $ventas = $this->getVentasByEstado($estado);
        $total = 0;
        foreach($ventas as $venta){
            $total = $total + $venta->total();
        }
        return $total;
    }

    public function totalesVentasByEstado()
    {
        $estadosVentas = EstadoVenta::all();
        $total = [];
        foreach($estadosVentas as $estado){
            $ventas = Venta::with('estado')->get()->filter(function ($value) use ($estado) {
                return $value->estado->slug == $estado->slug;
            });

            $total[$estado->slug] = count($ventas);
        }
        return $total;
    }

    public function updateVenta($id, $request)
    {
        $venta = Venta::find($id);

        if($request['etapa_id'] && $request['etapa_id'] != $venta->etapa_id) {
            $venta->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'etapa_id',
                'former_value' => $venta->etapa_id,
                'updated_value' => $request->etapa_id
            ]);
            $venta->etapa_id = ($request->etapa_id)? $request->etapa_id : null;
        }

        if($request['promocion_id'] && $request['promocion_id'] != $venta->promocion_id) {
            $venta->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'promocion_id',
                'former_value' => $venta->promocion_id,
                'updated_value' => $request->promocion_id
            ]);
            $venta->promocion_id = ($request->promocion_id)? $request->promocion_id : null;
        }

        $venta->save();

        return $venta;
    }

}
