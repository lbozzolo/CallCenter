<?php namespace SmartLine\Http\Controllers;

use Bican\Roles\Models\Role;
use Illuminate\Support\Facades\Auth;
use SmartLine\Entities\Destinatario;
use SmartLine\Http\Requests\CreateNoticiaRequest;
use SmartLine\Entities\Noticia;
use Carbon\Carbon;

class NoticiasController extends Controller
{

    public function index()
    {
        $noticias = Noticia::all();

        $destinatarios = Role::all()->reject(function($value){
            return $value->slug == 'superadmin';
        })->lists('name', 'id');

        return view('noticias.index', compact('noticias', 'destinatarios'));
    }

    public function noticias()
    {
        $thisWeek = Carbon::now()->startOfWeek();
        $role = Auth::user()->roles->first();

        $noticias = Noticia::whereHas('destinatarios', function ($query) use ($role) {
            $query->where('role_id', $role->id);
        })->get();

        $recientes = $noticias->filter(function ($value) use ($thisWeek) {
            return $value->created_at >= $thisWeek;
        });

        $recientesIds = [];
        foreach($recientes as $reciente){
            array_push($recientesIds, $reciente->id);
        }

        $anteriores = $noticias->sortByDesc('created_at')->filter(function ($item) use ($recientesIds) {
//            if(!in_array($item->id, $recientesIds))
                //return (!in_array($item->id, $recientesIds))? $item : false;
                return !in_array($item->id, $recientesIds);
        });

        return view('noticias.noticias', compact('recientes', 'anteriores'));
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

        if(count($request->destinatarios) > 0){
            foreach($request->destinatarios as $id){
                Destinatario::create([
                    'role_id' => $id,
                    'noticia_id' => $noticia->id
                ]);
            }
        }

        $noticia->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'create'
        ]);

        return redirect()->route('noticias.index')->with('ok', 'La Noticia ha sido agregada con éxito');
    }

    public function edit($id)
    {
        $roles = Role::all();

        $destinatarios = $roles->reject(function($value){
            return $value->slug == 'superadmin';
        });
        $destinatarios = $destinatarios->lists('name', 'id');

        $noticia = Noticia::find($id);
        $noticias = Noticia::all();
        return view('noticias.edit', compact('noticia', 'noticias', 'destinatarios'));
    }

    public function update(CreateNoticiaRequest $request, $id)
    {
        $noticia = Noticia::with('destinatarios')->find( $id);

        if(count($request->destinatarios) > 0){

            foreach($noticia->destinatarios as $destinatario){
                Destinatario::destroy($destinatario->id);
            }

            foreach($request->destinatarios as $id){
                Destinatario::create([
                    'role_id' => $id,
                    'noticia_id' => $noticia->id
                ]);
            }

        }

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

        return redirect()->route('noticias.index')->with('ok', 'La Noticia ha sido editada con éxito');
    }

    public function destroy($id)
    {
        $noticia = Noticia::find($id);

        $noticia->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'delete'
        ]);

        $noticia->delete();

        return redirect()->route('noticias.index')->with('ok', 'La Noticia ha sido eliminada con éxito');
    }

}