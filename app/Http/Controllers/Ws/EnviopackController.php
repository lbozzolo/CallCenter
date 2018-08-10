<?php

namespace SmartLine\Http\Controllers\Ws;

use Illuminate\Http\Request;
use SmartLine\Http\Controllers\Controller;
use SmartLine\Http\Functions\CotizacionesFunction;
use SmartLine\Http\Requests\CotizacionVendedorRequest;
use SmartLine\Entities\Provincia;

class EnviopackController extends Controller
{
    protected $cotizacionesFunction;

    public function __construct(CotizacionesFunction $cotizacionesFunction)
    {
        $this->cotizacionesFunction = $cotizacionesFunction;
    }

    /*public function enviopack()
    {
        $provincias = Provincia::lists('provincia', 'codProvincia');
        return view('enviopack.cotizaciones', compact('provincias'));
    }*/

    public function cotizaciones()
    {
        $provincias = Provincia::lists('provincia', 'codProvincia');
        $getCorreos = $this->getCorreos()->getData();
        $correos = collect($getCorreos->results)->lists('nombre', 'id');
        return view('enviopack.cotizaciones', compact('provincias', 'correos'));
    }

    public function getCotizacion(CotizacionVendedorRequest $request)
    {
        $provincia = $request->provincia;
        $codigoPostal = $request->codigoPostal;
        $peso = $request->peso;
        $paquetes = $request->paquetes;
        $direccionEnvio = $request->datosEnvio;

        $this->cotizacionesFunction->getCotizacion($provincia, $codigoPostal, $peso, $paquetes, $direccionEnvio);

        if ($this->cotizacionesFunction->getHttpCode() != 200) abort(500);
        $payload['results'] = $this->cotizacionesFunction->getResultado();

        return response()->json($payload, 200);

    }

    public function getComprador(CotizacionVendedorRequest $request)
    {

        $provincia = $request->provincia;
        $codigoPostal = $request->codigoPostal;
        $peso = $request->peso;
        $paquetes = $request->paquetes;
        $correo = $request->correo;
        $direccionEnvio = $request->datosEnvio;

        $this->cotizacionesFunction->getComprador($provincia, $codigoPostal, $peso, $paquetes, $correo, $direccionEnvio);

        if ($this->cotizacionesFunction->getHttpCode() != 200) abort(500);
        $payload['results'] = $this->cotizacionesFunction->getResultado();

        return response()->json($payload, 200);

    }

    public function getCorreos()
    {
        $this->cotizacionesFunction->getCorreos();

        if ($this->cotizacionesFunction->getHttpCode() != 200) abort(500);
        $payload['results'] = $this->cotizacionesFunction->getResultado();

        return response()->json($payload, 200);
    }


}