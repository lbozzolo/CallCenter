<?php

namespace SmartLine;

use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;
use SmartLine\Entities\Asignacion;
use SmartLine\Entities\EstadoUser;
use Illuminate\Auth\Authenticatable;
use SmartLine\Entities\Venta;
use SmartLine\Entities\Entity;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use SmartLine\Entities\Imagen;
use SmartLine\Entities\Llamada;


class User extends Entity implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract,
                                    HasRoleAndPermissionContract
{
    use Authenticatable, Authorizable, CanResetPassword, HasRoleAndPermission, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $fillable = ['nombre', 'apellido', 'email', 'telefono', 'dni', 'password', 'estado_id'];
    protected $dates = ['deleted_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function getFullNameAttribute()
    {
        return $this->nombre.' '.$this->apellido;
    }

    public function getProfileImageAttribute()
    {
        foreach($this->images as $imagen){
            if($imagen->principal == 1){
                return $imagen->path;
            }
        }
    }

    public function getRolesIdsAttribute()
    {
        return $this->roles()->get()->lists('id')->toArray();
    }

    //RelationShips

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function estado()
    {
        return $this->belongsTo(EstadoUser::class);
    }

    public function llamadas()
    {
        return $this->hasMany(Llamada::class);
    }

    public function images()
    {
        return $this->morphMany(Imagen::class, 'imageable');
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class);
    }


}
