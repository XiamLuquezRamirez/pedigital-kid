<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PregRelacione extends Model
{
    protected $table = 'eval_relacione';
    protected $fillable = [
        'evaluacion',
        'enunciado',
        'puntaje'
    ];

    public static function ConRela($id)
    {
        $PregRelacione = PregRelacione::where('id', $id)
            ->first();
        return $PregRelacione;
    }

}
