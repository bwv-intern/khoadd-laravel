<?php

namespace App\Providers;

use App\Interfaces\ITodoRepository;
use App\Repositories\TodoRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void {
        $this->app->bind(ITodoRepository::class, TodoRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {
    }
}
