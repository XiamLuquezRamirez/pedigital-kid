<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;

class OpcPregMul extends Model {

    protected $table = 'opc_mult_eval';
    protected $fillable = [
        'pregunta',
        'opciones',
        'correcta',
        'evaluacion'
    ];



    public static function GrupOpc($id) {
        $DesOpcPreg = OpcPregMul::where('pregunta', $id)
                ->get();
        return $DesOpcPreg;
    }

    public static function ConsulGrupOpcPreg($id)
    {
        $DesOpcPreg = OpcPregMul::where('pregunta', $id)
            ->get();
        return $DesOpcPreg;
    }

    public static function GrupOpcResp($id) {
        $DesOpcPreg = OpcPregMul::leftjoin('resp_pregmultiple', 'resp_pregmultiple.respuesta', 'opc_mult_eval.id')
                ->select('opc_mult_eval.*', 'resp_pregmultiple.respuesta')
                ->where('opc_mult_eval.pregunta', $id)
                ->get();
        return $DesOpcPreg;
    }

    public static function BuscOpc($id) {
        $DesOpcPreg = OpcPregMul::join('resp_pregmultiple', 'resp_pregmultiple.respuesta', 'opc_mult_eval.id')
                ->join('preg_mult_eval', 'preg_mult_eval.id', 'opc_mult_eval.pregunta')
                ->select('opc_mult_eval.pregunta', 'opc_mult_eval.correcta', 'preg_mult_eval.puntuacion')
                ->where('preg_mult_eval.evaluacion', $id)
                ->get();
        return $DesOpcPreg;
    }


    public static function BuscOpcResp($id,$Est)
    {
        $DesOpcPreg = OpcPregMul::join('resp_pregmultiple', 'resp_pregmultiple.respuesta', 'opc_mult_eval.id')
            ->join('preg_mult_eval', 'preg_mult_eval.id', 'opc_mult_eval.pregunta')
            ->select('opc_mult_eval.pregunta', 'opc_mult_eval.correcta', 'preg_mult_eval.puntuacion','resp_pregmultiple.respuesta')
            ->where('resp_pregmultiple.pregunta', $id)
            ->where('resp_pregmultiple.alumno', $Est)
            ->first();
            
        return $DesOpcPreg;
    }

    public static function GrupOpc2($eval) {
        $DesOpcPreg = OpcPregMul::where('evaluacion', $eval)
                ->get();
        return $DesOpcPreg;
    }

}
