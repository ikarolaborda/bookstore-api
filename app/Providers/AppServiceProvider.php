<?php

namespace App\Providers;

use App\Contracts\BookRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Repositories\BookRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
