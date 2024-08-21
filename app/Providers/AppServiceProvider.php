<?php

namespace App\Providers;

use App\Repositories\UsersRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\UsersRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
