<?php

namespace App\Providers;

use App\Interfaces\Repositories\CharacterRepositoryInterface;
use App\Interfaces\Services\CharacterServiceInterface;
use App\Repositories\Character\CharacterRepository;
use App\Services\Character\CharacterService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CharacterServiceInterface::class, CharacterService::class);
        $this->app->bind( CharacterRepositoryInterface::class, CharacterRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
