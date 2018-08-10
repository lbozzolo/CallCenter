<?php namespace SmartLine\Http\Controllers;

use SmartLine\Http\Requests\CreateMarcaRequest;
use SmartLine\Entities\Marca;

class MarcasController extends Controller
{

    public function index()
    {
        $marcas = Marca::all();
        return view('marcas.index', compact('marcas'));
    }

    public function create()
    {
        return view('marcas.create');
    }

    public function store(CreateMarcaRequest $request)
    {
        Marca::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);
        return redirect()->route('marcas.index')->with('La marca ha sido agregada con éxito');
    }

    public function edit($id)
    {
        $marca = Marca::find($id);
        $marcas = Marca::all();
        return view('marcas.edit', compact('marca', 'marcas'));
    }

    public function update(CreateMarcaRequest $request, $id)
    {
        $marca = Marca::find($id);

        $marca->nombre = $request->nombre;
        $marca->descripcion = $request->descripcion;
        $marca->save();

        return redirect()->route('marcas.index')->with('ok', 'La marca ha sido editada con éxito');
    }

    public function destroy($id)
    {
        $marca = Marca::find($id);

        if($marca->productos->count()){
            return redirect()->back()->withErrors('No puede eliminar la marca porque tiene productos asignados');
        }

        $marca->delete();

        return redirect()->route('marcas.index')->with('ok', 'La marca ha sido eliminada con éxito');
    }

}