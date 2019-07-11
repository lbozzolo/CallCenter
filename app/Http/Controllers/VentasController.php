<?php

namespace SmartLine\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use SmartLine\Entities\Cliente;
use SmartLine\Entities\DatoTarjeta;
use SmartLine\Entities\EstadoVenta;
use SmartLine\Entities\MetodoPagoVenta;
use SmartLine\Entities\Producto;
use SmartLine\Entities\EstadoProducto;
use SmartLine\Entities\EstadoCliente;
use SmartLine\Entities\ProductoVenta;
use SmartLine\Entities\Provincia;
use SmartLine\Entities\Partido;
use SmartLine\Entities\Localidad;
use Illuminate\Support\Facades\Auth;
use SmartLine\Entities\MarcaTarjeta;
use SmartLine\Entities\MetodoPago;
use SmartLine\Entities\Promocion;
use SmartLine\Entities\Venta;
use SmartLine\Http\Repositories\VentaRepo;
use SmartLine\Http\Repositories\ProductoRepo;
use SmartLine\Http\Repositories\MarcaTarjetaRepo;
use SmartLine\Http\Repositories\ClienteRepo;
use SmartLine\Entities\Banco;
use SmartLine\Http\Requests\CreateDatosTarjetaRequest;
use Illuminate\Support\Facades\Validator;
use SmartLine\Http\Requests\SearchVentasByDateRequest;
use SmartLine\User;

class VentasController extends Controller
{
    protected $ventaRepo;
    protected $marcaTarjetaRepo;
    protected $clienteRepo;
    protected $productoRepo;

