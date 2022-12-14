<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use App\Models\Rencontre;
use Illuminate\Support\Facades\View;
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
        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // JsonResource::withoutWrapping();

        $liveMatchs = Rencontre::where('date_match','>=', Carbon::now()->today())
            ->where(function($query) {
                $query->where('live', '!=', 'attente');
            })->get();
        View::share('liveMatches', $liveMatchs);
        
        

        setlocale(LC_ALL, "fr");
        Carbon::setLocale('fr');
        // URL::forceScheme('https');
    }
}
