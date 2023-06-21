<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;

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
    //If the function returns true, the “gate” is open – user is authorized. If the function returns false, the “gate” is closed – user is not authorized.
    public function boot(): void
    {
        Gate::define('administrar', function (User $user) {
            return $user->user_type === 'A';
        });

        //adicionado para users bloqueados:
        Gate::define('userActive', function (User $user) {
            return !$user->blocked;
        });
    }
}
