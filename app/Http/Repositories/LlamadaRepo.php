<?php namespace SmartLine\Http\Repositories;

use Illuminate\Database\Eloquent\SoftDeletes;
use SmartLine\Entities\Llamada;

class LlamadaRepo extends BaseRepo
{
    use SoftDeletes;

    public function getModel()
    {
        return new Llamada;
    }


    public function getProductosInactivos()
    {
        //
    }


}
