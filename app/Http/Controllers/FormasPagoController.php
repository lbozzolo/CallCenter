<?php namespace SmartLine\Http\Controllers;

use SmartLine\Entities\Banco;
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
        $tarjetas = MarcaTarjeta::with('formasPago')->get();
        $marcasTarjetas = MarcaTarjeta::where('tipo', 'credito')->lists('nombre', 'id');
        $cuotas = config('sistema.ventas.cuotas');
        $bancos = Banco::lists('nombre', 'id');

        return view('pagos.index', compact('tarjetas', 'marcasTarjetas', 'cuotas', 'bancos'));
    }

    public function chooseCard(Request $request)
    {
        $messages = [
            'card_id.required'    => 'Debe elegir una tarjeta',
            'banco_id.required'    => 'Debe elegir un banco.',
        ];

        $validator = Validator::make($request->all(), [
            'card_id' => 'required',
            'banco_id' => 'required',
        ], $messages);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $data['card'] = MarcaTarjeta::find($request->card_id);
        $data['banco'] = Banco::find($request->banco_id);
        $data['formasPagoTotal'] = FormaPago::where('marca_tarjeta_id', $request->card_id)->where('banco_id', $request->banco_id)->get();

        $data['tarjetas'] = MarcaTarjeta::with('formasPago')->get();
        $data['marcasTarjetas'] = MarcaTarjeta::where('tipo', 'credito')->lists('nombre', 'id');
        $data['cuotas'] = config('sistema.ventas.cuotas');
        $data['bancos'] = Banco::lists('nombre', 'id');

        return view('pagos.index')->with($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tarjeta_id' => 'required',
            'banco_id' => 'required',
            'cuota_cantidad' => 'required',
            'valor' => 'max:100|min:0'
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $forma = $this->formaPagoRepo->getFormaPago($request->tarjeta_id, $request->banco_id, $request->cuota_cantidad);

        if($forma)
            return redirect()->route('formas.pago.edit', $forma->id)->withErrors('Ya existe una forma de pago con los datos ingresados. Si desea puede editarla.');

        if($request->interes_descuento == 'interes')
            $request['interes'] = $request->valor;

        if($request->interes_descuento == 'descuento')
            $request['descuento'] = $request->valor;

        $formaPago = FormaPago::create([
            'marca_tarjeta_id' => $request->tarjeta_id,
            'banco_id' => $request->banco_id,
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

        $tarjetas = MarcaTarjeta::with('formasPago')->get();
        $cuotas = config('sistema.ventas.cuotas');
        $marcasTarjetas = MarcaTarjeta::where('tipo', 'credito')->lists('nombre', 'id');
        $bancos = Banco::lists('nombre', 'id');

        $card = $formaEdit->tarjeta;
        $banco = $formaEdit->banco;

        return view('pagos.index', compact('tarjetas', 'marcasTarjetas', 'cuotas', 'formaEdit', 'bancos', 'banco', 'card'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tarjeta_id' => 'required',
            'banco_id' => 'required',
            'cuota_cantidad' => 'required',
            'valor' => 'max:100|min:0'
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $formaPago = $this->formaPagoRepo->updateFormaPago($id, $request);

        $data['card'] = $formaPago->tarjeta;
        $data['banco'] = $formaPago->banco;
        $data['formasPagoTotal'] = FormaPago::where('marca_tarjeta_id', $formaPago->marca_tarjeta_id)->where('banco_id', $formaPago->banco_id)->get();

        $data['tarjetas'] = MarcaTarjeta::with('formasPago')->get();
        $data['marcasTarjetas'] = MarcaTarjeta::where('tipo', 'credito')->lists('nombre', 'id');
        $data['cuotas'] = config('sistema.ventas.cuotas');
        $data['bancos'] = Banco::lists('nombre', 'id');

        if(!$formaPago)
            return redirect()->back()->withErrors('Ocurrió un error. No se pudo actualizar la Forma de Pago');

        return view('pagos.index')->with($data)->with('ok', 'Forma de Pago actualizada con éxito');
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