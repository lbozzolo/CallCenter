<?php namespace SmartLine\Http\Controllers;

use SmartLine\Http\Requests\CreateRoleRequest;
use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;
use SmartLine\Http\Repositories\RoleRepo;
use Illuminate\Http\Request;
use SmartLine\Entities\Entity;

class RolesController extends Controller
{
    protected $roleRepo;

    public function __construct(RoleRepo $roleRepo)
    {
        $this->roleRepo = $roleRepo;
        $this->middleware('role:superadmin');
    }

    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create(CreateRoleRequest $request)
    {
        $role =Role::create([
            'name' => $request->name,
            'description' => $request->description,
            'level' => $request->level,
            'slug' => $this->roleRepo->setToSlug($request->slug, $request->name)
        ]);
        $roles = Role::all();

        if($role){
            return view('roles.index', compact('roles'))
                ->with('ok', 'El Rol '.$role->name.' ha sido creado con éxito');
        }else{
            return redirect()->route('roles.index')->withErrors('No se pudo crear el Rol');
        }
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $roles = Role::all();

        return view('roles.edit', compact('roles', 'role'));
    }

    public function update(CreateRoleRequest $request, $id)
    {
        $role = Role::find($id);

        $role->name = $request->name;
        $role->description = $request->description;
        $role->slug = $this->roleRepo->setToSlug($request->slug, $request->name);
        $role->level = $request->level;

        $role->save();

        return redirect()->back()->with('ok', 'El Rol se ha actualizado con éxito');
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $usersWithRole = $this->roleRepo->roleHasActiveUsers($id);

        if($usersWithRole){
            return redirect()->route('roles.index')
                ->withErrors('No se puede eliminar el Rol "'.$role->name.'"" porque tiene Usuarios asignados');
        }

        $role->delete();

        return redirect()->route('roles.index')->with('ok', 'Rol eliminado con éxito');

    }

    public function permissions($id)
    {
        $role = Role::find($id);
        $permisos = Permission::all();
        $models = Entity::getModels();
        $quantity = round(count($models) / 3);
        $models = array_chunk($models, $quantity);
        $names = ['marca' => 'Marca', 'banco' => 'Banco', 'asignacion' => 'Asignación', 'categoria' => 'Categoría', 'cliente' => 'Cliente', 'datoTarjeta' => 'Datos de tarjeta', 'ticket' => 'Soporte', 'etapa' => 'Etapa', 'formaPago' => 'Forma de pago', 'imagen' => 'Imagen', 'institucion' => 'Institución', 'llamada' => 'Llamada', 'noticia' => 'Noticia', 'metodoPago' => 'Método de pago', 'producto' => 'Producto', 'promocion' => 'Promoción', 'reclamo' => 'Reclamo', 'updateable' => 'Updateable', 'user' => 'Usuario', 'venta' => 'Venta',];

        return view('roles.permissions', compact('role', 'permisos', 'models', 'names'));
    }

    public function assignPermissions(Request $request, $id)
    {
        $role = Role::find($id);
        $permisos = $request->permissions;

        $role->detachAllPermissions();

        if($permisos){
            foreach($permisos as $key => $permiso){
                $role->attachPermission($permiso);
            }
        }


        return redirect()->route('roles.index')->with('ok', 'Se han asignado los Permisos correctamente');
    }



}