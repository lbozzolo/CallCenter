<?php

namespace SmartLine\Http\Requests;


use SmartLine\Entities\Entity;

class CreatePermissionRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return
            [
                'name' => 'required',
                'description' => 'max:255',
                'slug' => 'unique:permissions,slug,'.$this->id,
                'model' => 'numeric'
            ];
    }

    public function messages()
    {
        return
            [
                'name.required' => 'El nombre del permiso es obligatorio',

                'description.max' => 'La descripción no debe exceder los 255 caracteres',

                'slug.unique' => 'El slug debe ser único. Ya existe un permiso con ese slug',

                'model.in' => 'El modelo seleccionado no es válido'
            ];
    }
}
