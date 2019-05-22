<?php

namespace SmartLine\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use SmartLine\Entities\Venta;
use SmartLine\User;

class AlterarVentaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function alter(User $user, Venta $venta)
    {
        return $venta->statusIs('iniciada') || $user->is('admin|superadmin');
    }

}