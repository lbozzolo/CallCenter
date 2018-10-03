<?php namespace SmartLine\Http\Controllers;

use Illuminate\Http\Request;
use SmartLine\Entities\Asignacion;
use SmartLine\Entities\Cliente;
use SmartLine\User;
use Illuminate\Support\Facades\Auth;
use SmartLine\Http\Repositories\AsignacionRepo;

class AsignacionesController extends Controller
{

    protected $asignacionRepo;

    public function __construct(AsignacionRepo $asignacionRepo)
    {
        $this->asignacionRepo = $asignacionRepo;
    }

    public function index(Request $request)
    {
        $data['asignaciones'] = $this->asignacionRepo->asignacionesActuales();
        $data['historicas'] = Asignacion::withTrashed()->get();
        $data['clientes'] = Cliente::all();
        $data['datosModificar'] = $request->datosModificar;

        return view('asignaciones.index')->with($data);
    }

    public function seleccionOperador(Request $request)
    {
        if(empty($request->clientes))
            return redirect()->back()->withErrors('Debe seleccionar al menos un dato');

        $data['datosModificar'] = $request->clientes;
        $data['datos'] = $this->asignacionRepo->arrayToEloquent($request->clientes);
        $data['asignaciones'] = $this->asignacionRepo->asignacionesActuales();
        $data['historicas'] = Asignacion::withTrashed()->get();
        $data['clientes'] = Cliente::all();
        $data['operadores'] = User::all();
//        $data['operadores'] = User::all()->filter(function ($user){
//            return $user->is('operador.in') || $user->is('operador.out');
//        })->all();

        return view('asignaciones.index')->with($data);
    }

    public function store(Request $request)
    {
        $supervisor = Auth::user();
        $datos = $request->datos;

        foreach($datos as $key => $id){

            $asignacion = Cliente::find($id)->asignacion_actual;

            if($asignacion)
                $asignacion->delete();

            Asignacion::create([
                'supervisor_id' => $supervisor->id,
                'operador_id' => $request['operador_id'],
                'cliente_id' => $id
            ]);
        }

        // BLOQUE DE CÓDIGO QUE ENVIA NOTIFICACIONES A LOS USUARIOS QUE HAN RECIBIDO ASIGNACIONES

        return redirect()->route('asignaciones.index')->with('ok', 'Datos asignados con éxito');
    }

    public function misTareas()
    {
        $operador = Auth::user();
        $asignaciones = $operador->asignaciones_actuales;

        return view('asignaciones.mis-tareas', compact('asignaciones'));
    }

    public function misTareasAnteriores()
    {
        $operador = Auth::user();
        $asignaciones = $operador->asignacionesAnteriores();

        return view('asignaciones.mis-tareas-anteriores', compact('asignaciones'));
    }

    public function destroy($id)
    {
        $asignacion = Asignacion::find($id);
        $asignacion->delete();

        return redirect()->route('asignaciones.index')->with('ok', 'Asignación eliminada con éxito');
    }

}