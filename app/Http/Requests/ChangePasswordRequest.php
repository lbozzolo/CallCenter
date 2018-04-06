<?php

namespace CallCenter\Http\Requests;

class ChangePasswordRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return
            [
                'current_password' => 'required',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6|same:password',
            ];
    }

    public function messages()
    {
        return
            [
                'current_password.required' => 'La contraseña actual es obligatoria',
                'password.required' => 'La nueva contraseña es obligatoria',
                'password.min' => 'La nueva contraseña debe tener al menos 6 caracteres',
                'password.confirmed' => 'La nueva contraseña debe ser confirmada',
                'password_confirmation.required' => 'La confirmación de la nueva contraseña es obligatoria',
                'password_confirmation.min' => 'La confirmación de la nueva contraseña debe tener al menos 6 caracteres',
                'password_confirmation.same' => 'La nueva contraseña y su confirmación no coinciden',
            ];
    }
}
