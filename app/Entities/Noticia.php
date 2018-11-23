<?php

namespace SmartLine\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use SmartLine\User;

class Noticia extends Entity
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'noticias';
    protected $fillable = ['user_id', 'titulo', 'descripcion'];

    static function todaysNews()
    {
        $today = Carbon::today()->format('Y-m-d');
        return Noticia::whereDate('created_at', 'like', $today)->count();
    }

    public function isTodaysNew()
    {
        $today = Carbon::today()->format('Y-m-d');
        return $this->created_at >= $today;
    }

    public function getRolesIdsAttribute()
    {
        return $this->destinatarios()->get()->lists('role_id')->toArray();
    }

    // Relationships

    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function destinatarios()
    {
        return $this->hasMany(Destinatario::class, 'noticia_id');
    }

    public function updateable()
    {
        return $this->morphMany(Updateable::class, 'updateable');
    }

}