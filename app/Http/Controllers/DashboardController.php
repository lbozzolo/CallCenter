<?php namespace SmartLine\Http\Controllers;

use Bican\Roles\Models\Permission;
use SmartLine\Entities\Cliente;
use SmartLine\Entities\Noticia;
use SmartLine\Entities\Producto;
use SmartLine\Entities\Provincia;
use SmartLine\Entities\Reclamo;
use SmartLine\Entities\Venta;
use SmartLine\Http\Repositories\VentaRepo;
use SmartLine\Http\Repositories\AsignacionRepo;
use Carbon\Carbon;
use SmartLine\User;


class DashboardController extends Controller
{
    protected $cliente;
    protected $asignacion;
    protected $venta;
    protected $reclamo;
    protected $user;
    protected $producto;
    protected $noticia;
    protected $ventaRepo;

    public function __construct(Cliente $cliente, AsignacionRepo $asignacion, Venta $venta, Reclamo $reclamo, User $user, Producto $producto, Noticia $noticia, VentaRepo $ventaRepo)
    {
        $this->cliente = $cliente;
        $this->asignacion = $asignacion;
        $this->venta = $venta;
        $this->reclamo = $reclamo;
        $this->user = $user;
        $this->producto = $producto;
        $this->noticia = $noticia;
        $this->ventaRepo = $ventaRepo;
    }

    public function index()
    {
        $thisMonth = Carbon::now()->startOfMonth();
        $thisWeek = Carbon::now()->startOfWeek();
        $data['clientes'] = $this->cliente->count();
        $data['clientesNuevos'] = $this->cliente->where('estado_id', '1')->count();
        $data['clientesFrecuentes'] = $this->cliente->where('estado_id', '2')->count();

        $data['asignacionesActuales'] = $this->asignacion->asignacionesActuales()->count();

        $data['ventas'] = $this->venta->count();
        $data['ventasDelMes'] = $this->venta->where('created_at', '>=', $thisMonth)->count();
        $data['ventasDeLaSemana'] = $this->venta->where('created_at', '>=', $thisWeek)->count();

        $data['reclamos'] = $this->reclamo->count();
        $data['reclamosAbiertos'] = $this->reclamo->where('estado_id', '1')->count();
        $data['reclamosCerrados'] = $this->reclamo->where('estado_id', '2')->count();

        $data['usuarios'] = $this->user->count();
        $data['usuariosHabilitados'] = $this->user->where('estado_id', '1')->count();
        $data['usuariosDeshabilitados'] = $this->user->where('estado_id', '2')->count();
        $data['usuariosNuevos'] = $this->user->where('estado_id', '3')->count();

        $data['productos'] = $this->producto->count();
        $data['productosActivos'] = $this->producto->where('estado_id', '1')->count();
        $data['productosInactivos'] = $this->producto->where('estado_id', '2')->count();

        $data['noticias'] = $this->noticia->withTrashed()->count();
        $data['noticiasActivas'] = $this->noticia->count();
        $data['noticiasInactivas'] = $this->noticia->onlyTrashed()->count();

        $data['facturacion'] = $this->ventaRepo->getFacturacion();
        $data['facturacionFacturadas'] = $this->ventaRepo->getFacturacionByEstado('facturada');
        $data['facturacionEntregadas'] = $this->ventaRepo->getFacturacionByEstado('entregado');

        return view('welcome')->with($data);
    }

    public function test()
    {
        if (env('APP_ENV') != 'local')
            abort(404);

        $data = [];
        $roles = ['admin' => 'admin', 'operadorIn' => 'operador.in', 'operadorOut' => 'operador.out', 'auditor' => 'auditor', 'supervisor' => 'supervisor', 'logistica' => 'logistica', 'facturacion' => 'facturacion', 'atencionCliente' => 'atencion.al.cliente'];
        $permissionsFlatten = config('sistema.permission-flatten');

        foreach($roles as $name => $slug){

            $role = \Bican\Roles\Models\Role::where('slug', $slug)->first();
            $slugged = str_replace(".","-",$slug);
            $permissions = $permissionsFlatten;
            $deniedPermissions = config('sistema.permissions-roles.'.$slugged);

            foreach ($deniedPermissions as $key => $value) {
                unset($permissions[array_search($value, $permissions)]);
            }

            $data['permissions'][$slug] = $permissions;

            foreach($data['permissions'][$slug] as $permissionSlug){
                $permissionId = \Bican\Roles\Models\Permission::where('slug', $permissionSlug)->first()->id;
                DB::table('permission_role')->insert([
                    'permission_id' => $permissionId,
                    'role_id' => $role->id
                ]);
            }

        }

        dd($data);



        dd($permissions);

    
    }


    public function enviopack()
    {
        $provincias = Provincia::lists('provincia', 'codProvincia');
        return view('enviopack.cotizaciones', compact('provincias'));
    }

}