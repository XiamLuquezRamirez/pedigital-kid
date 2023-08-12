<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class ZonaLibre extends Model
{

    protected $table = 'zona_libre';
    protected $fillable = [
        'curso',
        'fecha',
        'tip_contenido',
        'tip_evaluacion',
        'titu_contenido',
        'estado',
        'tip_video',
        'docente'
    ];


    public static function LisTemasEst($grado, $grupo, $jornada) {
        $fecha = date('Y-m-d');

        $Temas = ZonaLibre::where('fecha', $fecha)
                ->where('grado', $grado)
                ->where('grupo', $grupo)
                ->where('jornada', $jornada)
                ->get();
        return $Temas;
    }

    public static function BuscarTema($id)
    {

        return ZonaLibre::findOrFail($id);
    }

}
