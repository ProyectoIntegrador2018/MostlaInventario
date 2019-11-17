<?php

namespace App\Providers;

use App\Models\UserType;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        Schema::defaultStringLength(191);

        Blade::if('mintype', function ($type) {
            $user = auth()->user();
            return $user && $user->type_id >= $type ;
        });

        Blade::if('maxtype', function ($type) {
            $user = auth()->user();
            return $user && $user->type_id <= $type ;
        });

        Blade::if('coordinator', function () {
            $user = auth()->user();
            return $user && $user->type_id >= UserType::COORDINATOR ;
        });

        Blade::if('admin', function () {
            $user = auth()->user();
            return $user && $user->type_id >= UserType::ADMIN ;
        });

        Blade::if('superadmin', function () {
            $user = auth()->user();
            return $user && $user->type_id >= UserType::SUPER_ADMIN ;
        });
    }
}
