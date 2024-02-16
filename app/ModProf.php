<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ModProf extends Model
{
    protected $table = 'mod_prof';
    protected $fillable = [
        'profesor',
        'asignatura',
        'grado',
        'grupo',
    ];

    public static function BuscDat($id)
    {
    //    dd(Session::get('GRUPO').'-'. Session::get('JORNADA').'-'.Auth::user()->grado_usuario.'-'.$id);die();
        $DatProf = ModProf::join("profesores", "profesores.usuario_profesor", "mod_prof.profesor")
            ->join("grados_modulos", 'grados_modulos.id', "mod_prof.grado")
            ->where('mod_prof.grado', $id)
            ->where('mod_prof.grupo', Session::get('GRUPO'))
            ->where('mod_prof.jornada', Session::get('JORNADA'))
            ->where('grados_modulos.grado_modulo', Auth::user()->grado_usuario)
            ->select('profesores.*')
            ->first();

        return $DatProf;
    }

}
