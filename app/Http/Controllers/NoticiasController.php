<?php namespace SmartLine\Http\Controllers;

use SmartLine\Http\Requests\CreateNoticiaRequest;
use SmartLine\Entities\Noticia;

class NoticiasController extends Controller
{

    public function index()
    {
        return view('noticias.index');
    }

    public function create()
    {
        return view('noticias.create');
    }

    public function store(CreateNoticiaRequest $request)
    {
        Noticia::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);
        return redirect()->route('noticias.index')->with('La noticia ha sido agregada con éxito');
    }

    public function edit($id)
    {
        $noticia = Noticia::find($id);
        $noticias = Noticia::all();
        return view('noticias.edit', compact('noticia', 'noticias'));
    }

    public function update(CreateNoticiaRequest $request, $id)
    {
        $noticia = Noticia::find($id);

        $noticia->nombre = $request->nombre;
        $noticia->descripcion = $request->descripcion;
        $noticia->save();

        return redirect()->route('noticias.index')->with('ok', 'La noticia ha sido editada con éxito');
    }

    public function destroy($id)
    {
        $noticia = Noticia::find($id);

        if($noticia->productos->count()){
            return redirect()->back()->withErrors('No puede eliminar la noticia porque tiene algo asignado');
        }

        $noticia->delete();

        return redirect()->route('noticias.index')->with('ok', 'La noticia ha sido eliminada con éxito');
    }

}