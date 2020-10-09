<?php

namespace SmartLine\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class EntrustCustomServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('permission', function($expression) {
            return "<?php if (Auth::user()->canDo({$expression})) : ?>";
        });

        Blade::directive('endpermission', function($expression) {
            return "<?php endif; ?>";
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
