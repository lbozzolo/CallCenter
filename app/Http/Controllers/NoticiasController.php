<?php namespace SmartLine\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use SmartLine\Http\Requests\CreateNoticiaRequest;
use SmartLine\Entities\Noticia;

class NoticiasController extends Controller
{

    public function index()
    {
        $noticias = Noticia::all();
        return view('noticias.index', compact('noticias'));
    }

    public function noticias()
    {
        $noticias = Noticia::orderBy('created_at', 'desc')->paginate(10);
        return view('noticias.noticias', compact('noticias'));
    }

    public function show($id)
    {
        $noticia = Noticia::find($id);
        return view('noticias.show',compact('noticia'));
    }


    public function create()
    {
        return view('noticias.create');
    }

    public function store(CreateNoticiaRequest $request)
    {
        $noticia = Noticia::create([
            'user_id' => Auth::user()->id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion
        ]);

        $noticia->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'create'
        ]);

        return redirect()->route('noticias.index')->with('ok', 'La noticia ha sido agregada con éxito');
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

        if($request['titulo'] && $request['titulo'] != $noticia->titulo){
            $noticia->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'titulo',
                'former_value' => $noticia->titulo,
                'updated_value' => $request['titulo']
            ]);
            $noticia->titulo = $request['titulo'];
        }

        if($request['descripcion'] && $request['descripcion'] != $noticia->descripcion){
            $noticia->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'descripcion',
                'former_value' => $noticia->descripcion,
                'updated_value' => $request['descripcion']
            ]);
            $noticia->descripcion = $request['descripcion'];
        }

        $noticia->save();

        return redirect()->route('noticias.index')->with('ok', 'La noticia ha sido editada con éxito');
    }

    public function destroy($id)
    {
        $noticia = Noticia::find($id);

        $noticia->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'delete'
        ]);

        $noticia->delete();

        return redirect()->route('noticias.index')->with('ok', 'La noticia ha sido eliminada con éxito');
    }

}