<?php

namespace App\Http\Controllers;

use App\Domain\Services\AuthLoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthLoginController extends Controller
{
    public function __construct(protected readonly AuthLoginService $authService)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $data = $request->only(['cpf', 'email', 'password', 'verify_code']);

        return $this->authService->login($data);
    }
}
