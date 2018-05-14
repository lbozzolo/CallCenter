<?php namespace SmartLine\Http\Controllers;

use SmartLine\Entities\Etapa;
use Illuminate\Http\Request;
use SmartLine\Entities\Producto;
use SmartLine\Http\Requests\CreateEtapaRequest;

class EtapasController extends Controller
{

    public function edit($etapaId, $productoId)
    {
        $etapaEdit = Etapa::find($etapaId);
        $producto = Producto::find($productoId);

        return view('productos.etapas-edit', compact('etapaEdit', 'producto'));
    }

    public function update(CreateEtapaRequest $request, $id)
    {
        $etapa = Etapa::find($id);

        $etapa->nombre = $request->nombre;
        $etapa->dias_pendiente = ($request->dias_pendiente)? $request->dias_pendiente : '';
        $etapa->save();

        return redirect()->back()->with('ok', 'Etapa editada con éxito');
    }

    public function destroy($id)
    {
        $etapa = Etapa::find($id);

        $etapaAnterior = Etapa::where('etapa_proxima_id', $id)->first();
        $etapaAnterior->etapa_proxima_id = null;
        $etapaAnterior->save();

        $etapa->delete();

        return redirect()->back()->with('ok', 'Etapa eliminada con éxito');
    }



}