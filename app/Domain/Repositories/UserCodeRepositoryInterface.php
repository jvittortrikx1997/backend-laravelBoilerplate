<?php

namespace App\Domain\Repositories;

interface UserCodeRepositoryInterface
{
    public function updateOrCreateCode(string $userId, string $code): void;
}
