<?php

namespace App\Providers;

use App\Http\Controllers\HomeController;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            view()->composer('*', function ($view)
            {
                $misproyectos = Proyecto::all();
                View::share('misproyectos', $misproyectos );
            });
    }
}
