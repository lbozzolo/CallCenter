<?php namespace SmartLine\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use SmartLine\Entities\Activacion;
use SmartLine\Entities\Cliente;
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
                if($venta->statusIs('confirmada')){
                    foreach ($venta->productos as $producto) {
                        if($producto->isCurso())
                            return $cliente;
                    }
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

    public function notificar($id)
    {
        $data['alumno'] = Cliente::find($id);
        $data['fecha'] = Carbon::today()->format('d/m/Y');

        if ($data['alumno']->notificado == 0) {

            $data['alumno']->notificado = 1;
            $data['nuevo'] = true;
            $data['alumno']->save();
            $data['subject'] = 'Activación en la plataforma COEFIX';

            // Updateables

            $data['alumno']->updateable()->create(['user_id' => Auth::user()->id, 'action' => 'notifyCoefix']);
            $data['alumno']->updateable()->create(['user_id' => Auth::user()->id, 'action' => 'notifyCourses']);

        } else {

            $data['subject'] = 'Nuevos cursos habilitados en COEFIX';

            // Updateables

            $data['alumno']->updateable()->create(['user_id' => Auth::user()->id, 'action' => 'notifyCourses']);

        }

        Mail::queue('emails.alta-coefix', ['data' => $data], function ($message) use ($data){
            $message->to($data['alumno']->email);
            $message->subject($data['subject']);
            $message->from(config('mail.from.address'), config('mail.from.name'));
            $message->setContentType('text/html');
        });

        return redirect()->back()->with('ok', 'Alumno notificado con éxito');
    }

    public function habilitarDeshabilitarCurso($id)
    {
        $activacion = Activacion::find($id);
        $cliente = $activacion->cliente;

        $activacion->estado = ($activacion->estado == 0)? 1 : 0;
        $activacion->save();

        $cliente->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => ($activacion->estado == 0)? 'lock' : 'activate',
            'related_model_id' => $activacion->producto->id,
            'related_model_type' => 'producto'
        ]);

        return redirect()->back();
    }



}