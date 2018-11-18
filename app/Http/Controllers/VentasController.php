<?php

namespace SmartLine\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use SmartLine\Entities\Cliente;
use SmartLine\Entities\DatoTarjeta;
use SmartLine\Entities\EstadoVenta;
use SmartLine\Entities\FormaPago;
use SmartLine\Entities\MetodoPagoVenta;
use SmartLine\Entities\Producto;
use SmartLine\Entities\EstadoProducto;
use SmartLine\Entities\EstadoCliente;
use SmartLine\Entities\Provincia;
use SmartLine\Entities\Partido;
use SmartLine\Entities\Localidad;
use Illuminate\Support\Facades\Auth;
use SmartLine\Entities\MarcaTarjeta;
use SmartLine\Entities\MetodoPago;
use SmartLine\Entities\Promocion;
use SmartLine\Entities\Venta;
use SmartLine\Http\Repositories\VentaRepo;
use SmartLine\Http\Repositories\MarcaTarjetaRepo;
use SmartLine\Entities\Banco;
use SmartLine\Entities\ValidateCreditCard;
use SmartLine\Http\Requests\CreateDatosTarjetaRequest;
use Illuminate\Support\Facades\Validator;
use SmartLine\User;

class VentasController extends Controller
{
    protected $ventaRepo;
    protected $marcaTarjetaRepo;

    public function __construct(VentaRepo $ventaRepo, MarcaTarjetaRepo $marcaTarjetaRepo)
    {
        $this->ventaRepo = $ventaRepo;
        $this->marcaTarjetaRepo = $marcaTarjetaRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($estado = null)
    {
        $ventas = $this->ventaRepo->getVentasByEstado($estado);
        $total = $this->ventaRepo->totalesVentasByEstado();
        $tags = EstadoVenta::lists('nombre', 'slug');

        return view('ventas.index', compact('ventas', 'total', 'tags'));
    }

    public function chooseTag(Request $request)
    {
        return redirect()->route('ventas.index', $request->tag);
    }


    public function seleccionCliente()
    {
        $clientes = Cliente::with('estado')->get();
        $ventas = $this->ventaRepo->getVentasByEstado(null);
        $total = $this->ventaRepo->totalesVentasByEstado();
        $tags = EstadoVenta::lists('nombre', 'slug');
        return view('ventas.create', compact('clientes', 'ventas', 'total', 'tags'));
    }


    public function seleccionProducto($idCliente)
    {
        $cliente = Cliente::find($idCliente);

        if(!$cliente->dni)
            return redirect()->back()->withErrors('No se puede seleccionar el cliente: '. strtoupper($cliente->fullname).', porque no tiene DNI');

        $total = $this->ventaRepo->totalesVentasByEstado();
        $productos = Producto::where('estado_id', EstadoProducto::where('slug', 'activo')->first()->id)->get();
        $tags = EstadoVenta::lists('nombre', 'slug');

        return view('ventas.seleccion-producto', compact('productos', 'total', 'cliente', 'tags'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create($id)
    {
        $iniciada = EstadoVenta::where('slug', 'iniciada')->first();
        $cliente = Cliente::find($id);

        $venta = Venta::create([
            'user_id' => Auth::user()->id,
            'cliente_id' => $cliente->id,
            'estado_id' => $iniciada->id //Por defecto se crea en estado INICIADA
        ]);

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'create'
        ]);

        return redirect()->route('ventas.panel', $venta->id);
    }

    public function panel($idVenta)
    {
        $productoActivo = EstadoProducto::where('slug', 'activo')->first();
        $data['venta'] = Venta::with('productos.marca', 'productos.institucion', 'productos.etapas', 'cliente', 'cliente.datosTarjeta', 'cliente.datosTarjeta.marca', 'cliente.domicilio.localidad', 'cliente.domicilio.partido', 'cliente.domicilio.provincia')->where('id', $idVenta)->first();
        $data['total'] = $this->ventaRepo->totalesVentasByEstado();
        //$data['tags'] = EstadoVenta::lists('nombre', 'slug');

        $data['estados'] = EstadoCliente::lists('nombre', 'id');
        $data['provincias'] = Provincia::lists('provincia', 'id');
        $data['partidos'] = Partido::lists('partido', 'id', 'codProvincia');
        $data['localidades'] = Localidad::lists('localidad', 'id', 'codProvincia');
        $data['productos'] = Producto::where('estado_id', $productoActivo->id)->get();

        $data['marcas'] = MarcaTarjeta::lists('nombre', 'id');
        $data['bancos'] = Banco::lists('nombre', 'id');
        $data['metodosPago'] = MetodoPago::lists('nombre', 'id');
        $data['cuotas'] = config('sistema.ventas.cuotas');
        $data['promociones'] = Promocion::lists('nombre', 'id');
        $data['tarjetas'] = $data['venta']->cliente->datosTarjeta;

        if($data['venta']->cliente->domicilio){
            if($data['venta']->cliente->domicilio->provincia){
                $provinciaCliente = Provincia::find($data['venta']->cliente->domicilio->provincia->id);
                $data['partidos'] = Partido::where('codProvincia', $provinciaCliente->codProvincia)->lists('partido', 'id', 'codProvincia');
            }
            if($data['venta']->cliente->domicilio->partido){
                $partidoCliente = Partido::find($data['venta']->cliente->domicilio->partido->id);
                $data['localidades'] = Localidad::where('idPartido', $partidoCliente->idPartido)->lists('localidad', 'id', 'codProvincia');
            }
        }

        return view('ventas.panel')->with($data);
    }

    public function agregarProducto(Request $request)
    {
        $producto = Producto::find($request->producto_id);
        $venta = Venta::find($request->venta_id);
        $venta->productos()->attach($producto);

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'add',
            'related_model_id' => $producto->id,
            'related_model_type' => 'producto'
        ]);

        return redirect()->back()->with('Producto agregado con éxito');
    }

