<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradosModulos extends Model
{
    protected $table = 'grados_modulos';
    protected $fillable = [
        'modulo',
        'objetivo_modulo',
        'presentacion_modulo',
        'avance_modulo',
        'grado_modulo',
        'estado_modulo',
    ];

    public static function ListModulos($id)
    {
        $Modulo = GradosModulos::join("modulos_transversales", "modulos_transversales.id", "grados_modulos.modulo")
            ->where('modulos_transversales.id', $id)
            ->where('estado_modulo', 'ACTIVO')
            ->select("grados_modulos.*", 'modulos_transversales.nombre')
            ->get();

        return $Modulo;
    }

    
    public static function ListModulosDoc($id)
    {
        $Modulo = GradosModulos::join("mod_prof", "mod_prof.grado", "grados_modulos.id")
        ->join("modulos_transversales", "modulos_transversales.id", "mod_prof.asignatura")
        ->where('mod_prof.profesor', Auth::user()->id)
        ->where('grados_modulos.modulo', $id)
        ->where('estado_modulo', 'ACTIVO')
        ->select("grados_modulos.*", 'modulos_transversales.nombre')
        ->groupBy("mod_prof.grado")
        ->orderBy("grados_modulos.grado_modulo", 'ASC')
        ->get();

        return $Modulo;
    }

    public static function BuscarAsig($id) {
        return GradosModulos::findOrFail($id);
    }
}
