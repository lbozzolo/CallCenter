<?php namespace CallCenter\Http\Controllers;

use CallCenter\Http\Requests\CreateRoleRequest;
use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;
use CallCenter\Http\Repositories\RoleRepo;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    protected $roleRepo;

    public function __construct(RoleRepo $roleRepo)
    {
        $this->roleRepo = $roleRepo;
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
                ->with('ok', 'El rol '.$role->name.' ha sido creado con éxito');
        }else{
            return redirect()->route('roles.index')->withErrors('No se pudo crear el rol');
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

        return redirect()->back()->with('ok', 'El rol se ha actualizado con éxito');
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $usersWithRole = $this->roleRepo->roleHasActiveUsers($id);

        if($usersWithRole){
            return redirect()->route('roles.index')
                ->withErrors('No se puede eliminar el rol "'.$role->name.'"" porque tiene usuarios asignados');
        }

        $role->delete();

        return redirect()->route('roles.index')->with('ok', 'Rol eliminado con éxito');

    }

    public function permissions($id)
    {
        $role = Role::find($id);
        $permisos = Permission::all();
        return view('roles.permissions', compact('role', 'permisos'));
    }

    public function assignPermissions(Request $request, $id)
    {
        $role = Role::find($id);
        $permisos = $request->permissions;

        $role->detachAllPermissions();

        foreach($permisos as $key => $permiso){
            $role->attachPermission($permiso);
        }

        return redirect()->route('roles.index')->with('ok', 'Se han asignado los permisos correctamente');
    }



}