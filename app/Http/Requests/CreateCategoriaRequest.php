<?php

namespace SmartLine\Http\Requests;

class CreateCategoriaRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return
            [
                'nombre' => 'required',
                'slug' => 'unique:categorias,slug,' . $this->id,
                'parent_id' => 'required_if:subcategoria,1|exists:categorias,id',
            ];
    }

    public function messages()
    {
        return
            [
                'nombre.required' => 'El nombre es obligatorio',

                'slug.unique' => 'El slug debe ser único. Ya existe una categoría con ese slug',

                'parent_id.exists' => 'La categoría a la que pertenece es incorrecta',
                'parent_id.required_if' => 'La categoría padre es obligatoria'
            ];
    }
}
