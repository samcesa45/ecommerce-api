<?php

namespace App\Providers;

use App\Providers\UserService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public static function array_of_roles() {
        return [
            'admin' => [],
            'customer' => [],

        ];
    }
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        //Register Roles in this application with their permissions.
        UserService::register_roles(self::array_of_roles());
        Schema::defaultStringLength(125);

    }
}
