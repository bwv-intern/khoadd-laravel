<?php

namespace App\Providers;

use App\Interfaces\ITodoRepository;
use App\Interfaces\IUSerRepository;
use App\Repositories\TodoRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void {
        $this->app->bind(ITodoRepository::class, TodoRepository::class);
        $this->app->bind(IUSerRepository::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {
    }
}
