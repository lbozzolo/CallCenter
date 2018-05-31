<?php

namespace SmartLine\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use SmartLine\Entities\DatoTarjeta;
use SmartLine\Entities\EstadoVenta;
use SmartLine\Entities\Etapa;
use SmartLine\Entities\FormaPago;
use SmartLine\Entities\MarcaTarjeta;
use SmartLine\Entities\MetodoPago;
use SmartLine\Entities\Promocion;
use SmartLine\Entities\Venta;
use SmartLine\Http\Repositories\VentaRepo;
use SmartLine\Entities\Banco;
use SmartLine\Entities\ValidateCreditCard;

use SmartLine\Http\Requests;
use SmartLine\Http\Controllers\Controller;

class VentasController extends Controller
{
    protected $ventaRepo;

    public function __construct(VentaRepo $ventaRepo)
    {
        $this->ventaRepo = $ventaRepo;
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

        return view('ventas.index', compact('ventas', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $producto = $data['venta']->producto;
        $data['etapas'] = $producto->etapas->lists('nombre', 'id');
        $data['marcas'] = MarcaTarjeta::all();
        $data['bancos'] = Banco::lists('nombre', 'id');
        $data['metodosPago'] = MetodoPago::lists('nombre', 'id');
        $data['promociones'] = Promocion::lists('nombre', 'id');
        $data['estados'] = EstadoVenta::lists('nombre', 'id');

        return view('ventas.show')->with($data);
    }

    public function showClienteVentas($id)
    {
        $data['venta'] = Venta::find($id);
        $data['cliente'] = $data['venta']->cliente;
        $producto = $data['venta']->producto;
        $data['etapas'] = $producto->etapas->lists('nombre', 'id');
        $data['marcas'] = MarcaTarjeta::all();
        $data['bancos'] = Banco::lists('nombre', 'id');
        $data['metodosPago'] = MetodoPago::lists('nombre', 'id');
        $data['promociones'] = Promocion::lists('nombre', 'id');
        $data['estados'] = EstadoVenta::lists('nombre', 'id');

        return view('clientes.show-ventas')->with($data);
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
    public function update(Request $request, $id)
    {
        $venta = Venta::find($id);
        $venta->etapa_id = ($request->etapa_id)? $request->etapa_id : null;
        $venta->promocion_id = ($request->promocion_id)? $request->promocion_id : null;
        $venta->metodo_pago_id = $request->metodo_pago_id;
        $metodoPago = MetodoPago::find($request->metodo_pago_id);

        if($metodoPago->slug == 'credito' || $metodoPago->slug == 'debito'){

            // Datos de tarjeta
            $datosTarjeta = ($venta->datosTarjeta)? $venta->datosTarjeta : new DatoTarjeta();
            $marcaTarjeta = ($metodoPago->slug == 'credito')? $request->marca_id_credito : $request->marca_id_debito;
            $fechaExpiracion = ($request->fecha_expiracion)? Carbon::createFromFormat('d/m/Y', $request->fecha_expiracion)->toDateTimeString() : null;
            $credit_card_user = $request->numero_tarjeta;

            //Validación
            $validacion = ValidateCreditCard::validateFormatCreditCard($credit_card_user);
            $luhn = ValidateCreditCard::calculateLuhn($credit_card_user);

            if(!$validacion || !$luhn)
                return redirect()->back()->withErrors('Tarjeta inválida. Revise los datos ingresados');

            //Actualización datos de tarjeta
            $datosTarjeta->marca_id = ($marcaTarjeta)? $marcaTarjeta : null;
            $datosTarjeta->banco_id = ($request->banco_id)? $request->banco_id : null;
            $datosTarjeta->numero_tarjeta = ($request->numero_tarjeta)? $request->numero_tarjeta : null;
            $datosTarjeta->fecha_expiracion = ($fechaExpiracion)? $fechaExpiracion : null;
            $datosTarjeta->titular = ($request->titular)? $request->titular : null;
            $datosTarjeta->codigo_seguridad = ($request->codigo_seguridad)? $request->codigo_seguridad : null;

            //Asociación de datos de tarjeta a venta
            $datosTarjeta->venta()->associate($venta);
            $datosTarjeta->save();
        }

        $venta->save();

        return redirect()->back()->with('ok', 'Venta editada con éxito');
    }

    public function updateStatus(Request $request, $id)
    {
        $venta = Venta::find($id);
        $venta->estado_id = $request->estado_id;
        $venta->save();

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
}
