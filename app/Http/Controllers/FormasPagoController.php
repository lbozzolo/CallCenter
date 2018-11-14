<?php namespace SmartLine\Http\Controllers;

use SmartLine\Entities\FormaPago;
use SmartLine\Entities\MarcaTarjeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SmartLine\Http\Repositories\FormaPagoRepo;
use Illuminate\Support\Facades\Auth;

class FormasPagoController extends Controller
{
    protected $formaPagoRepo;

    public function __construct(FormaPagoRepo $formaPagoRepo)
    {
        $this->formaPagoRepo = $formaPagoRepo;
    }

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

        $formaPago = FormaPago::create([
            'marca_tarjeta_id' => $request->tarjeta_id,
            'cuota_cantidad' => $request->cuota_cantidad,
            'interes' => ($request->interes)? $request->interes : null,
            'descuento' => ($request->descuento)? $request->descuento : null
        ]);

        $formaPago->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'create'
        ]);

        return redirect()->route('formas.pago.index')->with('ok', 'Forma de Pago agregada con éxito');
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

        $formaPago = $this->formaPagoRepo->updateFormaPago($id, $request);

        if(!$formaPago)
            return redirect()->back()->withErrors('Ocurrió un error. No se pudo actualizar la Forma de Pago');

        return redirect()->route('formas.pago.index')->with('ok', 'Forma de Pago actualizada con éxito');
    }

    public function destroy(Request $request, $id)
    {
        $formaPago = FormaPago::find($id);

        if(count($formaPago->ventas))
            return redirect()->back()->withErrors('No se puede eliminar la Forma de Pago porque ya ha sido utilizada como Forma de pago en alguna venta');

        $formaPago->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'delete'
        ]);

        $formaPago->delete();

        return redirect()->back()->with('ok', 'Forma de Pago eliminada con éxito');
    }

}