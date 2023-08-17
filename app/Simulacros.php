<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Simulacros extends Model
{
    protected $table = 'simulacros';
    protected $fillable = [
        'nombre',
        'prueba',
        'fecha',
        'estado',
    ];


    
    public static function CargarSimulacros(){
        $fecha = date('Y-m-d');
        $respuesta = Simulacros::where('fecha', $fecha)
        ->where("prueba", Auth::user()->grado_usuario)
        ->where('estado','ACTIVO')
        ->get();
        return $respuesta;
    }

    public static function BuscarSimuxEstu($id)
    {
        return Simulacros::leftJoin("simulacro_estudiante","simulacro_estudiante.simulacro","simulacros.id")
        ->select("simulacros.*","simulacro_estudiante.estado")
        ->first();
    }


}
