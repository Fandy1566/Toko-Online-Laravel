<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('Admin', function (User $user) {
            return $user->level === 1;
        });
        Gate::define('Pegawai', function (User $user) {
            return $user->level === 2;
        });
        Gate::define('Customer', function (User $user) {
            return $user->level === 3;
        });
    }
}
