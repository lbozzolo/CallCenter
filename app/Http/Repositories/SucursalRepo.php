<?php namespace SmartLine\Http\Repositories;

use Illuminate\Support\Facades\Auth;
use SmartLine\Entities\Sucursal;

class SucursalRepo extends BaseRepo
{
    public function getModel()
    {
        return new Sucursal;
    }

    public function updateUser($id, $request)
    {
        $sucursal = Sucursal::find($id);

        if($request['nombre'] && $request['nombre'] != $sucursal->nombre){
            $sucursal->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'nombre',
                'former_value' => $sucursal->nombre,
                'updated_value' => $request['nombre']
            ]);
            $sucursal->nombre = $request['nombre'];
        }

        if($request['direccion'] && $request['direccion'] != $sucursal->direccion){
            $sucursal->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'direccion',
                'former_value' => $sucursal->direccion,
                'updated_value' => $request['direccion']
            ]);
            $sucursal->direccion = $request['direccion'];
        }

        if($request['telefono'] && $request['telefono'] != $sucursal->telefono){
            $sucursal->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'telefono',
                'former_value' => $sucursal->telefono,
                'updated_value' => $request['telefono']
            ]);
            $sucursal->telefono = $request['telefono'];
        }

        if($request['estado_id'] == 0 || $request['estado_id'] == 1 && $request['estado_id'] != $sucursal->estado){
            $sucursal->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'estado',
                'former_value' => $sucursal->estado,
                'updated_value' => $request['estado_id']
            ]);
            $sucursal->estado = $request['estado_id'];
        }

        $sucursal->save();

        return $sucursal;
    }

}
