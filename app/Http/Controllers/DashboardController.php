<?php namespace SmartLine\Http\Controllers;

use SmartLine\Entities\Banco;
use SmartLine\Entities\Cliente;
use SmartLine\Entities\Entity;
use SmartLine\User;
use Bican\Roles\Models\Role;
use SmartLine\Entities\Categoria;
use SmartLine\Entities\Producto;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SmartLine\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function test()
    {
        $clientes = Cliente::all();

        dd($clientes);
    }

}