<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\UserRepositoryInterface;
use App\Infrastructure\Models\Usuarios;

class EloquentUserRepository implements UserRepositoryInterface
{
    protected Usuarios $model;

    public function __construct(Usuarios $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Usuarios
    {
        return $this->model->create($data);
    }

    public function findByEmail(string $email): ?Usuarios
    {
        return $this->model->where('USUEMAIL', $email)->first();
    }
}


