<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Utils\UserSession;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('isUserConnected', UserSession::isConnected());
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
