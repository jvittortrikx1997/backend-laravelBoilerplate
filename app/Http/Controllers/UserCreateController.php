<?php

namespace App\Http\Controllers;

use App\Domain\Services\UserService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Users\UserRequest as UsersUserRequest;
use Exception;

class UserCreateController extends Controller
{
    public function __construct(protected readonly UserService $userService)
    {

    }

    public function __invoke(UsersUserRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $user = $this->userService->createUser($data);

            return response()->json([
                'message' => 'Usuário criado com sucesso',
                'data' => $user
            ], 201);
        } catch (\RuntimeException $e) {
            return response()->json([
                'error' => 'Erro ao processar a solicitação',
                'details' => $e->getMessage()
            ], 400);
        }
    }
}


