<?php

namespace App\Extenders;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as ModelEloquent;
use Illuminate\Support\Facades\Auth;

class Model extends ModelEloquent
{
    /**
     * The prefix of columns in table
     *
     * @var string
     */
    public string $prefixColumns = '';

    public function delete(): ?bool
    {
        if (Auth::check()) {
            $userId = Auth::user()->USUUID;
        } else {
            $userId = 'Adicionado pelo sistema';

        }

        return parent::update([
            $this->prefixColumns . 'EXCLUIDO' => 1,
            $this->prefixColumns . 'ALTERADOPOR' => $userId,
            $this->prefixColumns . 'ALTERADOEM' => Carbon::now()->format('Y-m-d H:m:i'),
        ]);
    }

    public function scopeWhereNotDeleted($query)
    {
        return $query->where($this->prefixColumns . 'EXCLUIDO', '!=', 1);
    }

    protected static function booted(): void
    {
        static::creating(function ($model): void {

            if (Auth::check()) {
                $userId = Auth::user()->USUUID;
            } else {
                $userId = 'Adicionado pelo sistema';

            }

            $columnIncluidoPor = $model->prefixColumns . 'INCLUIDOPOR';
            $columnIncluidoEm = $model->prefixColumns . 'INCLUIDOEM';

            $model->{$columnIncluidoPor} = $userId;
            $model->{$columnIncluidoEm} = Carbon::now()->format('Y-m-d H:m:i');
        });

        static::updating(function ($model): void {

            if (Auth::check()) {
                $userId = Auth::user()->USUUID;
            } else {
                $userId = 'Adicionado pelo sistema';

            }


            $columnAlteradoPor = $model->prefixColumns . 'ALTERADOPOR';
            $columnAlteradoEm = $model->prefixColumns . 'ALTERADOEM';

            $model->{$columnAlteradoPor} = $userId;
            $model->{$columnAlteradoEm} = Carbon::now()->format('Y-m-d H:m:i');
        });

    }

}
