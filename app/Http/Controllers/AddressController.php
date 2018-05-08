<?php namespace SmartLine\Http\Controllers;

use Illuminate\Http\Request;
use SmartLine\Entities\Partido;
use SmartLine\Entities\Localidad;
use SmartLine\Entities\Provincia;

class AddressController extends Controller
{

    public function getPartidos(Request $request)
    {
        $provincia = Provincia::find($request->provincia);
        return response()->json(Partido::where('codProvincia', $provincia->codProvincia)->get());
    }

    public function getLocalidades(Request $request)
    {
        $partido = Partido::find($request->partido);
        return response()->json(Localidad::where('idPartido', $partido->idPartido)->get());
    }

}