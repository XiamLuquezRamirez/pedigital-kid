<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvalPregEnsay extends Model {

    protected $table = 'eval_pregensayo';
    protected $fillable = [
        'evaluacion',
        'pregunta',
    ];

    public static function Guardar($datos,$eval) {

        return EvalPregEnsay::create([
                    'evaluacion' => $eval,
                    'pregunta' => $datos['summernote_pregensay']
        ]);
    }
    
       public static function ModifPreg($datos) {
        $respuesta = EvalPregEnsay::where('evaluacion',$datos["Id_Eval"] )->update([
             'pregunta' => $datos['summernote_pregensay']
        ]);
        return $respuesta;
    }

    public static function consulPregEnsay($id)
    {
        
        $DesEval = EvalPregEnsay::where('id', $id)
            ->first();
        return $DesEval;

    }
    
    
      public static function PregEnsay($id) {
        $DesEval= EvalPregEnsay::where('evaluacion', $id)
                ->first();
        return $DesEval;
        
    }
    
    

}
