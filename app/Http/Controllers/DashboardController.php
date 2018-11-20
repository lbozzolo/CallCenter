<?php namespace SmartLine\Http\Controllers;

use SmartLine\Entities\Cliente;
use SmartLine\Entities\Provincia;
use SmartLine\Entities\Venta;
use SmartLine\Http\Repositories\AsignacionRepo;
use Carbon\Carbon;


class DashboardController extends Controller
{
    protected $cliente;
    protected $asignacion;
    protected $venta;

    public function __construct(Cliente $cliente, AsignacionRepo $asignacion, Venta $venta)
    {
        $this->cliente = $cliente;
        $this->asignacion = $asignacion;
        $this->venta = $venta;
    }

    public function index()
    {
        $thisMonth = Carbon::now()->startOfMonth();
        $data['clientes'] = $this->cliente->count();
        $data['clientesNuevos'] = $this->cliente->where('estado_id', '1')->count();
        $data['clientesFrecuentes'] = $this->cliente->where('estado_id', '2')->count();
        $data['asignacionesActuales'] = $this->asignacion->asignacionesActuales()->count();
        $data['ventas'] = $this->venta->count();
        $data['ventasDelMes'] = $this->venta->where('created_at', '>=', $thisMonth)->count();
        //dd($data);
        return view('welcome')->with($data);
    }

    public function test()
    {
        if (env('APP_ENV') != 'local')
            abort(404);


        $bbb = 'j';
        $password = 'lucas pruebas';
        return view('emails.blanqueo-password')->with('password', $password);
    
    }


    public function enviopack()
    {
        $provincias = Provincia::lists('provincia', 'codProvincia');
        return view('enviopack.cotizaciones', compact('provincias'));
    }

}