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

    public function notificar($id)
    {
        $data['alumno'] = Cliente::find($id);
        $data['fecha'] = Carbon::today()->format('d/m/Y');

        if (!$data['alumno']->notificado) {
            $data['alumno']->notificado = 1;
            $data['alumno']->save();
            $data['subject'] = 'Activación en la plataforma COEFIX';
        } else {
            $data['subject'] = 'Nuevos cursos habilitados en COEFIX';
        }

        Mail::queue('emails.alta-coefix', ['data' => $data], function ($message) use ($data){
            $message->to('test-lnwbv@mail-tester.com');
            $message->subject($data['subject']);
            $message->from('administracion@crm.coefix.com');
        });
//        Mail::send('emails.alta-coefix', ['data' => $data], function($message) use ($data){
//            $message->to('lucas@verticedigital.com.ar');
//            //$message->to($data['alumno']->email);
//            $message->subject($data['subject']);
//            $message->from('administracion@crm.coefix.com');
//        });

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