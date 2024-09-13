<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Auth\Access\Authorizable;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        App(Gate::class)->before(function(Authorizable $auth, $route) {
            if (method_exists($auth, 'hasPermission')){
                return $auth->hasPermission($route) ? $auth->hasPermission($route): false;
            }
            return false;
        });
    }
}
