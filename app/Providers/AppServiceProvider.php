<?php

namespace App\Providers;

use App\Models\moveset;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('access-admin', function (User $user) {
            return $user->role === 'admin';
        });
        Gate::define('access-creator', function (User $user) {
            return $user->role === 'creator';
        });
        Gate::define('active', function (moveset $moveset) {
            return $moveset->is_active;
        });
    }
}
