<?php namespace SmartLine\Http\Controllers;

use Illuminate\Http\Request;
use SmartLine\Entities\Banco;
use SmartLine\Entities\Cliente;
use SmartLine\Entities\Entity;
use SmartLine\Entities\Provincia;
use SmartLine\User;
use SmartLine\Entities\Venta;
use SmartLine\Entities\Reclamo;
use Bican\Roles\Models\Role;
use SmartLine\Entities\Categoria;
use SmartLine\Entities\Producto;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SmartLine\Http\Controllers\Controller;
use SmartLine\Entities\ValidateCreditCard;

class DashboardController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function test()
    {
        $reclamos = DB::table('reclamos')
            ->join('ventas', 'ventas.id', '=', 'reclamos.venta_id')
            ->join('clientes', 'clientes.id', '=', 'ventas.cliente_id')
            ->where('clientes.id', '=', '10')
            ->select('reclamos.*', 'clientes.nombre', 'ventas.id as ventaId')
            ->get();

        $reclamosa = Reclamo::whereHas('venta', function($query){
            $query->where('cliente_id', '=', '26');
        })->get();

        $data = ['provincia' => 'C', 'codigoPostal' => '1405', 'peso' => '1.5', 'paquetes' => '20x3x5', 'direccionEnvio' => ''];

        return redirect('../ws/cotizaciones/correos');

    }

    public function enviopack()
    {
        $provincias = Provincia::lists('provincia', 'codProvincia');
        return view('enviopack.cotizaciones', compact('provincias'));
    }

}