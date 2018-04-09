<?php namespace CallCenter\Http\Controllers;

use CallCenter\Entities\Banco;
use CallCenter\Entities\Entity;
use CallCenter\User;
use Bican\Roles\Models\Role;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use CallCenter\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function test()
    {
        $roles = Role::all();
        $role = $roles->except(['1', '4'])->random();
        $user = User::first();

        $models = Entity::getModels();
        $names = ['banco', 'categoría', 'cliente', 'etapa', 'forma de pago', 'imagen', 'institución', 'llamada', 'método de pago', 'producto', 'promoción', 'reclamo', 'usuario', 'venta',];
        $acciones = array_combine($models, $names);

        dd($acciones);
    }

}