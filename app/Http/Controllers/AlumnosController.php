<?php namespace SmartLine\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use SmartLine\Entities\Activacion;
use SmartLine\Entities\Cliente;
use SmartLine\Entities\EstadoCliente;
use SmartLine\Entities\Producto;
use SmartLine\Http\Repositories\ClienteRepo;

class AlumnosController extends Controller
{

    protected $clienteRepo;

    public function __construct(ClienteRepo $clienteRepo)
    {
        $this->clienteRepo = $clienteRepo;
    }

    public function index()
    {
        $clientes = Cliente::has('ventas')->get()->filter(function ($cliente) {
            foreach ($cliente->ventas as $venta) {
                foreach ($venta->productos as $producto) {
                    if($producto->isCurso())
                        return $cliente;
                }
            }
        });

        return view('alumnos.index', compact('clientes'));
    }

    public function cursos($id)
    {
        $cliente = Cliente::find($id);
        return view('alumnos.show')->with(['cliente' => $cliente]);
    }

    public function updateUsername(Request $request, $id)
    {
        $alumno = Cliente::find($id);
        $alumno->username = $request->username;
        $alumno->save();

        return redirect()->back()->with('ok', 'Username modificado con éxito');
    }

    public function habilitarDeshabilitarAlumno($id)
    {
        $data['alumno'] = Cliente::find($id);
        $data['fecha'] = Carbon::today()->format('d/m/Y');



        $data['subject'] = ($data['alumno']->notificado)? 'Activación en la plataforma COEFIX' : 'Nuevos cursos habilitados en COEFIX';


        //dd($data['fecha']);

        //dd($alumno->activaciones);

        //dd($data['alumno']->cursosActivos()->first()->producto);

        Mail::send('emails.alta-coefix', ['data' => $data], function($message) use ($data){
            $message->to($data['alumno']->email);
            $message->subject($data['subject']);
            $message->from('mail@mail.com');
        });



        //$mensaje = ($alumno->estado_id == $habilitado->id)? 'Se ha habilitado con éxito a '.$alumno->fullname.' en los cursos solicitados' : 'Se ha deshabilitado con éxito a '.$alumno->fullname.' en los cursos solicitados';

        //return redirect()->back()->with('ok', $mensaje);
        //return view('emails.alta-coefix')->with($data);
        return redirect()->back()->with('ok', 'Alumno notificado con éxito');
    }

    public function habilitarDeshabilitarCurso($id)
    {
        $activacion = Activacion::find($id);

        $activacion->estado = ($activacion->estado == 0)? 1 : 0;
        $activacion->save();

        //$mensaje = ($activacion->estado == 1)? 'Se ha habilitado con éxito a '.$activacion->cliente->fullname.' en los cursos solicitados' : 'Se ha deshabilitado con éxito a '.$activacion->cliente->fullname.' en los cursos solicitados';
        //return redirect()->back()->with('ok', $mensaje);
        return redirect()->back();
    }



}