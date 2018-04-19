<?php namespace SmartLine\Http\Controllers;

use SmartLine\Entities\EstadoUser;
use SmartLine\Http\Requests\ChangePasswordRequest;
use SmartLine\Http\Requests\UpdateUserProfileRequest;
use SmartLine\User;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use SmartLine\Http\Repositories\RoleRepo;
use SmartLine\Http\Repositories\UserRepo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $users = User::with('estado')->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all()->reject(function ($value) {
            return $value->slug == 'superadmin';
        })->lists('name', 'id');

        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
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

        foreach($request->roles as $id){
            $user->attachRole(Role::find($id));
        }

        Mail::send('emails.new-user', ['password' => $password], function ($message) use ($email){

            $message->from('callcenter@gmail.com', 'CallCenter');
            $message->to($email)->subject('Alta al sistema CallCenter');

        });

        if($user){
            return redirect()->route('users.index')->with('ok', 'Usuario creado con éxito');
        }else{ abort(400);}
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
        $roles = Role::lists('name', 'id');
        $rolesActuales = $this->roleRepo->listWithoutLastComma($user);

        return view('users.edit', compact('user', 'route', 'roles', 'rolesActuales'));
    }

    public function update(UpdateUserProfileRequest $request, $id, $route = null)
    {
        $user = User::find($id);

        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
        $user->dni = $request->dni;
        $user->roles()->sync($request->roles);

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
        $message = $this->userRepo->changeState($user);

        if($message == 'habilitado'){
            return redirect()->route('users.index.disable')->with('ok', 'El usuario ha sido '.$message.' con éxito');
        }else{
            return redirect()->route('users.index')->with('ok', 'El usuario ha sido '.$message.' con éxito');
        }
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

        foreach($permisos as $key => $permiso){
            $user->attachPermission($permiso);
        }

        return redirect()->route('users.index')->with('ok', 'Se han asignado los permisos correctamente');
    }

}