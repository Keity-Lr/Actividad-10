<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Factories\IRazaFactory;
use App\Factories\RazaFactory;
use App\Repositories\IAnimalRepository;
use App\Repositories\EloquentAnimalRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
    IRazaFactory::class,
    RazaFactory::class
);

$this->app->bind(
    IAnimalRepository::class,
    EloquentAnimalRepository::class
);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
