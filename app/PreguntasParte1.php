<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreguntasParte1 extends Model
{
    protected $table = 'preguntas_parte1';
    protected $fillable = [
        'parte',
        'pregunta',
        'respuesta',
    ];

    public static function ConsultarPregParte($preg)
    {
        $Preguntas = PreguntasParte1::where('id', $preg)
            ->first();
        return $Preguntas;
    }

    public static function BuscOpcRespPruebaParte($id,$Est,$ses)
    {
        $DesOpcPreg = PreguntasParte1::join('resp_pregmultiple_me_prueba', 'resp_pregmultiple_me_prueba.pregunta', 'preguntas_parte1.id')
            ->select('preguntas_parte1.id', 'preguntas_parte1.respuesta', 'resp_pregmultiple_me_prueba.respuesta AS resp_alumno')
            ->where('resp_pregmultiple_me_prueba.pregunta', $id)
            ->where('resp_pregmultiple_me_prueba.alumno', $Est)
            ->where('resp_pregmultiple_me_prueba.sesion', $ses)
            ->first();
        return $DesOpcPreg;
    }

}
