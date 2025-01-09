<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\EmailServiceInterface;

class SendTwoFactorCode
{
    protected EmailServiceInterface $emailService;

    public function __construct(EmailServiceInterface $emailService)
    {
        $this->emailService = $emailService;
    }

    public function execute(string $userName, string $email, string $code): void
    {
        $this->emailService->sendTwoFactorCode($userName, $email, $code);
    }
}

