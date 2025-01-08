<?php

namespace App\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name', 'email', 'cpf', 'documento'];
}
