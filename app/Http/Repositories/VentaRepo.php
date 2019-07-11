<?php namespace SmartLine\Http\Repositories;

use Illuminate\Database\Eloquent\SoftDeletes;
use SmartLine\Entities\Venta;
use SmartLine\Entities\EstadoVenta;
use SmartLine\Entities\VentaCerrada;
use SmartLine\Entities\VentaCerradaProducto;
use Illuminate\Support\Facades\Auth;

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
        $ventas->title = (!$estado)? 'todas' : $estadoVenta.'s';

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
        $ventas->title = 'todas';

        return $ventas;
    }

    public function facturacion()
    {
        $ventas = $this->getVentasFacturadas();
        $total = 0;
        foreach($ventas as $venta){
            $total = $total + $venta->total();
        }
        return $total;
    }

    public function getFacturacion()
    {
        return number_format($this->facturacion(), 0, ',', '.');
    }

    public function facturacionByEstado($estado)
    {
        $ventas = $this->getVentasByEstado($estado);
        $total = 0;
        foreach($ventas as $venta){
            $total = $total + $venta->total();
        }
        return $total;
    }

    public function getFacturacionByEstado($estado)
    {
        return number_format($this->facturacionByEstado($estado), 0, ',', '.');
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

    public function cerrarVenta($id)
    {
        $venta = Venta::with(['cliente', 'cliente.domicilio', 'productos'])->find($id);

        if(count($venta->etapas)){
            $venta->etapa_id = $venta->etapas()->first()->id;
            $venta->save();
        }

        $cliente = $venta->cliente;
        $domicilio = $cliente->domicilio;
        $productos = $venta->productos;

        $ventaCerrada = VentaCerrada::create([
            'venta_id' => $venta->id,
            'user_fullname' => $venta->user->fullname,
            'cliente_fullname' => $cliente->fullname,
            'dni' => $cliente->dni,
            'cuit' => $cliente->cuit,
            'cuil' => $cliente->cuil,
            'observaciones' => $venta->observaciones,
            'importe' => $venta->totalPorCuotas($venta->plan_cuotas)
        ]);

        if($domicilio){

            $ventaCerrada->calle = $domicilio->calle;
            $ventaCerrada->numero = $domicilio->numero;
            $ventaCerrada->piso = $domicilio->piso;
            $ventaCerrada->departamento = $domicilio->departamento;
            $ventaCerrada->codigo_postal = $domicilio->codigo_postal;
            $ventaCerrada->entre_calles = $domicilio->entre_calles;
            $ventaCerrada->barrio = $domicilio->barrio;
            $ventaCerrada->localidad = $domicilio->localidad->localidad;
            $ventaCerrada->partido = $domicilio->partido->partido;
            $ventaCerrada->provincia = $domicilio->provincia->provincia;

            $ventaCerrada->save();
        }

        foreach($productos as $producto){
            VentaCerradaProducto::create([
                'venta_cerrada_id' => $ventaCerrada->id,
                'nombre' => $producto->nombre,
                'marca' => ($producto->marca)? $producto->marca->nombre : null,
                'institucion' => ($producto->institucion)? $producto->institucion->nombre : null
            ]);
        }
    }

    public function ajustar($id, $ajuste)
    {
        $venta = Venta::find($id);
        $nuevoAjuste = $venta->total($venta->plan_cuotas) - $ajuste;

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'update',
            'field' => 'ajuste',
            'former_value' => $venta->ajuste,
            'updated_value' => $nuevoAjuste
        ]);

        $venta->ajuste = $nuevoAjuste;
        $venta->save();

        return $venta;
    }

    public function quitarAjuste($id, $active = true)
    {
        $venta = Venta::find($id);
        $nuevoAjuste = 0.00;

        if($active){
            $venta->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'delete',
                'field' => 'ajuste',
                'former_value' => $venta->ajuste,
                'updated_value' => $nuevoAjuste
            ]);
        }

        $venta->ajuste = $nuevoAjuste;
        $venta->save();

        return $venta;
    }

    public function isInvoicedSale($oldEstado, $newEstado)
    {
        return $oldEstado->isInArray(['facturada', 'enviada', 'entregado', 'noentregado', 'devuelto', 'desconocimiento']) && !$newEstado->isInArray(['enviada', 'entregado', 'noentregado', 'devuelto', 'desconocimiento']);
    }

    public function hasExpiredCardInMethod($metodos)
    {
        foreach($metodos as $metodo){
            if($metodo->datostarjeta_id){
                if($metodo->datosTarjeta->isExpired()){
                    return true;
                }
            }
        }

        return false;
    }

    public function checkIfValid($venta)
    {
        $message = null;

        if(!$venta->metodoPagoVenta->count())
            $message = 'No se puede aceptar la venta. No tiene ingresado ningún método de pago';

        if(!$venta->plan_cuotas)
            $message = 'No se puede aceptar la venta. Debe seleccionar al menos un plan de cuotas';

        if($this->hasExpiredCardInMethod($venta->metodoPagoVenta))
            $message = 'No se puede aceptar la venta porque la tarjeta ingresada está vencida';

        return $message;

    }

}
