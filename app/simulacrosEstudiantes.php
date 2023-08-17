<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
USE Illuminate\Support\Facades\Auth;

class simulacrosEstudiantes extends Model
{
    protected $table = 'simulacro_estudiante';
    protected $fillable = [
        'simulacro',
        'estudiante',
        'estado',
    ];

    public static function guardar($datos){
        return simulacrosEstudiantes::create([
            'simulacro' => $datos['idSimula'],
            'estudiante' => Auth::user()->id,
            'estado' => "TERMINADO",
        ]);
    }
}
