<?php

namespace App\Providers;

use App\Domain\Repositories\UserCodeRepositoryInterface;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Domain\Services\AuthLoginService;
use App\Domain\Repositories\EmailServiceInterface;
use App\Domain\Services\EmailService;
use App\Infrastructure\Repositories\EloquentUserCodeRepository; // Corrigido o namespace
use App\Infrastructure\Repositories\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);

        $this->app->bind(UserCodeRepositoryInterface::class, EloquentUserCodeRepository::class);

        $this->app->bind(EmailServiceInterface::class, EmailService::class);

       /* $this->app->bind(AuthLoginService::class, function ($app) {
            return new AuthLoginService(
                $app->make(UserRepositoryInterface::class),
                $app->make(UserCodeRepositoryInterface::class),
                $app->make(EmailServiceInterface::class)
            );
        });*/
    }

    public function boot(): void
    {

    }
}
