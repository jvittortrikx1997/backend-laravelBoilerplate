<?php

namespace App\Infrastructure\Models;

//use App\Extenders\Authenticable;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuarios extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use Notifiable;
    use HasUuids;
    public string $prefixColumns = 'USU';
    public $timestamps = false;

    protected $table = 'TBUSUARIOS';
    protected $primaryKey = 'USUUID';

    protected $guarded = [];

    protected $hidden = [
        'USUINCLUIDOEM',
        'USUINCLUIDOPOR',
        'USUALTERADOEM',
        'USUALTERADOPOR',
        'USUEXCLUIDO',
        'USUSENHA'
    ];

    public function getAuthPassword()
    {
        return $this->USUSENHA;
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {

        return [];
    }
}
