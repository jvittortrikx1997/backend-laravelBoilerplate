<?php

namespace App\Infrastructure\Services;

use App\Domain\Services\EmailServiceInterface;
use App\Doman\Services\SendEmailService;

class SendEmailAdapter implements EmailServiceInterface
{
    protected SendEmailService $sendEmailService;

    public function __construct(SendEmailService $sendEmailService)
    {
        $this->sendEmailService = $sendEmailService;
    }

    public function sendTwoFactorCode(string $userName, string $email, string $code): void
    {
        $this->sendEmailService->sendEmailTwoFactor($userName, $email, $code);
    }
}
