<?php

namespace CallCenter\Http\Requests;

class UpdateUserProfileRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return
            [
                'nombre' => 'required|max:45',
                'apellido' => 'required|max:45',
                'email' => 'email|required|unique:users,email,'.$this->id
            ];
    }

    public function messages()
    {
        return
            [
                'nombre.required' => 'El nombre es obligatorio',
                'nombre.max' => 'El nombre no puede exceder los 45 caracteres',
                'apellido.required' => 'El apellido es obligatorio',
                'apellido.max' => 'El apellido no puede exceder los 45 caracteres',
                'email.email' => 'El email no tiene un formato válido',
                'email.required' => 'El email es obligatorio',
                'email.unique' => 'Ya existe un usuario con ese email',
            ];
    }
}
