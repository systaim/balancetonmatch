<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

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

        setlocale(LC_ALL, "fr");
        Carbon::setLocale('fr');
        // URL::forceScheme('https');
        JsonResource::withoutWrapping();
    }
}
