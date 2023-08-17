<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpcPregMulModuloE extends Model
{
    protected $table = 'opc_mult_eval_me';
    protected $fillable = [
        'pregunta',
        'opciones',
        'correcta',
        'banco',
    ];

    public static function ConsulGrupOpcPreg($id)
    {
        $DesOpcPreg = OpcPregMulModuloE::where('pregunta', $id)
            ->get();
        return $DesOpcPreg;
    }

    public static function BuscOpcRespPrueba($id,$Est,$Ses)
    {
        $DesOpcPreg = OpcPregMulModuloE::join('resp_pregmultiple_me_prueba', 'resp_pregmultiple_me_prueba.respuesta', 'opc_mult_eval_me.id')
            ->join('preguntas_me', 'preguntas_me.id', 'opc_mult_eval_me.pregunta')
            ->select('opc_mult_eval_me.pregunta', 'opc_mult_eval_me.correcta', 'resp_pregmultiple_me_prueba.respuesta')
            ->where('resp_pregmultiple_me_prueba.pregunta', $id)
            ->where('resp_pregmultiple_me_prueba.alumno', $Est)
            ->where('resp_pregmultiple_me_prueba.sesion', $Ses)
            ->first();
            
        return $DesOpcPreg;
    }
}
