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
            'interes' => 'max:100|min:0',
            'descuento' => 'max:100|min:0'
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

    public function edit($id)
    {
        $formaEdit = FormaPago::find($id);
        $marcasTarjetas = MarcaTarjeta::lists('nombre', 'id');
        $tarjetas = MarcaTarjeta::with('formasPago')->get();
        $cuotas = config('sistema.ventas.cuotas');

        return view('pagos.index', compact('tarjetas', 'marcasTarjetas', 'cuotas', 'formaEdit'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tarjeta_id' => 'required',
            'cuota_cantidad' => 'required',
            'interes' => 'max:100|min:0',
            'descuento' => 'max:100|min:0'
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $formaPago = FormaPago::find($id);

        $formaPago->marca_tarjeta_id = $request->tarjeta_id;
        $formaPago->cuota_cantidad = $request->cuota_cantidad;
        $formaPago->interes = $request->interes;
        $formaPago->descuento = $request->descuento;

        $formaPago->save();

        return redirect()->route('formas.pago.index')->with('ok', 'Forma de pago actualizada con éxito');
    }

    public function destroy(Request $request, $id)
    {
        $formaPago = FormaPago::find($id);

        if(count($formaPago->ventas)){
            return redirect()->back()->withErrors('No se puede eliminar la forma de pago porque ya ha sido utilizada como forma de pago en alguna venta');
        }
        //$formaPago->delete();

        dd($formaPago->ventas);
        return redirect()->back()->with('ok', 'Forma de pago eliminada con éxito');
    }

}