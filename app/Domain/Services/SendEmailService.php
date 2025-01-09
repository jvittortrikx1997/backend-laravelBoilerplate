<?php

namespace App\Domain\Services;

use DomainException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendEmailService
{
    public function sendResetPassword(string $userName, string $email, string $password)
    {
        $mail = Http::withOptions([
            'verify' => false,
        ])->post(config('services.emails.url') . '/sso/reset-password', [
            'name' => $userName,
            'email' => $email,
            'password' => $password
        ]);

        if ($mail->status() !== 200) {
            Log::error('Ocorreu um erro ao enviar o email de reset de senha', [
                'status' => $mail->status(),
                'response' => $mail->json()
            ]);
            throw new DomainException('Ocorreu um erro ao enviar o email', 500);
        }

        return $mail->json();
    }

    public function sendEmailTwoFactor(string $userName, string $email, string $code)
    {
        $mail = Http::withOptions([
            'verify' => false, // Desabilita a verificação SSL (não recomendado em produção)
        ])->post(config('services.emails.url') . '/sso/two-factor', [
            'name' => $userName,
            'email' => $email,
            'code' => $code
        ]);

        if ($mail->status() !== 200) {
            Log::error('Ocorreu um erro ao enviar o email de autenticação de dois fatores', [
                'status' => $mail->status(),
                'response' => $mail->json()
            ]);
            throw new DomainException('Ocorreu um erro ao enviar o email', 500);
        }

        return $mail->json();
    }
}
