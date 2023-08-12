<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvalPregComplete extends Model {

    protected $table = 'eval_complete';
    protected $fillable = [
        'id',
        'evaluacion',
        'opciones',
        'parrafo',
        'puntaje'
    ];

    public static function PregComplete($id) {
        $DesEval = EvalPregComplete::where('evaluacion', $id)
                ->first();
        return $DesEval;
    }

    public static function ConsultComplete($id) {
        $DesEval = EvalPregComplete::where('id', $id)
                ->first();
        return $DesEval;
    }

}
