<?php namespace CallCenter\Http\Repositories;

use CallCenter\User;
use CallCenter\Entities\EstadoUser;
use Illuminate\Support\Facades\Mail;

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
            $user->estado_id = $habilitado->id;
            $user->save();

        }else{

            if($user->estado->slug == 'nuevo'){

                $message = 'habilitado';
                $user->estado_id = $habilitado->id;
                $user->save();

                $data = ['email' => $user->email, 'vista' => 'emails.confirmación-usuario', 'subject' => 'Confirmación de usuario'];
                $this->sendMail($data);

            }else{

                $message = 'deshabilitado';
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

            $message->from(config('mail.from.address'), 'CallCenter');
            $message->to($data['email'])->subject($data['subject']);

        });
    }

}
