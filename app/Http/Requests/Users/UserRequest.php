<?php

namespace App\Http\Requests\Users;

use App\Helpers\Utils;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
         'nome' => ['required', 'string', 'min:2', 'max:200'],
         'email' => ['required', 'email', 'string', 'max:255'],
         'cpf' => ['nullable', 'string', 'max:11', Rule::requiredIf(function (){
                return !$this->documento;
         })],
         'documento' => ['nullable', 'string', 'max:100', Rule::requiredIf(function () {
                return !$this->cpf;
        })],
          'celular' => ['required', 'string', 'min:10', 'max:20'],
          'telefone' => ['nullable', 'string', 'min:10', 'max:20'],
          'senha' => ['required', 'string', 'min:6', 'max:20'],
          'imagem' =>['nullable', 'file'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'email' => trim($this->email),

        ]);
    }
}