    public function quitarProducto(Request $request)
    {
        $venta = Venta::find($request->venta_id);
        $producto = Producto::find($request->producto_id);
        $venta->productos()->detach($producto);

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'delete',
            'related_model_id' => $producto->id,
            'related_model_type' => 'producto',
        ]);

        return redirect()->back()->with('Producto quitado de la venta con éxita');
    }

    public function numeroGuia(Request $request, $id)
    {
        $venta = Venta::find($id);

        if($request['numero_guia']){
            $venta->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'numero_guia',
                'former_value' => $venta->numero_guia,
                'updated_value' => $request->numero_guia
            ]);
            $venta->numero_guia = $request->numero_guia;
        }

        $venta->save();

        return redirect()->back()->with('ok', 'Número de Guía guardado con éxito');
    }

    public function editarModos(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'observaciones' => 'required|max:500',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $venta = Venta::find($request->venta_id);
        $producto = $venta->productos->filter(function ($item) use ($id) {
            return $item->id == $id;
        })->first();

        $producto->pivot->observaciones = $request->observaciones;
        $producto->pivot->save();

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'update',
            'related_model_id' => $producto->id,
            'related_model_type' => 'producto',
            'field' => 'observaciones',
            'updated_value' => $request->observaciones
        ]);

        return redirect()->route('ventas.panel', $venta->id)->with('ok', 'Observaciones guardadas con éxito');
    }

    public function cancelar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'motivo' => 'required|max:255',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $venta = Venta::find($request->venta_id);
        $cancelado = EstadoVenta::where('slug', 'cancelada')->first();
        $motivo = $request->motivo;

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'update',
            'field' => 'estado_id',
            'former_value' => $venta->estado_id,
            'updated_value' => $cancelado->id,
            'reason' => $motivo
        ]);

        $venta->estado_id = $cancelado->id;
        $venta->save();

        return redirect()->route('ventas.panel', $venta->id)->with('La Venta ha sido cancelada');
    }

    public function aceptar(Request $request)
    {
        $venta = Venta::find($request->venta_id);
        $auditable = EstadoVenta::where('slug', 'auditable')->first();

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'update',
            'field' => 'estado_id',
            'former_value' => $venta->estado_id,
            'updated_value' => $auditable->id,
        ]);

        $venta->estado_id = $auditable->id;
        $venta->save();

        return redirect()->route('ventas.panel', $venta->id)->with('La venta ha sido aceptada');
    }

    public function retomar(Request $request)
    {
        $venta = Venta::find($request->venta_id);
        $iniciada = EstadoVenta::where('slug', 'iniciada')->first();

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'update',
            'field' => 'estado_id',
            'former_value' => $venta->estado_id,
            'updated_value' => $iniciada->id,
        ]);

        $venta->estado_id = $iniciada->id;
        $venta->save();

        return redirect()->back()->with('ok', 'La venta ha sido retomada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['venta'] = Venta::find($id);
        $data['marcas'] = MarcaTarjeta::all();
        $data['bancos'] = Banco::lists('nombre', 'id');
        $data['metodosPago'] = MetodoPago::lists('nombre', 'id');
        $data['promociones'] = Promocion::lists('nombre', 'id');
        $data['estados'] = EstadoVenta::lists('nombre', 'id');
        $data['cuotas'] = config('sistema.ventas.cuotas');
        $data['tarjetas'] = $data['venta']->cliente->datosTarjeta;
        $data['productos'] = Producto::all();

        $data['total'] = $this->ventaRepo->totalesVentasByEstado();
        //$data['tags'] = EstadoVenta::lists('nombre', 'slug');

        return view('ventas.show')->with($data);
    }

    public function misVentas()
    {
        $user = Auth::user();
        $ventas = $user->ventas;

        return view('ventas.mis-ventas', compact('user', 'ventas'));
    }

    public function auditoria()
    {
        $ventas = $this->ventaRepo->getVentasByEstado('auditable');

        return view('ventas.auditoria', compact('ventas'));
    }

    public function postVenta()
    {
        $ventas = $this->ventaRepo->getVentasByEstado('entregado');
        $ventas = $ventas->merge($this->ventaRepo->getVentasByEstado('noentregado'));
        $ventas = $ventas->merge($this->ventaRepo->getVentasByEstado('devuelto'));

        return view('ventas.post-venta', compact('ventas'));
    }

    public function facturacion()
    {
        $ventas = $this->ventaRepo->getVentasByEstado('confirmada');

        return view('ventas.facturacion', compact('ventas'));
    }

    public function logistica()
    {
        $ventas = $this->ventaRepo->getVentasByEstado('enviada');
        $ventas = $ventas->merge($this->ventaRepo->getVentasByEstado('entregado'));
        $ventas = $ventas->merge($this->ventaRepo->getVentasByEstado('noentregado'));
        $ventas = $ventas->merge($this->ventaRepo->getVentasByEstado('devuelto'));

        return view('ventas.logistica', compact('ventas'));
    }

    public function timeline($id)
    {
        $data['venta'] = Venta::find($id);
        $data['updateable'] = $data['venta']->updateable;
        $data['metodosPago'] = $data['venta']->metodoPagoVenta;


        return view('ventas.timeline')->with($data);
    }

    public function showClienteVentas($id)
    {
        $data['venta'] = Venta::find($id);
        $data['cliente'] = $data['venta']->cliente;
        $data['marcas'] = MarcaTarjeta::all();
        $data['bancos'] = Banco::lists('nombre', 'id');
        $data['metodosPago'] = MetodoPago::lists('nombre', 'id');
        $data['promociones'] = Promocion::lists('nombre', 'id');
        $data['estados'] = EstadoVenta::lists('nombre', 'id');
        $data['cuotas'] = config('sistema.ventas.cuotas');

        return view('clientes.show-ventas')->with($data);
    }

    public function reclamos($id)
    {
        $venta = Venta::find($id);
        $users = User::with(['roles' => function ($query) {
            $query->get(['roles.id', 'name', 'slug']);
        }])->get(['id', 'nombre', 'apellido']);

        $users = $users->filter(function($value){
            return $value->is('supervisor|atencion.al.cliente|admin');
        })->all();

        return view('ventas.reclamos', compact('venta', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venta = Venta::find($id);
        $producto = $venta->producto;
        $etapas = $producto->etapas->lists('nombre', 'id');
        $metodosPago = MetodoPago::lists('nombre', 'id');
        $promociones = Promocion::lists('nombre', 'id');
        return view('ventas.edit', compact('venta', 'metodosPago', 'etapas', 'promociones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateDatosTarjetaRequest $request, $id)
    {
        $this->ventaRepo->updateVenta($id, $request);
        return redirect()->back()->with('ok', 'Venta editada con éxito');
    }

    public function updateStatus(Request $request, $id)
    {
        $venta = Venta::find($id);
        $estado = EstadoVenta::find($request->estado_id);
        $estadoAnterior = $venta->estado->slug;

        // Redirecciono atrás si el cliente no tiene un barrio en sus datos personales
        if($estadoAnterior == 'iniciada' && (!$venta->cliente->domicilio || !$venta->cliente->domicilio->barrio))
            return redirect()->back()->withErrors('No se puede realizar la operación. El Cliente no tiene ingresado un barrio en sus datos personales.');

        if($estado->slug == 'cancelada'){
            $validator = Validator::make($request->all(), [
                'motivo' => 'required|max:255',
            ]);

            if ($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();
        }

        $motivo = $request->motivo;

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'update',
            'field' => 'estado_id',
            'former_value' => $venta->estado_id,
            'updated_value' => $estado->id,
            'reason' => ($motivo != '')? $motivo : null
        ]);

        $venta->estado_id = $estado->id;
        $venta->save();

        return redirect()->back()->with('El Estado de la venta ha sido actualizado');
    }

    public function ajustar(Request $request, $id)
    {
        $venta = Venta::find($id);
        $nuevoAjuste = $venta->total() - $request->ajuste;

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'update',
            'field' => 'ajuste',
            'former_value' => $venta->ajuste,
            'updated_value' => $nuevoAjuste
        ]);

        $venta->ajuste = $nuevoAjuste;
        $venta->save();

        return redirect()->back()->with('ok', 'Importe de Venta ajustado con éxito');
    }

    public function quitarAjuste($id)
    {
        $venta = Venta::find($id);
        $nuevoAjuste = 0.00;

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'delete',
            'field' => 'ajuste',
            'former_value' => $venta->ajuste,
            'updated_value' => $nuevoAjuste
        ]);

        $venta->ajuste = $nuevoAjuste;
        $venta->save();

        return redirect()->back()->with('ok', 'Ajuste de Venta quitado con éxito');
    }

    public function agregarMetodoDePago(Request $request, $id)
    {
        $venta = Venta::find($id);
        $metodoPago = MetodoPago::find($request->metodo_pago);
        $datosTarjeta = ($request->datos_tarjeta_id)? DatoTarjeta::with('marca.formasPago')->where('id', $request->datos_tarjeta_id)->first() : null;
        $tarjetaYcuotas = null;

        // Chequeo que exista el pago en las cuotas seleccionadas con la tarjeta seleccionada
        if($metodoPago->isCardMethod() && $datosTarjeta){
            $formasPago = $datosTarjeta->marca->formasPago->contains(function ($key, $value) use ($request) {
                return $value->cuota_cantidad == $request->cuotas;
            });

            if(!$formasPago)
                return redirect()->back()->withErrors('No hay Formas de Pago en '.$request->cuotas.' cuotas para la Tarjeta seleccionada');

            $tarjetaYcuotas = FormaPago::where('marca_tarjeta_id', $datosTarjeta->marca_id)->where('cuota_cantidad', $request->cuotas)->first();
        }

        $metodoPagoVenta = MetodoPagoVenta::create([
            'venta_id' => $id,
            'metodopago_id' => $request->metodo_pago,
            'datostarjeta_id' => ($metodoPago->slug == 'credito' || $metodoPago->slug == 'debito')? $request->datos_tarjeta_id : null,
            'formadepago_id' => ($tarjetaYcuotas)? $tarjetaYcuotas->id : null,
            'importe' => $request->importe
        ]);

        $metodoPagoVenta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'create'
        ]);

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'add',
            'related_model_id' => $metodoPagoVenta->id,
            'related_model_type' => 'metodoPagoVenta',
            'field' => 'importe',
            'updated_value' => $metodoPagoVenta->importe
        ]);

        return redirect()->back()->with('ok', 'Método de Pago agregado con éxito')->with([$tab3 = 'active']);
    }

    public function quitarMetodoPago(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'reason' => 'required|max:255',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $metodoPagoVenta = MetodoPagoVenta::find($id);
        $venta = $metodoPagoVenta->venta;

        $metodoPagoVenta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'delete',
            'reason' => $request->reason
        ]);

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'delete',
            'related_model_id' => $metodoPagoVenta->id,
            'related_model_type' => 'metodoPagoVenta',
            'reason' => $request->reason
        ]);

        $metodoPagoVenta->delete();

        return redirect()->back()->with('ok', 'Método de Pago eliminado con éxito');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function editarMetodoPagoVenta(Request $request, $id)
    {
        $metodoPagoVenta = MetodoPagoVenta::find($id);
        $venta = $metodoPagoVenta->venta;

        if($request['importe'] && $request['importe'] != $metodoPagoVenta->importe) {
            $metodoPagoVenta->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'importe',
                'former_value' => $metodoPagoVenta->importe,
                'updated_value' => $request->importe
            ]);

            $venta->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'related_model_id' => $metodoPagoVenta->id,
                'related_model_type' => 'metodoPagoVenta',
                'field' => 'importe',
                'former_value' => $metodoPagoVenta->importe,
                'updated_value' => $request->importe
            ]);

            $metodoPagoVenta->importe = ($request->importe)? $request->importe : null;
        }

        $metodoPagoVenta->save();

        return redirect()->back();
    }
}
