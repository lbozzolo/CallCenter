<?php

namespace SmartLine\Http\Requests;

class CreateNoticiaRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return
            [
                'titulo' => 'required|max:255',
                'descripcion' => 'max:5000',
            ];
    }

    public function messages()
    {
        return
            [
                'titulo.required' => 'El título es obligatorio',
                'titulo.max' => 'El título no puede exceder los 255 caracteres',

                'descripcion.required' => 'La descripción no puede exceder los 5000 caracteres',
            ];
    }
}
