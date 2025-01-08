<?php

namespace App\Infrastructure\Models;

use App\Extenders\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsuarioCodigo extends Model
{
    use HasFactory;
    public string $prefixColumns = 'USUCOD';
    public $timestamps = false;

    protected $table = 'TBUSUARIOCODIGOS';
    protected $primaryKey = 'USUCODID';
    protected $guarded = [];

    protected $hidden = [
        'USUCODINCLUIDOEM',
        'USUCODINCLUIDOPOR',
        'USUCODALTERADOEM',
        'USUCODALTERADOPOR',
        'USUCODEXCLUIDO',
    ];
}
