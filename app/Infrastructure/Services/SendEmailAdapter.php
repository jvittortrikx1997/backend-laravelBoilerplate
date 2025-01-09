<?php

namespace App\Infrastructure\Services;

use App\Domain\Repositories\EmailServiceInterface;
use App\Domain\Services\SendEmailService;

class SendEmailAdapter implements EmailServiceInterface
{
    public function __construct(protected SendEmailService $sendEmailService) {}

    public function sendTwoFactorCode(string $userName, string $email, string $code): void
    {
        $this->sendEmailService->sendEmailTwoFactor($userName, $email, $code);
    }
}
