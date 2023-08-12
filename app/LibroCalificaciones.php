<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Session;

class LibroCalificaciones extends Model
{

    protected $table = 'libro_calificaciones';
    protected $fillable = [
        'alumno',
        'evaluacion',
        'puntuacion',
        'calificacion',
        'fecha_pres',
        'calf_prof',
        'docente',
        'tiempo_usado',
        'estado_eval',
    ];

    public static function Guardar($datos, $respviejo, $resp, $InfEval, $fecha)
    {
        $Alumno = Auth::user()->id;
        $IdEval = $datos['IdEvaluacion'];
        $puntMaxi = $InfEval->punt_max;
        $TiemEval = "";
        $estado = "EN PROCESO";

        $Libro = self::BusEval($IdEval);

        if ($Libro) {
            $puntaje = $Libro->puntuacion;
        } else {
            $puntaje = 0;
        }

        if ($datos['TipPregunta'] == "PREGENSAY") {
            $Calificacion = "0/" . strval($puntMaxi);
            $CalProf = "";
            $PunPreg = \App\PuntPreg::Guardar($IdEval, $resp->pregunta, "0");
        } else if ($datos['TipPregunta'] == "COMPLETE") {
            $Calificacion = "0/" . strval($puntMaxi);
            $CalProf = "";
            $PunPreg = \App\PuntPreg::Guardar($IdEval, $resp->pregunta, "0");

        } else if ($datos['TipPregunta'] == "OPCMULT") {

            $Preg = PregOpcMul::where('id', $resp->pregunta)
                ->first();
            $DesOpcPreg = OpcPregMul::where('pregunta', $resp->pregunta)
                ->get();
            if ($respviejo) {

                foreach ($DesOpcPreg as $OP) {
                    if ($OP->id == $respviejo->respuesta) {
                        if ($OP->correcta == "si") {
                            $puntaje = (int) $puntaje - (int) $Preg->puntuacion;
                        }
                    }
                }
            }

            foreach ($DesOpcPreg as $OP) {
                if ($OP->id == $resp->respuesta) {
                    if ($OP->correcta == "si") {
                        $puntaje = (int) $puntaje + (int) $Preg->puntuacion;
                        $PunPreg = \App\PuntPreg::Guardar($IdEval, $resp->pregunta, $Preg->puntuacion);
                    } else {
                        $PunPreg = \App\PuntPreg::Guardar($IdEval, $resp->pregunta, '0');
                    }
                }
            }

            $Calificacion = $puntaje . "/" . strval($puntMaxi);
            $CalProf = "";

        } else if ($datos['TipPregunta'] == "VERFAL") {

            $PregVerFal = EvalVerFal::where('id', $resp->pregunta)
                ->first();

            if ($respviejo) {
                if ($respviejo->respuesta_alumno == $PregVerFal->respuesta) {
                    $puntaje = (int) $puntaje - (int) $PregVerFal->puntaje;
                }
            }

            if ($resp->respuesta_alumno == $PregVerFal->respuesta) {
                $puntaje = (int) $puntaje + (int) $PregVerFal->puntaje;
                $PunPreg = \App\PuntPreg::Guardar($IdEval, $resp->pregunta, $PregVerFal->puntaje);
            } else {
                $PunPreg = \App\PuntPreg::Guardar($IdEval, $resp->pregunta, '0');

            }

            $Calificacion = $puntaje . "/" . strval($puntMaxi);
            $CalProf = "";
        } else if ($datos['TipPregunta'] == "RELACIONE") {

            $PregRelacione = PregRelacione::where('id', $resp->eval_preg)
                ->first();
            $control = 1;

            if ($respviejo) {
                foreach ($respviejo as $respV) {
                    if ($respV->opcion != $respV->correcta) {
                        $control++;
                    }
                }

                if ($control == 1) {
                    $puntaje = (int) $puntaje - (int) $PregRelacione->puntaje;
                    $PunPreg = \App\PuntPreg::Guardar($IdEval, $PregRelacione->id, $PregRelacione->puntaje);
                } else {
                    $PunPreg = \App\PuntPreg::Guardar($IdEval, $PregRelacione->id, '0');

                }
            }

            $RespPreRel = RespEvalRelacione::leftjoin('eval_relacione_def', 'resp_pregrelacione.pregunta', 'eval_relacione_def.id')
                ->leftjoin('eval_relacione_opc', 'resp_pregrelacione.respuesta_alumno', 'eval_relacione_opc.id')
                ->where('resp_pregrelacione.eval_preg', $resp->eval_preg)
                ->select('eval_relacione_def.opcion', 'eval_relacione_opc.correcta')
                ->get();

            $control = 1;

            foreach ($RespPreRel as $resp) {
                if ($resp->opcion != $resp->correcta) {
                    $control++;
                }
            }

            if ($control == 1) {
                $puntaje = (int) $puntaje + (int) $PregRelacione->puntaje;
            }

            $Calificacion = $puntaje . "/" . strval($puntMaxi);
            $CalProf = "";
        } else if ($datos['TipPregunta'] == "TALLER") {

            $Calificacion = $puntaje . "/" . strval($puntMaxi);
            $CalProf = "";
            $PunPreg = \App\PuntPreg::Guardar($IdEval, $resp->pregunta, "0");
        }

        if ($datos['nPregunta'] == "Ultima") {

            if ($InfEval->calxdoc === "NO") {
                $estado = "CALIFICADA";
                $CalProf = "si";
            } else {
                $estado = "TERMINADA";
            }
            $TiemEval = $datos['Tiempo'];

        }
        $puntaje = 0;

        $PunPreg = \App\PuntPreg::ConsulPuntEval($IdEval, Auth::user()->id);
        foreach ($PunPreg as $PunP) {
            $puntaje = (int) $puntaje + (int) $PunP->puntos;
        }

        $Calificacion = $puntaje . "/" . strval($puntMaxi);

        return LibroCalificaciones::updateOrCreate([
            'alumno' => $Alumno, 'evaluacion' => $IdEval,
        ], [
            'alumno' => $Alumno,
            'evaluacion' => $IdEval,
            'puntuacion' => $puntaje,
            'calificacion' => $Calificacion,
            'fecha_pres' => $fecha,
            'calf_prof' => $CalProf,
            'docente' => $datos['Id_Docente'],
            'tiempo_usado' => $TiemEval,
            'estado_eval' => $estado,
        ]);
    }