    public function __construct(VentaRepo $ventaRepo, MarcaTarjetaRepo $marcaTarjetaRepo, ClienteRepo $clienteRepo, ProductoRepo $productoRepo)
    {
        $this->ventaRepo = $ventaRepo;
        $this->marcaTarjetaRepo = $marcaTarjetaRepo;
        $this->clienteRepo = $clienteRepo;
        $this->productoRepo = $productoRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($estado = null)
    {
        $data['ventas'] = $this->ventaRepo->getVentasByEstado($estado);
        $data['total'] = $this->ventaRepo->totalesVentasByEstado();
        $data['tags'] = EstadoVenta::lists('nombre', 'slug');
        $data['view'] = 'ventas.index';

        return view('ventas.index')->with($data);
    }

    public function buscarEntreFechas(SearchVentasByDateRequest $request)
    {
        $desde = Carbon::createFromFormat('d/m/Y', $request->fecha_desde)->toDateTimeString();
        $hasta = Carbon::createFromFormat('d/m/Y', $request->fecha_hasta)->toDateTimeString();
        $view = ($request->view)? $request->view : 'ventas.index';

        if($desde > $hasta)
            return redirect()->back()->withErrors('La segunda fecha debe ser posterior a la primera.');

        $ventas = Venta::where('created_at', '>=', $desde)
                        ->where('created_at', '<=', $hasta)
                        ->get();

        $ventas->title = 'Desde el <span class="text-warning">'.$request->fecha_desde.'</span> hasta el <span class="text-warning">'.$request->fecha_hasta.'</span>';

        return view($view, compact('ventas', 'view'));
    }

    public function chooseTag(Request $request)
    {
        return redirect()->route('ventas.index', $request->tag);
    }


    public function seleccionCliente()
    {
        $deshabilitado = EstadoCliente::where('slug', 'deshabilitado')->first();
        $clientes = Cliente::with('estado')->where('estado_id', '!=', $deshabilitado->id)->get();
        $ventas = $this->ventaRepo->getVentasByEstado(null);
        $total = $this->ventaRepo->totalesVentasByEstado();
        $tags = EstadoVenta::lists('nombre', 'slug');
        return view('ventas.create', compact('clientes', 'ventas', 'total', 'tags'));
    }


//    public function seleccionProducto($idCliente)
//    {
//        $cliente = Cliente::find($idCliente);
//
//        if($cliente->isDisabled())
//            return redirect()->back()->withErrors('No se puede iniciar la venta. El cliente seleccionado se encuentra deshabilitado.');
//
//        if(!$cliente->dni)
//            return redirect()->back()->withErrors('No se puede seleccionar el cliente: '. strtoupper($cliente->fullname).', porque no tiene DNI');
//
//        $total = $this->ventaRepo->totalesVentasByEstado();
//        $productos = Producto::where('estado_id', EstadoProducto::where('slug', 'activo')->first()->id)->get();
//        $tags = EstadoVenta::lists('nombre', 'slug');
//
//        return view('ventas.seleccion-producto', compact('productos', 'total', 'cliente', 'tags'));
//    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create($id)
    {
        $iniciada = EstadoVenta::where('slug', 'iniciada')->first();
        $cliente = Cliente::find($id);

        if($cliente->isDisabled())
            return redirect()->back()->withErrors('No se puede iniciar la venta. El cliente seleccionado se encuentra deshabilitado.');

        if(!$cliente->dni)
            return redirect()->back()->withErrors('No se puede seleccionar el cliente: '. strtoupper($cliente->fullname).', porque no tiene DNI');

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
        $data['productos'] = $this->productoRepo->getProductosActivos();

        $data['productosVenta'] = $data['venta']->productos->groupBy('id');

        $data['marcas'] = MarcaTarjeta::lists('nombre', 'id');
        $data['bancos'] = Banco::lists('nombre', 'id');
        //$data['metodosPago'] = MetodoPago::lists('nombre', 'id');
        $data['metodosPago'] = MetodoPago::whereIn('slug', ['credito', 'debito'])->lists('nombre', 'id');
        $data['cuotas'] = config('sistema.ventas.cuotas');
        $data['promociones'] = Promocion::lists('nombre', 'id');
        $data['tarjetas'] = ($data['venta']->cliente->datosTarjeta)? $data['venta']->cliente->datosTarjeta : null;

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

        $data['products'] = Producto::all()->lists('nombre_precio', 'id');

        //dd($data);

        return view('ventas.panel')->with($data);
    }

    public function agregarProducto(Request $request)
    {

        $venta = Venta::find($request->venta_id);

        if(!Auth::user()->can('alter', $venta))
            return redirect()->back()->withErrors('Usted no está autorizado a editar esta venta');

        $productos_con_etapas = collect();

        if(is_array($request->producto_id)){

            foreach($request->producto_id as $key => $value){

                if($value){
                    $producto = Producto::find($value);

                    for($i = 1; $i <= $request->cantidad; $i++){
                        $venta->productos()->attach($producto);
                        $venta->updateable()->create([
                            'user_id' => Auth::user()->id,
                            'action' => 'add',
                            'related_model_id' => $producto->id,
                            'related_model_type' => 'producto'
                        ]);
                    }

                    if($producto->hasEtapas())
                        $productos_con_etapas->push($producto);


                }
            }

        } else {

            $producto = Producto::find($request->producto_id);

            for($i = 1; $i <= $request->cantidad; $i++){
                $venta->productos()->attach($producto);
                $venta->updateable()->create([
                    'user_id' => Auth::user()->id,
                    'action' => 'add',
                    'related_model_id' => $producto->id,
                    'related_model_type' => 'producto'
                ]);
            }

            if($producto->hasEtapas())
                $productos_con_etapas->push($producto);

        }
        $data['productosConEtapas'] = $productos_con_etapas;

        return redirect()->back()->with($data);
    }

    public function quitarProducto(Request $request)
    {
        $venta = Venta::find($request->venta_id);

        if(!Auth::user()->can('alter', $venta))
            return redirect()->back()->withErrors('Usted no está autorizado a editar esta venta');

        $producto = ProductoVenta::where('venta_id', $venta->id)->where('producto_id', $request->producto_id)->first();
        $producto->delete();

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'delete',
            'related_model_id' => $request->producto_id,
            'related_model_type' => 'producto',
        ]);

