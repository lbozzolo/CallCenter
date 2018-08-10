<?php

namespace SmartLine\Http\Requests;

use SmartLine\Entities\EstadoInstitucion;

class CreateInstitucionRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $estados = EstadoInstitucion::all()->count();
        return
            [
                'nombre' => 'required|max:255',
                'direccion' => 'max:255',
                'telefono' => 'numeric',
                'email' => 'email',
                'url' => 'url',
                'responsable' => 'max:255',
                'descripcion' => 'max:255',
                'estado_id' => 'between:1,'.$estados,
            ];
    }

    public function messages()
    {
        return
            [
                'nombre.required' => 'El nombre es obligatorio',
                'nombre.max' => 'El nombre no puede exceder los 255 caracteres',

                'direccion.max' => 'La dirección no puede exceder los 255 caracteres',

                'telefono.numeric' => 'El teléfono debe ser un número',

                'email.email' => 'El formato del email es inválido',

                'url.url' => 'La URL no es válida',

                'responsable.max' => 'El responsable no puede exceder los 255 caracteres',

                'descripcion.max' => 'La descripción no puede exceder los 255 caracteres',

                'estado_id.between' => 'El estado ingresado es inválido',

            ];
    }
}
