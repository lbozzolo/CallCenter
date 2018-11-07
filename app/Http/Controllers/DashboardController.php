<?php namespace SmartLine\Http\Controllers;

use Bican\Roles\Models\Permission;
use Illuminate\Http\Request;
use SmartLine\Entities\Asignacion;
use SmartLine\Entities\Banco;
use SmartLine\Entities\Cliente;
use SmartLine\Entities\Entity;
use SmartLine\Entities\MetodoPago;
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
use SmartLine\Http\Repositories\UpdateableRepo;

class DashboardController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function test()
    {
        if (env('APP_ENV') != 'local')
            abort(404);


        $bbb = 'j';

        dd($bbb);

    }

    public function enviopack()
    {
        $provincias = Provincia::lists('provincia', 'codProvincia');
        return view('enviopack.cotizaciones', compact('provincias'));
    }

}