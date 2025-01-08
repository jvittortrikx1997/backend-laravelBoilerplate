<?php

namespace App\Application\Mappers;

use Illuminate\Support\Arr;

class UserDataMapper
{
    public static function mapToUsuarios(array $data): array
    {
        $mappedData = [];

        if (Arr::get($data, 'nome')) {
            $mappedData['USUNOME'] = $data['nome'];
        }
        if (Arr::get($data, 'email')) {
            $mappedData['USUEMAIL'] = $data['email'];
        }
        if (Arr::get($data, 'cpf')) {
            $mappedData['USUCPF'] = $data['cpf'];
        }
        if (Arr::get($data, 'documento')) {
            $mappedData['USUDOC'] = $data['documento'];
        }
        if (Arr::get($data, 'telefone')) {
            $mappedData['USUFONE'] = $data['telefone'];
        }
        if (Arr::get($data, 'celular')) {
            $mappedData['USUCELULAR'] = $data['celular'];
        }
        if (Arr::get($data, 'senha')) {
            $mappedData['USUSENHA'] = bcrypt($data['senha']);
        }
        if (Arr::get($data, 'imagem')) {
            $mappedData['USUIMGPATH'] = $data['imagem'];
        }

        return $mappedData;
    }
}
