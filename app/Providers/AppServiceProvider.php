<?php

namespace SmartLine\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use SmartLine\Entities\Asignacion;
use SmartLine\Entities\Cliente;
use SmartLine\Entities\DatoTarjeta;
use SmartLine\Entities\Domicilio;
use SmartLine\Entities\EstadoCliente;
use SmartLine\Entities\EstadoProducto;
use SmartLine\Entities\EstadoReclamo;
use SmartLine\Entities\EstadoUser;
use SmartLine\Entities\EstadoVenta;
use SmartLine\Entities\FormaPago;
use SmartLine\Entities\MetodoPago;
use SmartLine\Entities\MetodoPagoVenta;
use SmartLine\Entities\Noticia;
use SmartLine\Entities\Reclamo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Relation::morphMap([
            'asignacion' => Asignacion::class,
            'cliente' => Cliente::class,
            'datoTarjeta' => DatoTarjeta::class,
            'domicilio' => Domicilio::class,
            'estadoCliente' => EstadoCliente::class,
            'estadoProducto' => EstadoProducto::class,
            'estadoReclamo' => EstadoReclamo::class,
            'estadoUser' => EstadoUser::class,
            'estadoVenta' => EstadoVenta::class,
            'formaPago' => FormaPago::class,
            'metodoPago' => MetodoPago::class,
            'metodoPagoVenta' => MetodoPagoVenta::class,
            'noticia' => Noticia::class,
            'producto' => \SmartLine\Entities\Producto::class,
            'reclamo' => Reclamo::class,
            'user' => \SmartLine\User::class,
            'venta' => \SmartLine\Entities\Venta::class,
        ]);
    }
}
