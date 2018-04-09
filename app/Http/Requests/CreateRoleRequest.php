<?php

namespace CallCenter\Http\Requests;


class CreateRoleRequest extends Request
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
                'level' => 'numeric|min:1|max:10',
                'slug' => 'unique:roles,slug,' . $this->id,
            ];
    }

    public function messages()
    {
        return
            [
                'name.required' => 'El nombre del rol es obligatorio',

                'description.max' => 'La descripción no debe exceder los 255 caracteres',

                'level.numeric' => 'El nivel de usuario debe ser un número',
                'level.min' => 'El nivel de usuario debe estar comprendido entre 1 y 10',
                'level.max' => 'El nivel de usuario debe estar comprendido entre 1 y 10',

                'slug.unique' => 'El slug debe ser único. Ya existe un rol con ese slug'
            ];
    }
}
