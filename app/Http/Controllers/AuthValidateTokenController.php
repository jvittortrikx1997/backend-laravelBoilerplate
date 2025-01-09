<?php

namespace App\Http\Controllers;

use App\Domain\Services\AuthTokenService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthValidateTokenController extends Controller
{
    private AuthTokenService $authTokenService;

    public function __construct(AuthTokenService $authTokenService)
    {
        $this->authTokenService = $authTokenService;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $result = $this->authTokenService->validateToken();

        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'] ?? null,
        ], $result['status']);
    }
}
