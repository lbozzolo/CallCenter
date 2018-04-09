<?php namespace CallCenter\Http\Controllers;

use CallCenter\Entities\EstadoUser;
use CallCenter\Http\Requests\ChangePasswordRequest;
use CallCenter\Http\Requests\UpdateUserProfileRequest;
use CallCenter\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;


class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        $disableUsers = User::onlyTrashed()->get();
        return view('users.index', compact('users', 'disableUsers'));
    }

    public function indexDisable()
    {
        $disableUsers = User::onlyTrashed()->get();
        return view('users.index-disable', compact( 'disableUsers'));
    }

    public function profile($id)
    {
        $user = User::find($id);
        return view('users.profile', compact('user'));
    }

    public function edit($id, $route = null)
    {
        $user = User::find($id);
        return view('users.edit', compact('user', 'route'));
    }

    public function update(UpdateUserProfileRequest $request, $id, $route = null)
    {
        $user = User::find($id);
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
        $user->dni = $request->dni;
        $user->save();

        if($route){
            return redirect()->route($route)->with('ok', 'Se han guardado los cambios con éxito');
        }
        return redirect()->route('users.profile', $user->id)->with('ok', 'Se han guardado los cambios con éxito');

    }

    public function changePassword($id)
    {
        return view('users.change-password')->with(['userId' => $id]);
    }

    public function storeNewPassword(ChangePasswordRequest $request)
    {
        $user = User::find($request->user_id);

        if(!Hash::check($request->current_password, $user->password)){
            return redirect()->back()->withErrors('La contraseña actual no es válida');
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('users.profile', compact('user'))->with('ok', 'Tu contraseña ha sido cambiada exitosamente');
    }

    public function changeState($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();
        $habilitado = EstadoUser::where('slug', 'habilitado')->first();
        $deshabilitado = EstadoUser::where('slug', 'deshabilitado')->first();

        if($user->trashed()){
            $message = 'habilitado';
            $user->restore();
            $user->estado_id = $habilitado->id;
            $user->save();
        }else{
            $message = 'deshabilitado';
            $user->estado_id = $deshabilitado->id;
            $user->save();
            $user->delete();
        }

        return redirect()->route('users.index')->with('ok', 'El usuario ha sido '.$message.' con éxito');
    }

    public function permissions($id)
    {
        $user = User::find($id);
        $permisos = Permission::all();
        return view('users.permissions', compact('user', 'permisos'));
    }

    public function assignPermissions(Request $request, $id)
    {
        $user = Role::find($id);
        $permisos = $request->permissions;

        $user->detachAllPermissions();

        foreach($permisos as $key => $permiso){
            $user->attachPermission($permiso);
        }

        return redirect()->route('users.index')->with('ok', 'Se han asignado los permisos correctamente');
    }

}