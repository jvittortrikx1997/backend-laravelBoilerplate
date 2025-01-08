<?php

namespace App\Domain\Services;

use App\Domain\Repositories\EmailServiceInterface;

class EmailService implements EmailServiceInterface
{
    public function sendTwoFactorCode(string $userName, string $email, string $code): void{

    }

}
