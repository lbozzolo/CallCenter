<?php

namespace SmartLine\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use SmartLine\Entities\Cliente;
use SmartLine\Entities\DatoTarjeta;
use SmartLine\Entities\EstadoVenta;
use SmartLine\Entities\Etapa;
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
use SmartLine\Entities\Updateable;
use SmartLine\Entities\Venta;
use SmartLine\Http\Repositories\VentaRepo;
use SmartLine\Http\Repositories\MarcaTarjetaRepo;
use SmartLine\Entities\Banco;
use SmartLine\Entities\ValidateCreditCard;
use SmartLine\Http\Requests\CreateDatosTarjetaRequest;
use Illuminate\Support\Facades\Validator;

use SmartLine\Http\Requests;
use SmartLine\Http\Controllers\Controller;

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

        /*$estados = EstadoCliente::lists('nombre', 'id');
        $provincias = Provincia::lists('provincia', 'id');
        $partidos = Partido::lists('partido', 'id', 'codProvincia');
        $localidades = Localidad::lists('localidad', 'id', 'codProvincia');

        if($cliente->domicilio){
            if($cliente->domicilio->provincia){
                $provinciaCliente = Provincia::find($cliente->domicilio->provincia->id);
                $partidos = Partido::where('codProvincia', $provinciaCliente->codProvincia)->lists('partido', 'id', 'codProvincia');
            }
            if($cliente->domicilio->partido){
                $partidoCliente = Partido::find($cliente->domicilio->partido->id);
                $localidades = Localidad::where('idPartido', $partidoCliente->idPartido)->lists('localidad', 'id', 'codProvincia');
            }

        }*/

        return view('ventas.seleccion-producto', compact('productos', 'total', 'cliente', 'tags'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {
        $iniciada = EstadoVenta::where('slug', 'iniciada')->first();
        $producto = Producto::find($request->id_producto);
        $cliente = Cliente::find($request->id_cliente);

        $venta = Venta::create([
            'user_id' => Auth::user()->id,
            'cliente_id' => $cliente->id,
            'estado_id' => $iniciada->id //Por defecto se crea en estado INICIADA
        ]);

        $venta->productos()->attach($producto);

        return redirect()->route('ventas.panel', $venta->id);
    }

    public function panel($idVenta)
    {
        $data['venta'] = Venta::with('productos', 'cliente')->where('id', $idVenta)->first();
        $data['total'] = $this->ventaRepo->totalesVentasByEstado();
        $data['tags'] = EstadoVenta::lists('nombre', 'slug');

        $data['estados'] = EstadoCliente::lists('nombre', 'id');
        $data['provincias'] = Provincia::lists('provincia', 'id');
        $data['partidos'] = Partido::lists('partido', 'id', 'codProvincia');
        $data['localidades'] = Localidad::lists('localidad', 'id', 'codProvincia');

        $data['marcas'] = MarcaTarjeta::all();
        $data['bancos'] = Banco::lists('nombre', 'id');
        $data['metodosPago'] = MetodoPago::lists('nombre', 'id');
        $data['cuotas'] = config('sistema.ventas.cuotas');
        $data['promociones'] = Promocion::lists('nombre', 'id');

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

        return redirect()->route('ventas.panel', $venta->id)->with('Producto agregado con éxito');
    }

    public function numeroGuia(Request $request, $id)
    {
        $venta = Venta::find($id);
        $venta->numero_guia = $request->numero_guia;
        $venta->save();

        return redirect()->back()->with('ok', 'Número de guía guardado con éxito');
    }

    public function editarModos(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'observaciones' => 'required|max:500',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $venta = Venta::find($request->venta_id);
        $venta->observaciones = $request->observaciones;
        $venta->save();

        return redirect()->route('ventas.panel', $venta->id)->with('Observaciones guardadas con éxito');
    }

    public function quitarProducto(Request $request)
    {
        $venta = Venta::find($request->venta_id);
        $producto = Producto::find($request->producto_id);

        $venta->productos()->detach($producto);
        return redirect()->route('ventas.panel', $venta->id)->with('Producto quitado de la venta con éxita');
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
            'field' => 'estado_id',
            'former_value' => $venta->estado_id,
            'updated_value' => $cancelado->id,
            'reason' => $motivo
        ]);

        $venta->estado_id = $cancelado->id;
        $venta->save();

        return redirect()->route('ventas.panel', $venta->id)->with('La venta ha sido cancelada');
    }

    public function aceptar(Request $request)
    {
        $venta = Venta::find($request->venta_id);
        $auditable = EstadoVenta::where('slug', 'auditable')->first();

        $venta->updateable()->create([
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

        $venta->updateable()->create([
            'field' => 'estado_id',
            'former_value' => $venta->estado_id,
            'updated_value' => $venta->former_status,
        ]);

        $venta->estado_id = $venta->former_status;
        $venta->save();

        return redirect()->route('ventas.panel', $venta->id)->with('La venta ha sido retomada');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //$producto = $data['venta']->producto;
        //$data['etapas'] = $producto->etapas->lists('nombre', 'id');
        $data['marcas'] = MarcaTarjeta::all();
        $data['bancos'] = Banco::lists('nombre', 'id');
        $data['metodosPago'] = MetodoPago::lists('nombre', 'id');
        $data['promociones'] = Promocion::lists('nombre', 'id');
        $data['estados'] = EstadoVenta::lists('nombre', 'id');
        $data['cuotas'] = config('sistema.ventas.cuotas');

        $data['total'] = $this->ventaRepo->totalesVentasByEstado();
        $data['tags'] = EstadoVenta::lists('nombre', 'slug');

        return view('ventas.show')->with($data);
    }

    public function showClienteVentas($id)
    {
        $data['venta'] = Venta::find($id);
        $data['cliente'] = $data['venta']->cliente;
        /*$producto = $data['venta']->producto;
        $data['etapas'] = $producto->etapas->lists('nombre', 'id');*/
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
        return view('ventas.reclamos', compact('venta'));
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
        $venta = Venta::find($id);
        $venta->etapa_id = ($request->etapa_id)? $request->etapa_id : null;
        $venta->promocion_id = ($request->promocion_id)? $request->promocion_id : null;
        $venta->metodo_pago_id = $request->metodo_pago_id;
        $metodoPago = MetodoPago::find($request->metodo_pago_id);
        $numeroCuotas = ($request->cuotas)? $request->cuotas : null;

        if($metodoPago->slug == 'credito' || $metodoPago->slug == 'debito'){

            // Datos de tarjeta
            $marcaTarjeta = ($metodoPago->slug == 'credito')? $request->marca_id_credito : $request->marca_id_debito;
            $fechaExpiracion = ($request->fecha_expiracion)? Carbon::createFromFormat('d/m/Y', $request->fecha_expiracion)->toDateTimeString() : null;
            $credit_card_user = $request->numero_tarjeta;

            //Cantidad de cuotas
            $cuotas = $this->marcaTarjetaRepo->hasCuotas($marcaTarjeta, $numeroCuotas);
            if(!count($cuotas))
                return redirect()->back()->withErrors('No existe la forma de pago en '.$numeroCuotas.' cuotas con la tarjeta seleccionada');

            /*dd($cuotas);
            //Forma de pago
            $formaPago = FormaPago::where('cuota_cantidad', $cuotas);*/

            //Validación
            $validacion = ValidateCreditCard::validateFormatCreditCard($credit_card_user);
            $luhn = ValidateCreditCard::calculateLuhn($credit_card_user);

            if(!$validacion || !$luhn)
                return redirect()->back()->withErrors('Tarjeta inválida. Revise los datos ingresados');

            //Actualización datos de tarjeta
            $datosTarjeta = ($venta->datosTarjeta)? $venta->datosTarjeta : new DatoTarjeta();
            $datosTarjeta->marca_id = ($marcaTarjeta)? $marcaTarjeta : null;
            $datosTarjeta->banco_id = ($request->banco_id)? $request->banco_id : null;
            $datosTarjeta->numero_tarjeta = ($request->numero_tarjeta)? $request->numero_tarjeta : null;
            $datosTarjeta->fecha_expiracion = ($fechaExpiracion)? $fechaExpiracion : null;
            $datosTarjeta->titular = ($request->titular)? $request->titular : null;
            $datosTarjeta->codigo_seguridad = ($request->codigo_seguridad)? $request->codigo_seguridad : null;
            $datosTarjeta->forma_pago_id = ($cuotas)? $cuotas->first()->id : null;

            //Asociación de datos de tarjeta a venta
            $datosTarjeta->venta()->associate($venta);
            $venta->formaPago()->associate($cuotas->first());
            $datosTarjeta->save();
        }

        $venta->save();

        return redirect()->back()->with('ok', 'Venta editada con éxito');
    }

    public function updateStatus(Request $request, $id)
    {
        $estado = EstadoVenta::find($request->estado_id);

        if($estado->slug == 'cancelada'){
            $validator = Validator::make($request->all(), [
                'motivo' => 'required|max:255',
            ]);

            if ($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();
        }

        $venta = Venta::find($id);
        $motivo = $request->motivo;

        $venta->updateable()->create([
            'field' => 'estado_id',
            'former_value' => $venta->estado_id,
            'updated_value' => $estado->id,
            'reason' => ($motivo != '')? $motivo : null
        ]);

        $venta->estado_id = $estado->id;
        $venta->save();

        return redirect()->back()->with('El estado de la venta ha sido actualizado');
    }


    public function ajustar(Request $request, $id)
    {
        $venta = Venta::find($id);
        $venta->ajuste = $venta->total() - $request->ajuste;
        $venta->save();

        return redirect()->back()->with('ok', 'Importe de venta ajustado con éxito');
    }

    public function quitarAjuste(Request $request, $id)
    {
        $venta = Venta::find($id);
        $venta->ajuste = 0.00;
        $venta->save();

        return redirect()->back()->with('ok', 'Ajuste de venta quitado con éxito');
    }

    public function quitarMetodoPago(Request $request, $id)
    {
        $metodopago = MetodoPagoVenta::find($id);
        $metodopago->delete();

        return redirect()->back()->with('ok', 'Método de pago eliminado con éxito');
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
}
