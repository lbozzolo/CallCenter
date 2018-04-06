<?php namespace CallCenter\Http\Controllers;

use CallCenter\Entities\Entity;
use CallCenter\Http\Requests\CreateRoleRequest;
use CallCenter\User;
use Bican\Roles\Models\Role;
use CallCenter\Http\Repositories\RoleRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use CallCenter\Http\Controllers\Controller;
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
            'slug' => $request->slug
        ]);
        $roles = Role::all();

        if($role){
            return view('roles.index', compact('roles'))
                ->with('ok', 'El rol '.$role->name.' ha sido creado con éxito');
        }else{
            return redirect()->route('roles.index')->withErrors('No se pudo crear el rol');
        }
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



}