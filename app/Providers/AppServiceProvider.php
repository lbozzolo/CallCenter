<?php

namespace SmartLine\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

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
            'producto' => \SmartLine\Entities\Producto::class,
            'user' => \SmartLine\User::class,
            'venta' => \SmartLine\Entities\Venta::class,
        ]);
    }
}
