<?php

namespace App\Helpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Utils
{
    public static function validateCpf(string $cpf): bool
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        if (mb_strlen($cpf) != 11) {
            return false;
        }

        if (
            $cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999'
        ) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;

            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    public static function removeSpecialCharacters(string $string): string
    {
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }

    public static function validateReturn(Request $request, array $returnMessage, int $status): \Illuminate\Http\JsonResponse
    {
        if ($request->getRealMethod() == 'GET' && count($returnMessage['data'] ?? []) == 0) {
            return response()->json([
                'message' => 'Registros não encontrados!',
                'data' => [],
            ], 404);
        }

        return response()->json($returnMessage, $status);
    }

    public static function generateHistoryColumnsOnMigration(string $prefixColumnName, Blueprint &$table): void
    {
        $prefixColumnName = Str::upper($prefixColumnName);
        $table->dateTime("{$prefixColumnName}INCLUIDOEM");
        $table->uuid("{$prefixColumnName}INCLUIDOPOR");

        $table->dateTime("{$prefixColumnName}ALTERADOEM")->nullable();
        $table->uuid("{$prefixColumnName}ALTERADOPOR")->nullable();

        $table->smallInteger("{$prefixColumnName}EXCLUIDO")->default(0)->nullable();

        $table->index("{$prefixColumnName}EXCLUIDO", "{$prefixColumnName}EXCLUIDO");
    }

    public static function onlyNumbers(?string $string): ?string
    {
        if ($string === null) {
            return null;
        }

        return preg_replace('/[^0-9]/', '', $string);
    }
}
