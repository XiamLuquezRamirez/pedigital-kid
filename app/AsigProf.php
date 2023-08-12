<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AsigProf extends Model {

    protected $table = 'asig_prof';
    protected $fillable = [
        'profesor',
        'asignatura',
        'grado',
        'grupo'
    ];

    public static function BuscDat() {
  
        $DatProf = AsigProf::join("profesores", "profesores.usuario_profesor", "asig_prof.profesor")
                ->where('asig_prof.grupo', Session::get('IDGRUPO'))
                ->select('profesores.*')
                ->first();

        return $DatProf;
    }
    
    
    public static function BuscDat2($id) {
      //  dd(Session::get('GRUPO').'-'. Session::get('JORNADA').'-'.Auth::user()->grado_usuario.'-'.$id);die();
     
        $DatProf = AsigProf::leftjoin("profesores", "profesores.usuario_profesor", "asig_prof.profesor")
                ->leftjoin("modulos", 'modulos.id', "asig_prof.grado")
                ->where('asig_prof.grado', $id)
                ->where('asig_prof.grupo', Session::get('GRUPO'))
                ->where('profesores.jornada', Session::get('JORNADA'))
                ->where('modulos.grado_modulo', Auth::user()->grado_usuario)
                ->select('profesores.*')
                ->first();
          
        return $DatProf;
    }

    public static function ListModulos() {
        $DatProf = AsigProf::join("profesores", "profesores.usuario_profesor", "asig_prof.profesor")
                ->join("modulos", "modulos.id", "asig_prof.grado")
                ->join("asignaturas", "asignaturas.id", "modulos.asignatura")
                ->where('asig_prof.profesor', Auth::user()->id)
                ->where('modulos.estado_modulo', 'ACTIVO')
                ->where('modulos.grado_modulo', '<', 6)
                ->select('asignaturas.id', 'asignaturas.nombre')
                ->groupBy('asignaturas.id', 'asignaturas.nombre')
                ->get();

        return $DatProf;
    }

 

}
