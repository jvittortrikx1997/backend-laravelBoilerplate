<?php

namespace App\Providers;

use App\Domain\Repositories\UserCodeRepositoryInterface;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Domain\Repositories\EmailServiceInterface;
use App\Infrastructure\Repositories\EloquentUserCodeRepository;
use App\Infrastructure\Repositories\EloquentUserRepository;
use App\Infrastructure\Services\SendEmailAdapter;
use App\Domain\Services\SendEmailService; // Classe real que envia e-mails
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(UserCodeRepositoryInterface::class, EloquentUserCodeRepository::class);

        $this->app->bind(EmailServiceInterface::class, function ($app) {
            return new SendEmailAdapter(new SendEmailService());
        });
    }

    public function boot(): void
    {

    }
}
