<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Temas extends Model
{

    protected $table = 'contenido';
    protected $fillable = [
        'modulo',
        'periodo',
        'unidad',
        'titu_contenido',
        'tip_contenido',
        'tip_eval',
        'estado',
        'objetivo_general',
    ];

    public static function temas($id)
    {
        $Temas = Temas::where('unidad', $id)
            ->get();
        return $Temas;
    }

    public static function Gestion($busqueda, $pagina, $limit, $Asig)
    {
        if ($pagina == "1") {
            $offset = 0;
        } else {
            $pagina--;
            $offset = $pagina * $limit;
        }
        if (!empty($busqueda)) {
            if (!empty($Asig)) {
                $respuesta = Temas::join('unidades', 'unidades.id', 'contenido.unidad')
                    ->join('modulos', 'modulos.id', 'unidades.modulo')
                    ->join('asignaturas', 'asignaturas.id', 'modulos.asignatura')
                    ->where('modulos.asignatura', $Asig)
                    ->where('contenido.estado', 'ACTIVO')
                    ->where(function ($query) use ($busqueda) {
                        $query->where('contenido.titu_contenido', 'LIKE', '%' . $busqueda . '%')
                            ->orWhere('contenido.tip_contenido', 'LIKE', '%' . $busqueda . '%')
                            ->orWhere('unidades.nom_unidad', 'LIKE', '%' . $busqueda . '%')
                            ->orWhere('asignaturas.nombre', 'LIKE', '%' . $busqueda . '%');
                    })
                    ->select('contenido.*', 'asignaturas.nombre', 'modulos.grado_modulo', 'unidades.nom_unidad', 'unidades.des_unidad')
                    ->orderBy('asignaturas.nombre', 'ASC')
                    ->limit($limit)->offset($offset);
            } else {
                $respuesta = Temas::join('unidades', 'unidades.id', 'contenido.unidad')
                    ->join('modulos', 'modulos.id', 'unidades.modulo')
                    ->join('asignaturas', 'asignaturas.id', 'modulos.asignatura')
                    ->where('contenido.estado', 'ACTIVO')
                    ->where(function ($query) use ($busqueda) {
                        $query->where('contenido.titu_contenido', 'LIKE', '%' . $busqueda . '%')
                            ->orWhere('contenido.tip_contenido', 'LIKE', '%' . $busqueda . '%')
                            ->orWhere('unidades.nom_unidad', 'LIKE', '%' . $busqueda . '%')
                            ->orWhere('asignaturas.nombre', 'LIKE', '%' . $busqueda . '%');
                    })
                    ->select('contenido.*', 'asignaturas.nombre', 'modulos.grado_modulo', 'unidades.nom_unidad', 'unidades.des_unidad')
                    ->orderBy('asignaturas.nombre', 'ASC')
                    ->limit($limit)->offset($offset);
            }
        } else {
            if (!empty($Asig)) {
                $respuesta = Temas::join('unidades', 'unidades.id', 'contenido.unidad')
                    ->join('modulos', 'modulos.id', 'unidades.modulo')
                    ->join('asignaturas', 'asignaturas.id', 'modulos.asignatura')
                    ->select('contenido.*', 'asignaturas.nombre', 'modulos.grado_modulo', 'unidades.nom_unidad', 'unidades.des_unidad')
                    ->where('contenido.estado', 'ACTIVO')
                    ->where('modulos.asignatura', $Asig)
                    ->orderBy('asignaturas.nombre', 'ASC')
                    ->limit($limit)->offset($offset);
            } else {

                $respuesta = Temas::join('unidades', 'unidades.id', 'contenido.unidad')
                    ->join('modulos', 'modulos.id', 'unidades.modulo')
                    ->join('asignaturas', 'asignaturas.id', 'modulos.asignatura')
                    ->select('contenido.*', 'asignaturas.nombre', 'modulos.grado_modulo', 'unidades.nom_unidad', 'unidades.des_unidad')
                    ->where('contenido.estado', 'ACTIVO')
                    ->orderBy('asignaturas.nombre', 'ASC')
                    ->limit($limit)->offset($offset);
            }
        }

        return $respuesta->get();
    }

    public static function BuscarTema($id)
    {

        return Temas::findOrFail($id);
    }

    public static function LisTemas($id)
    {
        if (Auth::user()->tipo_usuario == "Profesor") {
            $Usu = Auth::user()->id;


            $Temas = DB::connection("mysql")->select("SELECT conte.id as idcon,conte.*, tdoc.visto_doc, tdoc.habilitado_doc,tdoc.ocultar_doc "
                . "FROM contenido conte  LEFT  JOIN (SELECT * FROM temas_docentes WHERE doc = " . $Usu . ") tdoc ON conte.id =tdoc.tema "
                . "LEFT JOIN orden_temas ot ON conte.id=ot.tema AND ot.docente=" . $Usu
                . " WHERE conte.modulo=" . $id . " AND conte.estado='ACTIVO' "
                . "AND (conte.docente = ''  OR conte.docente = " . $Usu . ")  ORDER BY ISNULL(conse), conse ASC");

            return $Temas;
        } else if (Auth::user()->tipo_usuario == "Estudiante") {
            $Usu = Session::get('USUDOCENTE');
           
            $Temas = DB::connection("mysql")->select("SELECT conte.id as idcon,conte.*, tdoc.visto_doc, tdoc.habilitado_doc,tdoc.ocultar_doc "
                . "FROM contenido conte  LEFT  JOIN (SELECT * FROM temas_docentes WHERE doc = " . $Usu . ") tdoc ON conte.id =tdoc.tema "
                . " LEFT JOIN orden_temas ot ON conte.id=ot.tema AND ot.docente=" . $Usu
                . " WHERE conte.modulo=" . $id . " AND conte.estado='ACTIVO' "
                . "AND (conte.docente = ''  OR conte.docente = " . $Usu . ")  ORDER BY ISNULL(conse), conse ASC");
               
            return $Temas;
        } else {
            $Temas = Temas::where('modulo', $id)
                ->where("contenido.estado", "ACTIVO")
                ->orderBy('contenido.id', 'ASC')
                ->get();
            return $Temas;
        }

    
    }

    public static function numero_de_registros($busqueda, $Asig)
    {
        if (!empty($busqueda)) {
            if (!empty($Asig)) {
                $respuesta = Temas::join('unidades', 'unidades.id', 'contenido.unidad')
                    ->join('modulos', 'modulos.id', 'unidades.modulo')
                    ->join('asignaturas', 'asignaturas.id', 'modulos.asignatura')
                    ->where('contenido.estado', 'ACTIVO')
                    ->where('modulos.asignatura', $Asig)
                    ->where(function ($query) use ($busqueda) {
                        $query->where('contenido.titu_contenido', 'LIKE', '%' . $busqueda . '%')
                            ->orWhere('contenido.tip_contenido', 'LIKE', '%' . $busqueda . '%')
                            ->orWhere('unidades.nom_unidad', 'LIKE', '%' . $busqueda . '%')
                            ->orWhere('asignaturas.nombre', 'LIKE', '%' . $busqueda . '%');
                    })
                    ->select('contenido.*', 'asignaturas.nombre', 'modulos.grado_modulo', 'unidades.nom_unidad', 'unidades.des_unidad')
                    ->orderBy('asignaturas.nombre', 'ASC');
            } else {
                $respuesta = Temas::join('unidades', 'unidades.id', 'contenido.unidad')
                    ->join('modulos', 'modulos.id', 'unidades.modulo')
                    ->join('asignaturas', 'asignaturas.id', 'modulos.asignatura')
                    ->where('contenido.estado', 'ACTIVO')
                    ->where(function ($query) use ($busqueda) {
                        $query->where('contenido.titu_contenido', 'LIKE', '%' . $busqueda . '%')
                            ->orWhere('contenido.tip_contenido', 'LIKE', '%' . $busqueda . '%')
                            ->orWhere('unidades.nom_unidad', 'LIKE', '%' . $busqueda . '%')
                            ->orWhere('asignaturas.nombre', 'LIKE', '%' . $busqueda . '%');
                    })
                    ->select('contenido.*', 'asignaturas.nombre', 'modulos.grado_modulo', 'unidades.nom_unidad', 'unidades.des_unidad')
                    ->orderBy('asignaturas.nombre', 'ASC');
            }
        } else {
            if (!empty($Asig)) {
                $respuesta = Temas::join('unidades', 'unidades.id', 'contenido.unidad')
                    ->join('modulos', 'modulos.id', 'unidades.modulo')
                    ->join('asignaturas', 'asignaturas.id', 'modulos.asignatura')
                    ->select('contenido.*', 'asignaturas.nombre', 'modulos.grado_modulo', 'unidades.nom_unidad', 'unidades.des_unidad')
                    ->where('contenido.estado', 'ACTIVO')
                    ->where('modulos.asignatura', $Asig)
                    ->orderBy('asignaturas.nombre', 'ASC');
            } else {
                $respuesta = Temas::join('unidades', 'unidades.id', 'contenido.unidad')
                    ->join('modulos', 'modulos.id', 'unidades.modulo')
                    ->join('asignaturas', 'asignaturas.id', 'modulos.asignatura')
                    ->select('contenido.*', 'asignaturas.nombre', 'modulos.grado_modulo', 'unidades.nom_unidad', 'unidades.des_unidad')
                    ->where('contenido.estado', 'ACTIVO')
                    ->orderBy('asignaturas.nombre', 'ASC');
            }
        }
        return $respuesta->count();
    }

    public static function GuardarTipCont($datos)
    {

        return Temas::create([
            'modulo' => $datos['modulo'],
            'periodo' => $datos['periodo'],
            'unidad' => $datos['unidad'],
            'titu_contenido' => $datos['titu_contenido'],
            'tip_contenido' => $datos['tip_contenido'],
            'tip_eval' => $datos['tip_eval'],
            'estado' => 'ACTIVO',
            'objetivo_general' => $datos['objetivo_general'],
        ]);
    }

    public static function modificar($datos, $id)
    {
        $respuesta = Temas::where(['id' => $id])->update([
            'modulo' => $datos['modulo'],
            'periodo' => $datos['periodo'],
            'unidad' => $datos['unidad'],
            'titu_contenido' => $datos['titu_contenido'],
            'tip_contenido' => $datos['tip_contenido'],
        ]);
        return $respuesta;
    }

    public static function editarestado($id, $estado)
    {
        $Respuesta = Temas::where('id', $id)->update([
            'estado' => $estado,
        ]);
        return $Respuesta;
    }

    public static function cambiarvisto($id, $estado)
    {
        $Respuesta = Temas::where('id', $id)->update([
            'visto' => $estado,
        ]);
        // dd($Respuesta);die;
        return $Respuesta;
    }

}
