<?php

namespace App\Providers;

use App\Models\Club;
use App\Models\Commentaire;
use App\Models\Commentator;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use PhpParser\Node\Expr\Match_;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isSuperAdmin', function($user){
            return $user->role == 'super-admin';
        });

        Gate::define('isAdmin', function($user){
            return $user->role == 'admin';
        });

        Gate::define('isGuest', function($user){
            return $user->role == 'guest';
        });

        Gate::define('update-club', function (User $user, Club $club) {
            return ($user->club_id === $club->id && $user->role == "manager") || ($user->role == "super-admin" || $user->role == "admin");
        });

        // Gate::define('update-com', function (User $user, Commentaire $commentaire, Commentator $commentator, Match_$match) {
        //     return $commentator->user_id == $user->id &&  $commentaire->commentator_id == $commentator->id
        //     || ($user->role == "super-admin" || $user->role == "admin");
        // });
    }

    
}
