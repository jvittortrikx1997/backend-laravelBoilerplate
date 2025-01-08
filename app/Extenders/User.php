<?php

namespace App\Domain\Entities;

class User
{
    public string $name;
    public string $email;
    public ?string $cpf;

    public function __construct(string $name, string $email, ?string $cpf = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->cpf = $cpf;
    }
}
