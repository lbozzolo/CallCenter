<?php namespace SmartLine\Http\Controllers;

use SmartLine\Entities\Etapa;
use Illuminate\Http\Request;

class EtapasController extends Controller
{

    public function edit($id)
    {
        $etapa = Etapa::find($id);
        dd($etapa);
    }

    public function update(Request $request, $id)
    {
        $etapa = Etapa::find($id);
        dd($request->all());
    }

    public function destroy($id)
    {
        $etapa = Etapa::find($id);
        dd($etapa);
    }



}