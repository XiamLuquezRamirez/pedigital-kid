<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SessionArea extends Model
{
    protected $table = 'sesion_area';
    protected $fillable = [
        'sesion',
        'area',
        'npreguntas',
        'simulacro'
    ];

    public static function Consultar($id)
    {
        $Areas = SessionArea::join("areas_me", "areas_me.id", "sesion_area.area")
            ->where('sesion', $id)
            ->select("sesion_area.*", "areas_me.nombre_area")
            ->get();

        return $Areas;
    }

    public static function ConsultarAreasSesion($Sesion)
    {
        
        $Areas = DB::connection("mysql")->select("SELECT sa.id idarea, ame.nombre_area, ame.icon, sa.npreguntas, lme.puntuacion, lme.estado estadoarea,sa.id idSesion,lme.resp_preguntas," .
        " (SELECT imagen FROM asignaturas_mode am WHERE am.area=ame.id LIMIT 1) imagen FROM libro_prueba_me lme ".
        " RIGHT JOIN sesion_area sa ON lme.area=sa.area AND lme.alumno=".Auth::user()->id." AND lme.sesion=".$Sesion.
        " LEFT JOIN areas_me ame ON sa.area=ame.id  ".
        " WHERE sa.sesion=".$Sesion);
        
        return $Areas;
    }

    public static function ConsultarInf($id)
    {

        $Areas = SessionArea::join("areas_me", "areas_me.id", "sesion_area.area")
        ->select("sesion_area.*", "areas_me.nombre_area")
        ->where('sesion_area.id', $id)
            ->first();
        return $Areas;
    }
}
