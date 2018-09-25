<?php namespace SmartLine\Http\Controllers;

use Illuminate\Http\Request;
use SmartLine\Entities\Asignacion;
use SmartLine\Entities\Cliente;
use SmartLine\User;

class AsignacionesController extends Controller
{

    public function __construct()
    {
        //
    }

    public function index()
    {
        $data['asignaciones'] = Asignacion::all();
        $data['historicas'] = Asignacion::onlyTrashed()->get();
        $data['clientes'] = Cliente::all();

        return view('asignaciones.index')->with($data);
    }

    public function seleccionOperador(Request $request)
    {
        $data['asignaciones'] = Asignacion::all();
        $data['historicas'] = Asignacion::onlyTrashed()->get();
        $data['clientes'] = Cliente::all();
        $data['datos'] = $request['clientes[]'];
        $data['operadores'] = User::all(); // AQUI DEBERÍA FILTRAR SOLAMENTE LOS OPERADORES

        return redirect()->route('asignaciones.index')->with($data);
    }

    public function store(Request $request)
    {
        $supervisor = Auth::user();
        $datos = $request['datos[]'];

        foreach($datos as $key => $id){
            Asignacion::create([
                'supervisor_id' => $supervisor->id,
                'operador_id' => $request['operador_id'],
                'cliente_id' => $id
            ]);
        }

        // BLOQUE DE CÓDIGO QUE ENVIA NOTIFICACIONES A LOS USUARIOS QUE HAN RECIBIDO ASIGNACIONES

        return redirect()->route('asignaciones.index')->with('ok', 'Asignaciones creadas con éxito');
    }


    public function destroy($id)
    {
        $asignacion = Asignacion::find($id);
        $asignacion->delete();

        return redirect()->route('asignaciones.index')->with('ok', 'Asignación eliminada con éxito');
    }

}