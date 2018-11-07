<?php namespace SmartLine\Http\Repositories;

use Illuminate\Database\Eloquent\SoftDeletes;
use SmartLine\Entities\Updateable;

class UpdateableRepo extends BaseRepo
{
    use SoftDeletes;

    public function getModel()
    {
        return new Updateable;
    }


}
