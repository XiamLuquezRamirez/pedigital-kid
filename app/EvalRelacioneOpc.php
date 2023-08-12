<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class EvalRelacioneOpc extends Model
{

    protected $table = 'eval_relacione_opc';
    protected $fillable = [
        'evaluacion',
        'respuesta',
        'correcta',
        'puntaje',
    ];

    public static function PregRelOpc($id)
    {
        $EvalRelOpc = EvalRelacioneOpc::where('pregunta', $id)
            ->inRandomOrder()
            ->get();
        return $EvalRelOpc;
    }

    public static function RelacResp($id)
    {
        $DesVerFal = EvalRelacioneOpc::join('resp_pregrelacione', 'resp_pregrelacione.pregunta', 'eval_relacione_opc.id')
            ->select('resp_pregrelacione.pregunta', 'resp_pregrelacione.respuesta_alumno', 'eval_relacione_opc.correcta', 'eval_relacione_opc.puntaje', 'eval_relacione_opc.respuesta')
            ->where('eval_relacione_opc.evaluacion', $id)
            ->where('resp_pregrelacione.alumno', Auth::user()->id)
            ->get();
        return $DesVerFal;
    }

    public static function PregRelOpcadd($id)
    {
        $EvalRelOpc = EvalRelacioneOpc::where('pregunta', $id)
            ->where('correcta', '-')
            ->get();
        return $EvalRelOpc;
    }

}
