<?php namespace SmartLine\Http\Controllers;

use Illuminate\Http\Request;

class UpdateablesController extends Controller
{

    public function index()
    {
        return view('updateables.index')->with('entidades', config('sistema.updateables.entidades'));
    }

    public function entidad(Request $request)
    {
        $data['entidad'] = $request->entidad;

        $model = ($data['entidad'] != 'User')? "\SmartLine\Entities\\".$request->entidad : "\SmartLine\\".$request->entidad;
        $query = $model::has('updateable')->with('updateable')->get();

        $data['results'] = $query->map(function ($item) {
            return $item->updateable;
        })->first();

        if(!$data['results'])
            return redirect()->back()->withErrors('No pudieron encontrarse los datos requeridos');

        $data['entidades'] = config('sistema.updateables.entidades');

        return view('updateables.index-datatable')->with($data);
    }

    public function show($entity, $id)
    {
        $model = $entity::find($id);
        if($model->deleted_at != null){
            $data['model'] = $entity::withTrashed('updateable')->where('id', $id)->first();
        }else{
            $data['model'] = $model;
        }

        //dd(substr($data['model']->getClass(), 10));
        $data['results'] = $data['model']->updateable;

        if(!$data['results'])
            return redirect()->back()->withErrors('No pudieron encontrarse los datos requeridos');

        return view('updateables.show')->with($data);
    }

}