        return redirect()->back()->with('Producto quitado de la venta con éxito');
    }

    public function quitarProductos(Request $request)
    {
        $venta = Venta::find($request->venta_id);

        if(!Auth::user()->can('alter', $venta))
            return redirect()->back()->withErrors('Usted no está autorizado a editar esta venta');

        $producto = Producto::find($request->producto_id);
        $venta->productos()->detach($producto);

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'delete',
            'related_model_id' => $producto->id,
            'related_model_type' => 'producto',
        ]);

        return redirect()->back()->with('Producto quitado de la venta con éxito');
    }

    public function seleccionarPlanCuotas(Request $request)
    {
        $venta = Venta::find($request->venta_id);
        $old = $venta->plan_cuotas;
        $venta->plan_cuotas = ($venta->plan_cuotas != $request->numero_de_cuotas)? $request->numero_de_cuotas : null;
        $venta->save();

        $this->ventaRepo->quitarAjuste($venta->id, false);

        if($old != $request->numero_de_cuotas){
            $venta->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'plan_cuotas',
                'former_value' => $old,
                'updated_value' => $venta->plan_cuotas
            ]);
        }

        return redirect()->back();
    }

    public function especificarEtapa(Request $request)
    {
        dd($request->all());
    }

    public function numeroGuia(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'numero_guia' => 'required',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

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

    public function cobrar(Request $request, $id)
    {
        $venta = Venta::find($id);
        $old = $venta->cobrada;

        $validator = Validator::make($request->all(), [
            'numero_transaccion' => ($venta->cobrada)? '' : 'required|max:50',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        if(!$venta->cobrada){
            $venta->cobrada = true;
            $venta->numero_transaccion = $request->numero_transaccion;
        } else {
            $venta->cobrada = false;
            $venta->numero_transaccion = null;
        }

        $venta->save();

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'update',
            'field' => 'cobrada',
            'former_value' => $old,
            'updated_value' => $venta->cobrada,
            'reason' => $venta->numero_transaccion
        ]);

        return redirect()->back();
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
        $messageError = $this->ventaRepo->checkIfValid($venta);

        if($messageError)
            return redirect()->back()->withErrors($messageError);

        $auditable = EstadoVenta::where('slug', 'auditable')->first();

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'update',
            'field' => 'estado_id',
            'former_value' => $venta->estado_id,
            'updated_value' => $auditable->id,
        ]);

        $venta->motivo = ($request->motivo)? $request->motivo : null;
        $venta->estado_id = $auditable->id;
        $venta->save();

        return redirect()->route('ventas.show', $venta->id)->with('ok', 'La venta ha sido aceptada correctamente');
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
        $data['marcas'] = MarcaTarjeta::lists('nombre', 'id');
        $data['bancos'] = Banco::lists('nombre', 'id');
        $data['metodosPago'] = MetodoPago::whereIn('slug', ['credito', 'debito'])->lists('nombre', 'id');
        $data['promociones'] = Promocion::lists('nombre', 'id');
        $data['estados'] = EstadoVenta::lists('nombre', 'id');
        $data['cuotas'] = config('sistema.ventas.cuotas');
        $data['tarjetas'] = $data['venta']->cliente->datosTarjeta;
        //$data['productos'] = Producto::all();
        //$data['products'] = Producto::all()->lists('nombre_precio', 'id');
        $data['products'] = $this->productoRepo->getProductosActivos()->lists('nombre_precio', 'id');
        $data['productosVenta'] = $data['venta']->productos->groupBy('id');
        $data['provincias'] = Provincia::lists('provincia', 'id');
        $data['partidos'] = Partido::lists('partido', 'id', 'codProvincia');
        $data['localidades'] = Localidad::lists('localidad', 'id', 'codProvincia');


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
        $view = 'ventas.auditoria';

        return view('ventas.auditoria', compact('ventas', 'view'));
    }

    public function postVenta()
    {
        $ventas = $this->ventaRepo->getVentasByEstado('entregado');
        $ventas = $ventas->merge($this->ventaRepo->getVentasByEstado('noentregado'));
        $ventas = $ventas->merge($this->ventaRepo->getVentasByEstado('devuelto'));
        $ventas->title = 'todas';
        $view = 'ventas.postventa';

        return view('ventas.postventa', compact('ventas', 'view'));
    }

    public function facturacion()
    {
        $ventas = $this->ventaRepo->getVentasByEstado('confirmada');
        $view = 'ventas.facturacion';

        return view('ventas.facturacion', compact('ventas', 'view'));
    }

    public function logistica()
    {
        $ventas = $this->ventaRepo->getVentasFacturadas();
        $view = 'ventas.logistica';

        return view('ventas.logistica', compact('ventas', 'view'));
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

        if(!Auth::user()->can('alter', $venta))
            return redirect()->back()->withErrors('Usted no está autorizado a editar esta venta');

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
        if(!Auth::user()->can('alter', Venta::find($id)))
            return redirect()->back()->withErrors('Usted no está autorizado a editar esta venta');

        $this->ventaRepo->updateVenta($id, $request);
        return redirect()->back()->with('ok', 'Venta editada con éxito');
    }

    public function updateStatus(Request $request, $id)
    {
        $venta = Venta::find($id);

        if(!Auth::user()->can('alter', $venta))
            return redirect()->back()->withErrors('Usted no está autorizado a editar esta venta');

        $estado = EstadoVenta::find($request->estado_id);

        // No permito cambiar de estado si la venta ya fue facturada
        if($this->ventaRepo->isInvoicedSale($venta->estado, $estado))
            return redirect()->back()->withErrors('No se puede cambiar el estado de la venta a "'.$estado->nombre.'"" porque la misma ya se encuentra facturada');

        // Redirecciono atrás si el cliente no tiene un barrio en sus datos personales
        if($venta->estado->slug == 'iniciada' && (!$venta->cliente->domicilio || !$venta->cliente->domicilio->barrio))
            return redirect()->back()->withErrors('No se puede realizar la operación. El Cliente no tiene ingresado un barrio en sus datos personales.');

        // Requiero 'motivo' si la venta está siendo marcada como cancelada o rechazada
        if($estado->isInArray(['cancelada', 'rechazada'])){

            $validator = Validator::make($request->all(), ['motivo' => 'required|max:255',]);

            if ($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();

        }

        // Si el estado es diferente al que tenía, guardo el updateable y guardo la venta en 'cerradas'
        if($venta->estado_id != $estado->id){

            $venta->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'estado_id',
                'former_value' => $venta->estado_id,
                'updated_value' => $estado->id,
                'reason' => ($request->motivo != '')? $request->motivo : null
            ]);

            if($estado->slug == 'facturada')
                $this->ventaRepo->cerrarVenta($venta->id);

            // EL motivo debe ser siempre referido al cambio de estado de la venta. Es un aporte extra de información
            $venta->motivo = ($estado->isInArray(['cancelada', 'rechazada', 'noentregado', 'devuelto']))? $request->motivo : null;

        }

        $venta->estado_id = $estado->id;
        $venta->save();

