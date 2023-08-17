<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModE_PreguntAreas extends Model
{
    protected $table = 'preg_competencia';
    protected $fillable = [
        'sesion_area',
        'pregunta',
        'sesion',
        'banco',
        'parte',
        'simulacro'
    ];


    public static function ConsultarInfIngles($id, $ori)
    {
        if ($ori == "Admin") {
            $Pregun = ModE_PreguntAreas::join("preguntas_me", "preguntas_me.id", "preg_competencia.pregunta")
                ->join("banco_preg_me", "banco_preg_me.id", "preg_competencia.banco")
                ->where('sesion_area', $id)
                ->select("preg_competencia.*", "banco_preg_me.enunciado", "banco_preg_me.tipo_pregunta", 'banco_preg_me.npreguntas', 'preguntas_me.id AS idpregme',"preguntas_me.pregunta AS pregEnunciado",'preguntas_me.competencia','preguntas_me.componente')
                ->groupBy("banco_preg_me.id")
                ->get();
        } else {
            $Pregun = ModE_PreguntAreas::join("preguntas_me", "preguntas_me.id", "preg_competencia.pregunta")
                ->join("banco_preg_me", "banco_preg_me.id", "preg_competencia.banco")
                ->where('sesion_area', $id)
                ->select("preg_competencia.*", "banco_preg_me.enunciado", "banco_preg_me.tipo_pregunta", 'banco_preg_me.npreguntas','preguntas_me.id AS idpregme',"preguntas_me.pregunta AS pregEnunciado",'preguntas_me.competencia','preguntas_me.componente')
                ->get();
       }

        return $Pregun;
    }

    public static function ConsultarInf($id)
    {
        $Pregun = ModE_PreguntAreas::join("preguntas_me", "preguntas_me.id", "preg_competencia.pregunta")
            ->join("banco_preg_me", "banco_preg_me.id", "preguntas_me.banco")
            ->where('sesion_area', $id)
            ->select("preguntas_me.*", "banco_preg_me.enunciado", "banco_preg_me.tipo_pregunta")
            ->get();
        return $Pregun;
    }

    

}
