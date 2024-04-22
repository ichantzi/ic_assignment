<?php

namespace App\Providers;

use App\Interfaces\Repositories\LocationRepositoryInterface;
use App\Interfaces\Repositories\PropertyRepositoryInterface;
use App\Repositories\LocationRepository;
use App\Repositories\PropertyRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PropertyRepositoryInterface::class, PropertyRepository::class);
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
