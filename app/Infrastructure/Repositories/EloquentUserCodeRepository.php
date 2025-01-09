<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\UserCodeRepositoryInterface;
use App\Infrastructure\Models\UsuarioCodigo;
use DomainException;

class EloquentUserCodeRepository implements UserCodeRepositoryInterface
{
    public function updateOrCreateCode(string $userId, string $code): void
    {
        $userCode = UsuarioCodigo::updateOrCreate(
            ['USUUID' => $userId],
            ['USUCODCODIGO' => $code]
        );

        if (!$userCode) {
            throw new DomainException('Erro ao criar ou atualizar o código de verificação', 500);
        }
    }

    public function getUserCode(string $userId, string $code)
    {
        $userCode = UsuarioCodigo::where('USUUID', $userId)
            ->where('USUCODCODIGO', $code)
            ->first();

        if (!$userCode) {
            throw new DomainException('Código de verificação inválido', 404);
        }

        return $userCode;
    }

    public function deleteUserCode(string $userId, string $code)
    {
        $userCode = UsuarioCodigo::query()
        ->where('USUUID', $userId)
        ->where('USUCODCODIGO', $code)
        ->delete();
    }
}