//        if($venta->statusIs('desconocimiento'))
//            $this->clienteRepo->disable($venta->cliente->id, 'Desconocimiento de venta');

        return redirect()->back()->with('El Estado de la venta ha sido actualizado');
    }

    public function ajustar(Request $request, $id)
    {
        if(!Auth::user()->can('alter', Venta::find($id)))
            return redirect()->back()->withErrors('Usted no está autorizado a editar esta venta');

        $this->ventaRepo->ajustar($id, $request->ajuste);
        return redirect()->back()->with('ok', 'Importe de Venta ajustado con éxito');
    }

    public function quitarAjuste($id)
    {
        if(!Auth::user()->can('alter', Venta::find($id)))
            return redirect()->back()->withErrors('Usted no está autorizado a editar esta venta');

        $this->ventaRepo->quitarAjuste($id);
        return redirect()->back()->with('ok', 'Ajuste de Venta quitado con éxito');
    }

    public function agregarMetodoDePago(Request $request, $id)
    {
        $venta = Venta::find($id);

        if(!Auth::user()->can('alter', $venta))
            return redirect()->back()->withErrors('Usted no está autorizado a editar esta venta');

        if(!$venta->productos->count())
            return redirect()->back()->withErrors('No puede agregar un método de pago si no ha ingresado ningún producto a la venta aún.')->withInput();

        $validator = Validator::make($request->all(), [
            'metodo_pago' => 'required',
            'importe' => 'required|integer|min:1',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $metodoPago = MetodoPago::find($request->metodo_pago);
        $datosTarjeta = ($request->datos_tarjeta_id)? DatoTarjeta::with('marca.formasPago')->where('id', $request->datos_tarjeta_id)->first() : null;

        if($datosTarjeta && $datosTarjeta->isExpired())
            return redirect()->back()->withErrors('La tarjeta ingresada se encuentra vencida');

        $tarjetaYcuotas = null;

        // Chequeo que exista el pago en las cuotas seleccionadas con la tarjeta seleccionada
//        if($metodoPago->isCardMethod() && $datosTarjeta){
//            $formasPago = $datosTarjeta->marca->formasPago->contains(function ($key, $value) use ($request) {
//                return $value->cuota_cantidad == $request->cuotas;
//            });
//
//            if(!$formasPago)
//                return redirect()->back()->withErrors('No hay Formas de Pago en '.$request->cuotas.' cuotas para la Tarjeta seleccionada');
//
//            $tarjetaYcuotas = FormaPago::where('marca_tarjeta_id', $datosTarjeta->marca_id)->where('cuota_cantidad', $request->cuotas)->first();
//        }

        $metodoPagoVenta = MetodoPagoVenta::create([
            'venta_id' => $id,
            'metodopago_id' => $request->metodo_pago,
            'datostarjeta_id' => ($metodoPago->isCardMethod())? $request->datos_tarjeta_id : null,
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

        if(!Auth::user()->can('alter', $venta))
            return redirect()->back()->withErrors('Usted no está autorizado a editar esta venta');

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

    public function envio($id)
    {
        $venta = Venta::find($id);
        $oldValue = $venta->envio;
        $venta->envio = ($venta->envio)? null : 1;
        $venta->save();

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'update',
            'field' => 'envio',
            'former_value' => $oldValue,
            'updated_value' => $venta->envio
        ]);

        return redirect()->back();
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

        if(!Auth::user()->can('alter', $venta))
            return redirect()->back()->withErrors('Usted no está autorizado a editar esta venta');

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
