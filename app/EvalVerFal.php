<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class EvalVerFal extends Model {

    protected $table = 'eval_verfal';
    protected $fillable = [
        'evaluacion',
        'pregunta',
        'respuesta',
        'puntaje'
    ];

    public static function Guardar($data,$idEval) {
        $i = 1;
       

        foreach ($data["txtpregVerFal"] as $key => $val) {
            foreach ($data["radpregVerFal" . $i] as $key2 => $val2) {
                $resp = $data["radpregVerFal" . $i][$key2];
            }
            $respuesta = EvalVerFal::create([
                        'evaluacion' => $idEval,
                        'pregunta' => $data["txtpregVerFal"][$key],
                        'respuesta' => $resp,
                        'puntaje' => $data["txtpuntVerFal"][$key]
            ]);
            $i++;
        }
        return $respuesta;
    }

    public static function ModifOpcPreg($data) {
        $Opc = EvalVerFal::where('evaluacion', $data["Id_Eval"]);
        $Opc->delete();
        $i = 1;
        foreach ($data["txtpregVerFal"] as $key => $val) {
            foreach ($data["radpregVerFal" . $i] as $key2 => $val2) {
                $resp = $data["radpregVerFal" . $i][$key2];
            }
            $respuesta = EvalVerFal::create([
                        'evaluacion' => $data["Id_Eval"],
                        'pregunta' => $data["txtpregVerFal"][$key],
                        'respuesta' => $resp,
                        'puntaje' => $data["txtpuntVerFal"][$key]
            ]);
            $i++;
        }

        return $respuesta;
    }

    public static function ConVerFal($id)
    {
        $PregVerFal = EvalVerFal::where('id', $id)
            ->first();
        return $PregVerFal;
    }

    public static function VerFal($id) {
        $PregVerFal = EvalVerFal::where('evaluacion', $id)
                ->get();
        return $PregVerFal;
    }

    public static function VerFalResp($id,$Est)
    {
        $DesVerFal = EvalVerFal::join('resp_pregverfal', 'resp_pregverfal.pregunta', 'eval_verfal.id')
            ->select('resp_pregverfal.pregunta', 'resp_pregverfal.respuesta_alumno', 'eval_verfal.respuesta', 'eval_verfal.puntaje')
            ->where('resp_pregverfal.pregunta', $id)
            ->where('resp_pregverfal.alumno', $Est)
            ->first();
        return $DesVerFal;
    }


}
