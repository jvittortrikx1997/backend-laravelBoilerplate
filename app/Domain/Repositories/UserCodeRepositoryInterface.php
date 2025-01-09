<?php

namespace App\Domain\Repositories;

interface UserCodeRepositoryInterface
{
    public function updateOrCreateCode(string $userId, string $code): void;
    public function getUserCode(string $userId, string $code);
    public function deleteUserCode(string $userId, string $code);
}
