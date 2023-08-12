<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{

    protected $table = 'evaluacion';
    protected $fillable = [
        'contenido',
        'titulo',
        'hab_conversacion',
        'intentos_perm',
        'calif_usando',
        'punt_max',
        'intentos_real',
        'clasificacion',
        'estado',
        'enunciado',
        'animacion',
        'tiempo',
        'docente',
        'origen_eval',
        'hab_tiempo',
        'calxdoc',
    ];

    public static function Guardar($datos)
    {
        return Evaluacion::create([
            'contenido' => $datos['tema_id'],
            'tip_evaluacion' => $datos['tip_evaluacion'],
            'titulo' => $datos['titulo'],
            'hab_conversacion' => $datos['HabConv'],
            'intentos_perm' => $datos['cb_intentosPer'],
            'calif_usando' => $datos['cb_CalUsando'],
            'punt_max' => $datos['Punt_Max'],
            'intentos_real' => '0',
            'clasificacion' => $datos['clasificacion'],
            'estado' => 'ACTIVO',
        ]);
    }

    public static function ModifEval($datos, $id)
    {

        $respuesta = Evaluacion::where(['id' => $id])->update([
            'tip_evaluacion' => $datos['tip_evaluacion'],
            'titulo' => $datos['titulo'],
            'hab_conversacion' => $datos['HabConv'],
            'intentos_perm' => $datos['cb_intentosPer'],
            'calif_usando' => $datos['cb_CalUsando'],
            'punt_max' => $datos['Punt_Max'],
            'clasificacion' => $datos['clasificacion'],
        ]);

        return $respuesta;
    }

    public static function DesEval($id)
    {
        $DesEval = Evaluacion::where('id', $id)
            ->first();
        return $DesEval;
    }
    public static function BusEval($id)
    {
        $DesEval = Evaluacion::where('id', $id)
            ->first();
        return $DesEval;
    }
    public static function ListEval($id, $or)
    {
        $DesEval = Evaluacion::where('contenido', $id)
            ->where('origen_eval', $or)
            ->get();
        return $DesEval;
    }
    public static function ListEvalxClasif($id, $clasf,$or)
    {
        if (Auth::user()->tipo_usuario == "Profesor") {
            $Usu = Auth::user()->id;
            $DesEval = Evaluacion::where('contenido', $id)
                ->where('clasificacion', $clasf)
                ->where('ESTADO', 'ACTIVO')
                ->where('origen_eval', $or)
                ->where(function ($query) use ($Usu) {
                    $query->where('evaluacion.docente', "")
                        ->orWhere('evaluacion.docente', $Usu);
                })
                ->get();
        } else if (Auth::user()->tipo_usuario == "Estudiante") {
            $Usu = Session::get('USUDOCENTE');
            $DesEval = Evaluacion::where('contenido', $id)
                ->where('clasificacion', $clasf)
                ->where('ESTADO', 'ACTIVO')
                ->where('origen_eval', $or)
                ->where(function ($query) use ($Usu) {
                    $query->where('evaluacion.docente', "")
                    ->orWhere('evaluacion.docente','LIKE', "%".$Usu."%");
                })
                ->get();
        } else {
            $DesEval = Evaluacion::where('contenido', $id)
                ->where('clasificacion', $clasf)
                ->where('ESTADO', 'ACTIVO')
                ->where('origen_eval', $or)
                ->get();
        }

        return $DesEval;

    }

    public static function UpdateIntentos($id)
    {
        $DesEval = Evaluacion::find($id);
        $DesEval->intentos_real = $DesEval->intentos_real + 1;
        $DesEval->save();
    }

    public static function editarestado($id, $estado)
    {
        $Respuesta = Evaluacion::where('id', $id)->update([
            'estado' => $estado,
        ]);
        return $Respuesta;
    }

    public static function DatosEvla($id, $or)
    {

        if ($or == "IFEVAL") {
            $DatEval = Evaluacion::join('contenido', 'contenido.id', 'evaluacion.contenido')
                ->join('unidades', 'unidades.id', 'contenido.unidad')
                ->join('modulos', 'modulos.id', 'unidades.modulo')
                ->join('asignaturas', 'modulos.asignatura', 'asignaturas.id')
                ->select('evaluacion.titulo', 'asignaturas.nombre', 'modulos.grado_modulo', 'unidades.des_unidad', 'contenido.titu_contenido', 'evaluacion.calif_usando', 'evaluacion.tiempo', 'evaluacion.punt_max', 'evaluacion.tip_evaluacion', 'evaluacion.id', 'evaluacion.enunciado', 'evaluacion.hab_conversacion', 'evaluacion.calxdoc')
                ->where('evaluacion.id', $id)
                ->first();
        } else {
            $DatEval = Evaluacion::join('contenido', 'contenido.id', 'evaluacion.contenido')
                ->join('unidades', 'unidades.id', 'contenido.unidad')
                ->join('modulos', 'modulos.id', 'unidades.modulo')
                ->join('eval_intentos', 'eval_intentos.evaluacion', 'evaluacion.id')
                ->join('asignaturas', 'modulos.asignatura', 'asignaturas.id')
                ->select('asignaturas.nombre', 'unidades.des_unidad', 'contenido.titu_contenido', 'evaluacion.intentos_perm', 'evaluacion.calif_usando', 'evaluacion.punt_max', 'evaluacion.tiempo', 'eval_intentos.int_realizados', 'evaluacion.tip_evaluacion', 'evaluacion.id', 'evaluacion.hab_conversacion', 'evaluacion.titulo', 'evaluacion.calxdoc', 'evaluacion.hab_tiempo')
                ->where('evaluacion.id', $id)
                ->where('eval_intentos.alumnos', Auth::user()->id)
                ->first();
        }

        return $DatEval;
    }

    public static function DatosEvaluacion($id)
    {
        $DatEval = Evaluacion::join('eval_intentos', 'eval_intentos.evaluacion', 'evaluacion.id')
            ->select('evaluacion.intentos_perm', 'evaluacion.calif_usando', 'evaluacion.punt_max', 'eval_intentos.int_realizados')
            ->where('evaluacion.id', $id)
            ->where('eval_intentos.alumnos', Auth::user()->id)
            ->first();
        return $DatEval;
    }

    public static function Gestion($busqueda, $pagina, $limit, $id)
    {
        if ($pagina == "1") {
            $offset = 0;
        } else {
            $pagina--;
            $offset = $pagina * $limit;
        }
        if (!empty($busqueda)) {
            $respuesta = Evaluacion::join('contenido', 'contenido.id', 'evaluacion.contenido')
                ->join('unidades', 'unidades.id', 'contenido.unidad')
                ->where(function ($query) use ($busqueda) {
                    $query->where('evaluacion.titulo', 'LIKE', '%' . $busqueda . '%')
                        ->orWhere('unidades.des_unidad', 'LIKE', '%' . $busqueda . '%');
                })
                ->where('unidades.modulo', $id)
                ->where('evaluacion.estado', 'ACTIVO')
                ->select('unidades.des_unidad', 'evaluacion.*')
                ->orderBy('evaluacion.id', 'ASC')
                ->limit($limit)->offset($offset);
        } else {
            $respuesta = Evaluacion::join('contenido', 'contenido.id', 'evaluacion.contenido')
                ->join('unidades', 'unidades.id', 'contenido.unidad')
                ->where('unidades.modulo', $id)
                ->where('evaluacion.estado', 'ACTIVO')
                ->select('unidades.des_unidad', 'evaluacion.*')
                ->orderBy('evaluacion.id', 'ASC')
                ->limit($limit)->offset($offset);
        }

        return $respuesta->get();
    }

    public static function numero_de_registros($busqueda, $id)
    {
        if (!empty($busqueda)) {
            $respuesta = Evaluacion::join('contenido', 'contenido.id', 'evaluacion.contenido')
                ->join('unidades', 'unidades.id', 'contenido.unidad')
                ->where(function ($query) use ($busqueda) {
                    $query->where('evaluacion.titulo', 'LIKE', '%' . $busqueda . '%')
                        ->orWhere('unidades.des_unidad', 'LIKE', '%' . $busqueda . '%');
                })
                ->where('unidades.modulo', $id)
                ->orderBy('evaluacion.id', 'ASC');
        } else {
            $respuesta = Evaluacion::join('contenido', 'contenido.id', 'evaluacion.contenido')
                ->join('unidades', 'unidades.id', 'contenido.unidad')
                ->where('unidades.modulo', $id);
        }
        return $respuesta->count();
    }

}
