<?php namespace SmartLine\Http\Controllers;

use SmartLine\Entities\EstadoUser;
use SmartLine\Http\Requests\ChangePasswordRequest;
use SmartLine\Http\Requests\UpdateUserProfileRequest;
use SmartLine\User;
use Illuminate\Support\Facades\Auth;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use SmartLine\Http\Repositories\RoleRepo;
use SmartLine\Http\Repositories\UserRepo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;

class UsersController extends Controller
{
    protected $roleRepo;
    protected $userRepo;

    public function __construct(RoleRepo $roleRepo, UserRepo $userRepo)
    {
        $this->roleRepo = $roleRepo;
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $estadoNuevo = EstadoUser::where('slug', 'nuevo')->first();
        $users = User::where('estado_id', '!=', $estadoNuevo->id)->get();
        //$users = User::with('estado')->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        if(!Auth::user()->is('superadmin')){
            $roles = $roles->reject(function($value){
                return $value->slug == 'superadmin';
            });
        }
        $roles = $roles->lists('name', 'id');

        return view('users.create', compact('roles'));
    }

    public function store(UpdateUserProfileRequest $request)
    {
        $disableStatus = EstadoUser::where('slug', 'nuevo')->first();
        $password = str_random(6);
        $email = $request->email;

        $user = User::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $email,
            'telefono' => $request->telefono,
            'dni' => $request->dni,
            'password' => bcrypt($password),
            'estado_id' => $disableStatus->id
        ]);

        $user->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'create'
        ]);

        foreach($request->roles as $id){

            $role = Role::find($id);

            if(count($request->roles) == 1 && $role->slug == 'superadmin' && !Auth::user()->is('superadmin')){
                $user->forceDelete();
                return abort('403');
            }
            if($role->slug != 'superadmin' && Auth::user()->is('superadmin|admin'))
                $user->roles()->save($role);

        }

        Mail::send('emails.new-user', ['password' => $password], function ($message) use ($email){

            $message->from(config('mail.from.address'), config('mail.from.name'));
            $message->to($email)->subject('Alta al sistema CallCenter');

        });

        if ($user) {

            return redirect()->route('users.index')->with('ok', 'Usuario creado con éxito');

        } else {

            abort(400);

        }
    }

    public function indexDisable()
    {
        $disableUsers = User::onlyTrashed()->get();
        return view('users.index-disable', compact( 'disableUsers'));
    }

    public function indexNuevos()
    {
        $estadoNuevo = EstadoUser::where('slug', 'nuevo')->first();
        $newUsers = User::where('estado_id', $estadoNuevo->id)->get();

        return view('users.index-nuevos', compact( 'newUsers'));
    }

    public function profile($id)
    {
        $user = User::find($id);
        return view('users.profile', compact('user'));
    }

    public function edit($id, $route = null)
    {
        $user = User::find($id);
        $roles = Role::all();

        if(!Auth::user()->is('superadmin')){
            $roles = $roles->reject(function($value){
                return $value->slug == 'superadmin';
            });
        }
        $roles = $roles->lists('name', 'id');

        return view('users.edit', compact('user', 'route', 'roles'));
    }

    public function update(UpdateUserProfileRequest $request, $id, $route = null)
    {
        $user = $this->userRepo->updateUser($id, $request);

        if($route)
            return redirect()->route($route)->with('ok', 'Se han guardado los cambios con éxito');

        return redirect()->route('users.profile', $user->id)->with('ok', 'Se han guardado los cambios con éxito');

    }

    public function changePassword($id)
    {
        $user = User::find($id);
        return view('users.change-password', compact('user'));
    }

    public function blanqueoPassword($id)
    {
        $user = User::find($id);

        if(!$user->email)
            return redirect()->back()->withErrors('No se puede blanquear la contraseña del usuario porque el mismo no tiene un email asociado. Recuerde que una vez blanqueada, la nueva contraseña será enviada al usuario por email.');

        $password = str_random(6);
        $user->password = bcrypt($password);
        $user->save();

        $email = $user->email;


        Mail::send('emails.blanqueo-password', ['password' => $password], function ($message) use ($email){

            $message->from(config('mail.from.address'), config('mail.from.name'));
            $message->to($email)->subject('Blanqueo de contraseña');

        });

        return redirect()->back()->with('ok', 'Contraseña blanqueada con éxito');
    }

    public function storeNewPassword(ChangePasswordRequest $request)
    {
        $user = User::find($request->user_id);

        // Si no es su propia contraseña o no es SUPERADMIN o ADMIN
        if(Auth::user()->id != $user->id && !Auth::user()->is('superadmin|admin'))
            return redirect()->back()->withErrors('Usted no tiene los permisos necesarios para realizar esta acción. Este incidente será reportado');

        // Si la contraseña actual no coincide
        if(!Hash::check($request->current_password, $user->password))
            return redirect()->back()->withErrors('La contraseña actual no es válida');

        $hashedPassword = bcrypt($request->password);

        if($request['password']){
            $user->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'password',
                'former_value' => $user->password,
                'updated_value' => $hashedPassword
            ]);
            $user->password = $hashedPassword;
        }

        $user->save();

        return redirect()->route('users.profile', compact('user'))->with('ok', 'Tu contraseña ha sido cambiada exitosamente');
    }

    public function changeState($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();
        $message = $this->userRepo->changeState($user);
        return redirect()->back()->with('ok', 'El usuario ha sido '.$message.' con éxito');
    }

    public function permissions($id)
    {
        $user = User::find($id);
        $permisos = Permission::all();
        return view('users.permissions', compact('user', 'permisos'));
    }

    public function assignPermissions(Request $request, $id)
    {
        $user = User::find($id);
        $permisos = $request->permissions;

        $user->detachAllPermissions();

        if($permisos){
            foreach($permisos as $key => $permiso){
                $user->attachPermission($permiso);
            }
        }

        return redirect()->route('users.index')->with('ok', 'Se han asignado los permisos correctamente');
    }

}