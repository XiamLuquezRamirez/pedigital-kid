<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesarroComentario extends Model {

    protected $table = 'cont_comentarios';
    protected $fillable = [
        'contenido',
        'titulo',
        'cont_comentario',
        'hab_conversacion'
    ];

    public static function LisComentario() {
        $Comnet = DesarroComentario::get();
        return $Comnet;
    }

    public static function LisComentarioEst($grado, $grupo, $jornada) {
        $fecha = date('Y-m-d');
        $Comnet = DesarroComentario::where('fecha', $fecha)
                ->where('grado', $grado)
                ->where('grupo', $grupo)
                ->where('jornada', $jornada)
                ->get();
       
        return $Comnet;
    }

}