      public static function BusEvalList($id, $alum)
    {
        $DesEval = LibroCalificaciones::where('evaluacion', $id)
            ->where("alumno", $alum)
            ->first();
        return $DesEval;
    }

    public static function Buscar($InfEval)
    {

        $libro = LibroCalificaciones::rightjoin('alumnos', function ($join) use ($InfEval) {
            $join->on('alumnos.usuario_alumno', '=', 'libro_calificaciones.alumno')
                ->where('libro_calificaciones.evaluacion', '=', $InfEval->id);
        })
            ->where('alumnos.grupo', Session::get('GrupAct'))
            ->where('alumnos.grado_alumno', Session::get('GRADO'))
            ->select('alumnos.nombre_alumno', 'alumnos.apellido_alumno', 'alumnos.grado_alumno', 'libro_calificaciones.*')
            ->get();
        return $libro;
    }

    public static function BuscarEvalxAlumn($id, $or)
    {

        if ($or == "C") {
            $Calif = LibroCalificaciones::join('evaluacion', 'evaluacion.id', 'libro_calificaciones.evaluacion')
                ->join('contenido', 'contenido.id', 'evaluacion.contenido')
                ->join('modulos', 'modulos.id', 'contenido.modulo')
                ->join('alumnos', 'alumnos.usuario_alumno', 'libro_calificaciones.alumno')
                ->where('libro_calificaciones.alumno', Auth::user()->id)
                ->where('modulos.id', $id)
                ->whereNotIn('evaluacion.origen_eval', ['M'])
                ->select('evaluacion.titulo', 'evaluacion.punt_max', 'libro_calificaciones.*', 'modulos.id as modu', 'contenido.titu_contenido')
                ->orderBy('evaluacion.id', 'desc')
                ->take(20)
                ->get();
        } else {
            $Calif = LibroCalificaciones::join('evaluacion', 'evaluacion.id', 'libro_calificaciones.evaluacion')
                ->join('contenido_modulo', 'contenido_modulo.id', 'evaluacion.contenido')
                ->join('grados_modulos', 'grados_modulos.id', 'contenido_modulo.modulo')
                ->join('alumnos', 'alumnos.usuario_alumno', 'libro_calificaciones.alumno')
                ->where('libro_calificaciones.alumno', Auth::user()->id)
                ->where('grados_modulos.id', $id)
                ->where('evaluacion.origen_eval', $or)
                ->select('evaluacion.titulo', 'evaluacion.punt_max', 'libro_calificaciones.*', 'grados_modulos.id as modu', 'contenido_modulo.titu_contenido')
                ->orderBy('evaluacion.id', 'desc')
                ->take(20)
                ->get();

        }

        return $Calif;

    }

    
    public static function BuscarEvalxAlumnMod($id)
    {

        return LibroCalificaciones::join('evaluacion', 'evaluacion.id', 'libro_calificaciones.evaluacion')
            ->join('contenido', 'contenido.id', 'evaluacion.contenido')
            ->join('modulos', 'modulos.id', 'contenido.modulo')
            ->join('alumnos', 'alumnos.usuario_alumno', 'libro_calificaciones.alumno')
            ->where('libro_calificaciones.alumno', Auth::user()->id)
            ->where('modulos.id', $id)
            ->where('evaluacion.origen_eval', 'M')
            ->select('evaluacion.titulo', 'evaluacion.punt_max', 'libro_calificaciones.*', 'modulos.id as modu')
            ->get();
    }

    public static function BusDetLib($id)
    {

        $InfEval = LibroCalificaciones::join('alumnos', 'alumnos.usuario_alumno', 'libro_calificaciones.alumno')
            ->join('evaluacion', 'evaluacion.id', 'libro_calificaciones.evaluacion')
            ->select('alumnos.nombre_alumno', 'alumnos.apellido_alumno', 'alumnos.grado_alumno', 'evaluacion.titulo', 'evaluacion.punt_max', 'libro_calificaciones.*')
            ->where('libro_calificaciones.id', $id)
            ->first();

        return $InfEval;
    }

    public static function BusEval($id)
    {
        $DesEval = LibroCalificaciones::where('evaluacion', $id)
            ->first();
        return $DesEval;
    }

    public static function DatosEvalAlumno($id)
    {

        $InfEval = LibroCalificaciones::join('alumnos', 'alumnos.usuario_alumno', 'libro_calificaciones.alumno')
            ->join('evaluacion', 'evaluacion.id', 'libro_calificaciones.evaluacion')
            ->select('alumnos.nombre_alumno', 'alumnos.apellido_alumno', 'alumnos.grado_alumno', 'evaluacion.titulo', 'evaluacion.punt_max', 'libro_calificaciones.*')
            ->where('libro_calificaciones.alumno', $id)
            ->get();
        return $InfEval;
    }

}
