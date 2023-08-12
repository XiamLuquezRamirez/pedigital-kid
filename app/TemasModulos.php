<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class TemasModulos extends Model
{

    protected $table = 'contenido_modulo';
    protected $fillable = [
        'modulo',
        'periodo',
        'unidad',
        'titu_contenido',
        'tip_contenido',
        'hab_cont_didact',
        'estado',
        'objetivo_general',
        'docente',
    ];

    public static function temas($id)
    {
        if (Auth::user()->tipo_usuario == "Profesor") {
            $Usu = Auth::user()->id;

            $Temas = DB::connection("mysql")->select("SELECT conte.*, tdoc.visto_doc, tdoc.habilitado_doc,tdoc.ocultar_doc  "
            ." FROM contenido_modulo conte  LEFT  JOIN (SELECT * FROM temas_mod_docentes "
            ." WHERE doc = " . $Usu . ") tdoc ON conte.id =tdoc.tema WHERE conte.unidad=" . $id . " AND conte.estado='ACTIVO' "
            ." AND (conte.docente = ''  OR conte.docente = " . $Usu . ")   ORDER BY conte.id ASC");

        } else if (Auth::user()->tipo_usuario == "Estudiante") {
            $Usu = Session::get('USUDOCENTE');

            $Temas = DB::connection("mysql")->select("SELECT conte.*, tdoc.visto_doc, tdoc.habilitado_doc,tdoc.ocultar_doc  "
            ." FROM contenido_modulo conte  LEFT  JOIN (SELECT * FROM temas_mod_docentes WHERE doc = " . $Usu . ") tdoc ON conte.id =tdoc.tema "
            ." WHERE conte.unidad=" . $id . " AND conte.estado='ACTIVO' "
            ." AND (conte.docente = ''  OR conte.docente = " . $Usu . ")   ORDER BY conte.id ASC");

        } else {
            $Temas = TemasModulos::where('unidad', $id)
                ->where('estado', 'ACTIVO')
                ->get();
        }

        return $Temas;
    }

    public static function LisTemas($id)
    {
        if (Auth::user()->tipo_usuario == "Profesor") {
            $Usu = Auth::user()->id;

            $Temas = DB::connection("mysql")->select("SELECT conte.*, tdoc.visto_doc, tdoc.habilitado_doc,tdoc.ocultar_doc  "
            ." FROM contenido_modulo conte  LEFT  JOIN (SELECT * FROM temas_mod_docentes "
            ." WHERE doc = " . $Usu . ") tdoc ON conte.id =tdoc.tema "
            ."LEFT JOIN orden_temas_modulos ot ON conte.id=ot.tema AND ot.docente=".$Usu 
            ."WHERE conte.modulo=" . $id . " AND conte.estado='ACTIVO' "
            ." AND (conte.docente = ''  OR conte.docente = " . $Usu . ") ORDER BY conte.id ASC");

            return $Temas;
        } else if (Auth::user()->tipo_usuario == "Estudiante") {
            $Usu = Session::get('USUDOCENTE');

            $Temas = DB::connection("mysql")->select("SELECT conte.*, tdoc.visto_doc, tdoc.habilitado_doc,tdoc.ocultar_doc  "
            ." FROM contenido_modulo conte  LEFT  JOIN (SELECT * FROM temas_mod_docentes WHERE doc = " . $Usu . ") tdoc ON conte.id =tdoc.tema "
            ."LEFT JOIN orden_temas_modulos ot ON conte.id=ot.tema AND ot.docente=".$Usu 
            ." WHERE conte.modulo=" . $id . " AND conte.estado='ACTIVO' "
            ." AND (conte.docente = ''  OR conte.docente = " . $Usu . ") ORDER BY conte.id ASC");
            return $Temas;
        } else {
            $Temas = TemasModulos::where('modulo', $id)
                ->where('contenido_modulo.estado', 'ACTIVO')
                ->where("contenido_modulo.estado", "ACTIVO")
                ->get();
            return $Temas;
        }
    }

    public static function BuscarTema($id)
    {
        return TemasModulos::findOrFail($id);
    }

}
