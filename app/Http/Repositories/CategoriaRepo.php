<?php namespace SmartLine\Http\Repositories;

use SmartLine\Entities\Categoria;

class CategoriaRepo extends BaseRepo
{
    public function getModel()
    {
        return new Categoria;
    }

    public function setToSlug($slug, $name)
    {
        return ($slug)? str_slug($slug, '.') : str_slug($name, '.');
    }


}
