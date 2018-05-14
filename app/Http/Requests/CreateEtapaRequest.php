<?php

namespace SmartLine\Http\Requests;



class CreateEtapaRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return ['nombre' => 'required|max:255'];
    }

    public function messages()
    {
        return
            [
                'nombre.required' => 'El nombre de la etapa es obligatorio',
                'nombre.max' => 'El nombre de la etapa no puede exceder los 255 caracteres',
            ];
    }
}
