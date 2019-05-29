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
        if($user->is('admin|superadmin')) return true;

        if($venta->statusIs('iniciada') && $user->is('operador.in|operador.out')) return true;
        if($venta->statusIs('auditable') && $user->is('auditor')) return true;
        if($venta->statusIs('rechazada') && $user->is('operador.in|operador.out')) return true;
        if($venta->statusIs('confirmada') && $user->is('facturacion')) return true;
        if($venta->statusIs('facturada') && $user->is('logistica')) return true;
        if($venta->statusIs('enviada') && $user->is('logistica')) return true;
    }

}