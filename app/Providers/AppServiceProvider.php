<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Repositories\Eloquent\ClientRepository;
use App\Services\Interfaces\ClientServiceInterface;
use App\Services\ClientService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
        $this->app->bind(ClientServiceInterface::class, ClientService::class);
    }

    public function boot(): void {}
}
