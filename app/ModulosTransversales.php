<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;

class ModulosTransversales extends Model
{
    protected $table = 'modulos_transversales';
    protected $fillable = [
        'nombre',
        'estado',
        'descripcion'
    ];


    public static function ModulosTransv() {
            $Asig = ModulosTransversales::where('modulos_transversales.estado', 'ACTIVO')
                    ->get();
        return $Asig;
    }

    public static function InfAsig($id) {
        $Asig = ModulosTransversales::where('id', $id)
                ->first();
        return $Asig;
    }


    public static function AsigxDoc(){
        $Asig = ModulosTransversales::join("mod_prof", "mod_prof.asignatura", "modulos_transversales.id")
        ->where('mod_prof.profesor', Auth::user()->id)
        ->where('estado', 'ACTIVO')
        ->select('modulos_transversales.id', 'modulos_transversales.nombre')
        ->groupBy('modulos_transversales.id', 'modulos_transversales.nombre')
        ->get();
        return $Asig;
    }

    public static function AsigxUsu($Grado) {
 
        $Asig = ModulosTransversales::join("grados_modulos", "grados_modulos.modulo", "modulos_transversales.id")
        ->where('grados_modulos.grado_modulo', $Grado)
        ->where('modulos_transversales.estado', 'ACTIVO')
        ->where('grados_modulos.estado_modulo', 'ACTIVO')
        ->select("grados_modulos.*", 'modulos_transversales.nombre')
        ->get();
        return $Asig;
    }
}
