<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Modulos extends Model {

    protected $table = 'modulos';
    protected $fillable = [
        'asignatura',
        'objetivo_modulo',
        'presentacion_modulo',
        'avance_modulo',
        'grado_modulo',
        'estado_modulo'
    ];

    public static function ListModulos($Grad) {

        $Modulo = Modulos::join("asignaturas", "asignaturas.id", "modulos.asignatura")
                ->where('estado_modulo', 'ACTIVO')
                ->where('modulos.grado_modulo', $Grad)
                ->select("modulos.*", 'asignaturas.nombre')
                ->orderBy("modulos.grado_modulo", "ASC")
                ->get();

        return $Modulo;
    }

    public static function ListModulosDoc($id){
        $Modulo = Modulos::join("asig_prof", "asig_prof.grado", "modulos.id")
        ->join("asignaturas", "asignaturas.id", "asig_prof.asignatura")
        ->where('asig_prof.profesor', Auth::user()->id)
        ->where('modulos.asignatura', $id)
        ->where('estado_modulo', 'ACTIVO')
        ->where('modulos.grado_modulo', '<', 6)
        ->select("modulos.id","modulos.grado_modulo","modulos.objetivo_modulo", 'asignaturas.nombre')
        ->groupBy("asig_prof.grado","modulos.id","modulos.grado_modulo","modulos.objetivo_modulo", 'asignaturas.nombre')
        ->orderBy("modulos.grado_modulo", 'ASC')
        ->get();
   
        return $Modulo;
    }

    public static function Desmodulo($id) {
        $DesModulo = Modulos::join("asignaturas", "asignaturas.id", "modulos.asignatura")
                ->select('asignaturas.nombre', 'modulos.*')
                ->where('modulos.id', $id)
                ->first();
        return $DesModulo;
    }

  

    public static function listar() {

        $Asig = Modulos::join("asignaturas", "asignaturas.id", "modulos.asignatura")
                ->where('estado_modulo', 'ACTIVO')
                ->select("modulos.*", "asignaturas.nombre")
                ->get();
//        dd($Asig);die();
        return $Asig;
    }

    public static function ListarxAsig($idAsig) {
        $Grado = Modulos::where('asignatura', $idAsig)
                ->get();
        return $Grado;
    }

    public static function BuscarAsig($id) {
        $modulos = Modulos::findOrFail($id);
        return $modulos;
    }

    public static function listarGrupos($Grad) {
        $Grupos = Modulos::join("grupos", "grupos.modulo", "modulos.id")
        ->join("para_grupos", "para_grupos.id", "grupos.grupo")
                ->where('grado_modulo', $Grad)
                ->select('para_grupos.descripcion', 'grupos.grupo')
                ->groupBy('para_grupos.descripcion','grupos.grupo')
                ->orderBy("grupo", "ASC")
                ->get();
        return $Grupos;
    }


}
