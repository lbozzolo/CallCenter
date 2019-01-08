<?php namespace SmartLine\Http\Controllers;

use Illuminate\Http\Request;
use SmartLine\Entities\Asignacion;
use SmartLine\Entities\Cliente;
use SmartLine\Entities\MotivoReasignacion;
use SmartLine\User;
use Illuminate\Support\Facades\Auth;
use SmartLine\Http\Repositories\AsignacionRepo;
use Illuminate\Support\Facades\Validator;

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
        $data['reasignaciones'] = $this->asignacionRepo->reasignaciones();
        $data['historicas'] = Asignacion::withTrashed()->get();
        $data['clientes'] = Cliente::get(['id', 'nombre', 'apellido', 'dni']);
        //dd($data['clientes']->find(3)->asignacionActual()->motivo);

        // En el caso de que el supervisor esté regresando al index para modificar los datos que ingresó
        $data['datosModificar'] = $request->datosModificar;

        return view('asignaciones.index')->with($data);
    }

    public function seleccionSupervisor(Request $request)
    {
        if(empty($request->clientes))
            return redirect()->back()->withErrors('Debe seleccionar al menos un dato');

        $data['datosModificar'] = $request->clientes;
        $data['datos'] = $this->asignacionRepo->arrayToCollection($request->clientes);
        $data['asignaciones'] = $this->asignacionRepo->asignacionesActuales();
        $data['reasignaciones'] = $this->asignacionRepo->reasignaciones();
        $data['historicas'] = Asignacion::withTrashed()->get();
        $data['clientes'] = Cliente::get(['id', 'nombre', 'apellido', 'dni']);

        // Incluye operadores y supervisores
        $data['operadores'] = User::all()->filter(function ($user){
            return $user->is('operador.in|operador.out|supervisor');
        })->all();

        return view('asignaciones.index')->with($data);
    }

    public function seleccionOperador(Request $request)
    {
        if(empty($request->clientes))
            return redirect()->back()->withErrors('Debe seleccionar al menos un dato');

        $data['datosModificar'] = $request->clientes;
        $data['datos'] = $this->asignacionRepo->arrayToCollection($request->clientes);
        $data['asignaciones'] = $this->asignacionRepo->asignacionesActuales();
        $data['reasignaciones'] = $this->asignacionRepo->reasignaciones();
        $data['historicas'] = Asignacion::withTrashed()->get();
        $data['clientes'] = Cliente::get(['id', 'nombre', 'apellido', 'dni']);
        $data['operadores'] = User::all()->filter(function ($user){
            return $user->is('operador.in|operador.out|supervisor');
        })->all();

        return view('asignaciones.asignaciones-supervisor')->with($data);
    }

    public function store(Request $request)
    {
        // El supervisor puede ser tanto un usuario con el rol de supervisor como un admin
        $supervisor = Auth::user();
        $datos = $request->datos;

        foreach($datos as $key => $id){

            $asignacion = Cliente::find($id)->asignacion_actual;

            if($asignacion)
                $asignacion->delete();

            $asignment = Asignacion::create([
                'supervisor_id' => $supervisor->id,
                'operador_id' => $request['operador_id'],
                'cliente_id' => $id
            ]);
        }

        $asignment->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'create'
        ]);

        // AQUÍ DEBERÍA ESTAR EL BLOQUE DE CÓDIGO QUE ENVIA NOTIFICACIONES A LOS USUARIOS QUE HAN RECIBIDO ASIGNACIONES

        if(Auth::user()->is('supervisor'))
            return redirect()->route('asignaciones.mis.tareas')->with('ok', 'Los datos asignados con éxito');

        return redirect()->route('asignaciones.index')->with('ok', 'Los datos asignados con éxito');
    }

    public function misTareas(Request $request)
    {
        $data['asignaciones'] = Auth::user()->misAsignacionesActuales();
        $data['motivos'] = MotivoReasignacion::all()->pluck('motivo', 'id');
        $data['datosModificar'] = $request->datosModificar;

        return view('asignaciones.mis-tareas')->with($data);
    }

    public function misTareasAnteriores()
    {
        $asignaciones = Auth::user()->asignacionesAnteriores();
        return view('asignaciones.mis-tareas-anteriores', compact('asignaciones'));
    }

    public function tomarAsignacion($id)
    {
        $asignacion = Asignacion::find($id);
        $clienteId = $asignacion->cliente_id;

        $asignacion->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'take'
        ]);

        $asignacion->delete();

        return redirect()->route('ventas.crear', $clienteId);
    }

    public function reasignar($id, Request $request)
    {
        $validator = Validator::make($request->all(), ['motivo_id' => 'required']);

        if ($validator->fails())
            return redirect()->back()->withErrors('No se pudo reasignar. El motivo de la reasignación es obligatorio');

        //dd($request->input());

        $asignacion = Asignacion::find($id);
        $asignacion->operador_id = $asignacion->supervisor_id;
        $asignacion->supervisor_id = Auth::user()->id;
        $asignacion->motivo_id = $request->motivo_id;
        $asignacion->observaciones = $request->observaciones;
        $asignacion->save();

        $asignacion->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'reasignar'
        ]);

        return redirect()->back()->with('ok', 'Dato reasignado con éxito');
    }

    public function destroy($id)
    {
        $asignacion = Asignacion::find($id);

        $asignacion->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'delete'
        ]);

        $asignacion->forceDelete();

        return redirect()->route('asignaciones.index')->with('ok', 'La asignación ha sido eliminada con éxito');
    }

}