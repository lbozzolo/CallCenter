<?php

namespace SmartLine\Http\Requests;

class CreateMarcaRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return
            [
                'nombre' => 'required|max:255',
                'descripcion' => 'max:255',
            ];
    }

    public function messages()
    {
        return
            [
                'nombre.required' => 'El nombre es obligatorio',
                'nombre.max' => 'El nombre no puede exceder los 255 caracteres',

                'descripcion.required' => 'La descripción no puede exceder los 255 caracteres',
            ];
    }
}
