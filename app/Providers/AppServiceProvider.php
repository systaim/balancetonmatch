<?php

namespace App\Providers;

use App\Http\Controllers\Api\MatchController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use App\Models\Match;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('matches')) {
            $liveMatchs = Match::where('date_match','>=', Carbon::now()->subMinutes(120))
                ->where(function($query) {
                    $query->where('live', '!=', 'attente')->where('live', '!=', 'finDeMatch');
                })->get();
            View::share('liveMatches', $liveMatchs);
        }
        
        

        setlocale(LC_ALL, "fr");
        Carbon::setLocale('fr');
        // URL::forceScheme('https');
    }
}
