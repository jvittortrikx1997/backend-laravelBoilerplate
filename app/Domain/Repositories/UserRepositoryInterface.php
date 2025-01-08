<?php

namespace App\Domain\Repositories;

use App\Infrastructure\Models\Usuarios;

interface UserRepositoryInterface
{
    public function create(array $data): Usuarios;
    public function findByEmail(string $email): ?Usuarios;
}

