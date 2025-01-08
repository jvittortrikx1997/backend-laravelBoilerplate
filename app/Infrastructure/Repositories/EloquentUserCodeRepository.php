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
}
