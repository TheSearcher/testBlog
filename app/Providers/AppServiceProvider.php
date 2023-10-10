<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);

        Gate::define('admin-access',function(User $user){
            if( $user->hasRole('admin') && $user->hasPermission('admin-can-access')){
                return true;
            }
            return false;
        });
        Gate::define('auth-user-access',function(User $user){
            if( $user->hasRole('authenticated-user') && $user->hasPermission('authenticated-user-can-access')){
                return true;
            }
            return false;
        });
    }
}
