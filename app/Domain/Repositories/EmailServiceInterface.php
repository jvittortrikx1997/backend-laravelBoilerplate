<?php

namespace App\Domain\Repositories;

interface EmailServiceInterface
{
    public function sendTwoFactorCode(string $userName, string $email, string $code): void;
}
