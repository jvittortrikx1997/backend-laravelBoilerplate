<?php

namespace App\Domain\Services;

use App\Application\Mappers\UserDataMapper;
use App\Domain\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class UserService
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $data)
    {
        $mappedData = UserDataMapper::mapToUsuarios($data);

        try {
            return $this->userRepository->create($mappedData);
        } catch (QueryException $e) {
            Log::error('Erro no banco de dados: ' . $e->getMessage());
            throw new \RuntimeException('Falha ao criar usuário: ' . $e->getMessage(), $e->getCode());
        }
    }
}

