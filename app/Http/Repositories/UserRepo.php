<?php namespace SmartLine\Http\Repositories;

use SmartLine\User;
use SmartLine\Entities\EstadoUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class UserRepo extends BaseRepo
{
    public function getModel()
    {
        return new User;
    }

    public function changeState($user)
    {
        $habilitado = EstadoUser::where('slug', 'habilitado')->first();
        $deshabilitado = EstadoUser::where('slug', 'deshabilitado')->first();

        if($user->trashed()){

            $message = 'habilitado';
            $user->restore();

            $user->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'estado_id',
                'former_value' => $user->estado_id,
                'updated_value' => $habilitado->id
            ]);

            $user->estado_id = $habilitado->id;
            $user->save();

        }else{

            if($user->estado->slug == 'nuevo'){

                $message = 'habilitado';

                $user->updateable()->create([
                    'user_id' => Auth::user()->id,
                    'action' => 'update',
                    'field' => 'estado_id',
                    'former_value' => $user->estado_id,
                    'updated_value' => $habilitado->id
                ]);

                $user->estado_id = $habilitado->id;
                $user->save();

                $data = ['email' => $user->email, 'vista' => 'emails.confirmación-usuario', 'subject' => 'Confirmación de usuario'];
                $this->sendMail($data);

            }else{

                $message = 'deshabilitado';

                $user->updateable()->create([
                    'user_id' => Auth::user()->id,
                    'action' => 'update',
                    'field' => 'estado_id',
                    'former_value' => $user->estado_id,
                    'updated_value' => $deshabilitado->id
                ]);

                $user->estado_id = $deshabilitado->id;
                $user->save();
                $user->delete();

            }

        }

        return $message;
    }

    public function sendMail($data)
    {
        Mail::send($data['vista'], $data, function ($message) use ($data){

            $message->from(config('mail.from.address'), 'SmartLine');
            $message->to($data['email'])->subject($data['subject']);

        });
    }

    public function updateUser($id, $request)
    {
        $user = User::find($id);

        if($request['nombre'] && $request['nombre'] != $user->nombre){
            $user->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'nombre',
                'former_value' => $user->nombre,
                'updated_value' => $request['nombre']
            ]);
            $user->nombre = $request['nombre'];
        }

        if($request['apellido'] && $request['apellido'] != $user->apellido){
            $user->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'apellido',
                'former_value' => $user->apellido,
                'updated_value' => $request['apellido']
            ]);
            $user->apellido = $request['apellido'];
        }

        if($request['email'] && $request['email'] != $user->email){
            $user->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'email',
                'former_value' => $user->email,
                'updated_value' => $request['email']
            ]);
            $user->email = $request['email'];
        }

        if($request['telefono'] && $request['telefono'] != $user->telefono){
            $user->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'telefono',
                'former_value' => $user->telefono,
                'updated_value' => $request['telefono']
            ]);
            $user->telefono = $request['telefono'];
        }

        if($request['dni'] && $request['dni'] != $user->dni){
            $user->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'dni',
                'former_value' => $user->dni,
                'updated_value' => $request['dni']
            ]);
            $user->dni = $request['dni'];
        }

        if($request['roles'])
            $user->roles()->sync($request->roles);

        $user->save();

        return $user;
    }

}
