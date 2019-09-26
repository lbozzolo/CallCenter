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
        if ($request->entidad == '')
            return redirect()->back()->withErrors('Debe seleccionar un modelo');

        $data['entidad'] = $request->entidad;

        $model = ($data['entidad'] != 'User')? "\SmartLine\Entities\\".$request->entidad : "\SmartLine\\".$request->entidad;
        $query = $model::has('updateable')->with('updateable')->get();

        $data['results'] = collect();

        foreach($query as $key => $value){
            $data['results'][$key] = $value->updateable;
        }

        $data['results'] = $data['results']->collapse();

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

        $data['results'] = $data['model']->updateable;

        if(!$data['results'])
            return redirect()->back()->withErrors('No pudieron encontrarse los datos requeridos');

        return view('updateables.show')->with($data);
    }

}