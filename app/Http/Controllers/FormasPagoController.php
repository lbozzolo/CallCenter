<?php namespace SmartLine\Http\Controllers;

use SmartLine\Entities\FormaPago;
use SmartLine\Entities\MarcaTarjeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormasPagoController extends Controller
{

    public function index()
    {
        $marcasTarjetas = MarcaTarjeta::lists('nombre', 'id');
        $tarjetas = MarcaTarjeta::with('formasPago')->get();
        $cuotas = config('sistema.ventas.cuotas');

        return view('pagos.index', compact('tarjetas', 'marcasTarjetas', 'cuotas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tarjeta_id' => 'required',
            'cuota_cantidad' => 'required',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        FormaPago::create([
            'marca_tarjeta_id' => $request->tarjeta_id,
            'cuota_cantidad' => $request->cuota_cantidad,
            'interes' => ($request->interes)? $request->interes : null,
            'descuento' => ($request->descuento)? $request->descuento : null
        ]);

        return redirect()->route('formas.pago.index')->with('ok', 'Forma de pago agregada con éxito');
    }

}