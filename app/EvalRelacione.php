<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvalRelacione extends Model {

    protected $table = 'eval_relacione_def';
    protected $fillable = [
        'evaluacion',
        'opcion',
        'definicion'
    ];

    public static function PregRelDef($id) {
        $EvalRel = EvalRelacione::where('pregunta', $id)
                ->get();
        return $EvalRel;
    }

}
