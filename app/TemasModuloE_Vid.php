<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemasModuloE_Vid extends Model
{
    protected $table = 'videos_moduloe';
    protected $fillable = [
        'tema',
        'video',
    ];

    public static function BuscarTema($id)
    {
        $InfTema = TemasModuloE_Vid::where('tema', $id)
            ->first();
        return $InfTema;
    }
}
