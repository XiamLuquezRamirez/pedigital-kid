<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PregOpcMul extends Model {

    protected $table = 'preg_mult_eval';
    protected $fillable = [
        'evaluacion',
        'pregunta',
        'puntuacion'
    ];

    public static function GrupPreg($id) {

        $GrupPreg = PregOpcMul::where('evaluacion', $id)
                ->get();
        return $GrupPreg;
    }

    public static function ConsulPreg($id)
    {
        $GrupPreg = PregOpcMul::where('id', $id)
            ->first();
        return $GrupPreg;
    }


}
