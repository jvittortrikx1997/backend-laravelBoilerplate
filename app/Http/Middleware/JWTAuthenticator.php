<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTAuthenticator
{
    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof TokenExpiredException) {
                return response()->json(['error' => 'Token expirado'], 401);
            } elseif ($e instanceof TokenInvalidException) {
                return response()->json(['error' => 'Token inválido'], 401);
            } else {
                return response()->json(['error' => 'Token não encontrado'], 401);
            }
        }

        return $next($request);
    }
}
