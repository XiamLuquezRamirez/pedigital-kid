<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsUrl extends Model
{
    protected $table = 'para_generales';
    protected $fillable = [
        'url',
        'mod_asig',
        'mod_modu',
        'mod_zona',
        'mod_labo',
        'mod_entre',
        'mod_juego',
        'colegio'

    ];

    public static function ConsulUrl($Plat)
    {
        $ImgAig = ConsUrl::where('plataf', $Plat)
            ->first();
        return $ImgAig;
    }

    public static function ConsulPar($Plat)
    {
        $Parametros = ConsUrl::where('plataf', $Plat)
            ->first();
        return $Parametros;
    }

}
