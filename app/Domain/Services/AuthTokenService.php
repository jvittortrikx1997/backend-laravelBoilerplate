<?php

namespace App\Domain\Services;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthTokenService
{

    public function validateToken(): array
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return [
                    'status' => 401,
                    'message' => 'Usuário não encontrado!',
                    'data' => null,
                ];
            }
            return [
                'status' => 200,
                'message' => 'Token válido!',
                'data' => null,
            ];
        } catch (TokenExpiredException $e) {
            return [
                'status' => 400,
                'message' => 'Token expirado!',
                'data' => null,
            ];
        } catch (TokenInvalidException $e) {
            return [
                'status' => 401,
                'message' => 'Token inválido!',
                'data' => null,
            ];
        } catch (JWTException $e) {
            return [
                'status' => 400,
                'message' => 'Erro ao processar token!',
            ];
        }
    }
}

