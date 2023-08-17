<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PregOpcMulMe extends Model
{
    protected $table = 'preguntas_me';
    protected $fillable = [
        'banco',
        'competencia',
        'componente',
        'pregunta',
    ];

    public static function ConsulPreg($id)
    {
        $GrupPreg = PregOpcMulMe::where('id', $id)
            ->first();
        return $GrupPreg;
    }
}
