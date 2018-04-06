<?php namespace CallCenter\Http\Controllers;

use CallCenter\Entities\Banco;
use CallCenter\Entities\Entity;
use CallCenter\Http\Requests\ChangePasswordRequest;
use CallCenter\Http\Requests\UpdateUserProfileRequest;
use CallCenter\User;
use Illuminate\Support\Facades\Hash;
use Bican\Roles\Models\Role;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use CallCenter\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index()
    {
        return view('users.index');
    }

    public function profile($id)
    {
        $user = User::find($id);
        return view('users.profile', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserProfileRequest $request, $id)
    {
        $user = User::find($id);
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->email = $request->email;
        $user->save();

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

}