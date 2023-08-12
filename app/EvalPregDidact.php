<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvalPregDidact extends Model {

    protected $table = 'eval_pregdidactica';
    protected $fillable = [
        'evaluacion',
        'pregunta',
        'cont_didactico'
    ];

    public static function PregDida($id) {
        $DesEval = EvalPregDidact::where('evaluacion', $id)
                ->first();
        return $DesEval;
    }

}
