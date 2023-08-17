<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DetaSesionesSimul extends Model
{
    protected $table = 'me_sesiones_simulacros';
    protected $fillable = [
        'id_simulacro',
        'sesion',
        'num_preguntas',
        'tiempo_sesion',
        'estado',
        'habilitado'
    ];   

   
    public static function ConsultarSesiones($simu)
    {   
        $DetSesiones = DetaSesionesSimul::leftJoin('me_sesiones_alumnos', function ($join) {
            $join->on('me_sesiones_alumnos.sesion', '=', 'me_sesiones_simulacros.id')
                ->where('me_sesiones_alumnos.alumno', '=', Auth::user()->id);
        })
            ->where('me_sesiones_simulacros.id_simulacro', $simu)
            ->where('me_sesiones_simulacros.estado', "ACTIVO")
            ->select('me_sesiones_simulacros.id', 'me_sesiones_simulacros.id_simulacro', 'me_sesiones_simulacros.sesion', 'me_sesiones_simulacros.num_preguntas', 'me_sesiones_simulacros.tiempo_sesion','me_sesiones_simulacros.habilitado', 'me_sesiones_alumnos.estado')
            ->get();
        return $DetSesiones;
    }

    public static function ConsultarSesion($sesion)
    {
        $DetSesion = DB::connection("mysql")->select("SELECT mss.id,mss.sesion, mss.num_preguntas, mss.tiempo_sesion,msa.alumno, msa.estado FROM me_sesiones_simulacros mss LEFT JOIN me_sesiones_alumnos msa ON mss.id=msa.sesion  AND msa.alumno=".Auth::user()->id." LEFT JOIN alumnos alum ON msa.alumno=alum.usuario_alumno  WHERE mss.id = '".$sesion."'");
        return $DetSesion[0];

    }
}
