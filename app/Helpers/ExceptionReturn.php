<?php

namespace App\Helpers;

use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Throwable;

final class ExceptionReturn
{
    public static function exceptionReturn(Throwable $e): JsonResponse
    {
        $code = $e->getCode();

        if (0 == $e->getCode()) {
            $code = 500;
        }

        if($e instanceof ValidationException) {
            return response()->json([
                'message' => 'Alguns parametros foram enviados incorretamente. Por favor, verifique e tente novamente.',
                'errors' => $e->errors()
            ], 422);
        }
        if ($e instanceof QueryException) {
            $mensagem = 'Ocorreu um erro interno do servidor. Por favor, tente novamente mais tarde.';

            if (env('APP_DEBUG')) {
                $mensagem = $e->getMessage();
            }

            abort(response()->json([
                'message' => $mensagem,
            ], 500));
        }

        return response()->json([
            'message' => $e->getMessage(),
        ], $code);
    }
}
