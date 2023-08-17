<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ContenidoModuloE extends Controller
{
    public function cargarAsignaturas()
    {
        if (Auth::check()) {
            $bandera = "";
            $Asignatura = \App\AsignaturasModuloE::AsigxUsu(Auth::user()->grado_usuario, Auth::user()->tipo_usuario);
            $Log = \App\Log::Guardar('Cargar Asignaturas Módulo E', '');
            if (request()->ajax()) {
                return response()->json([
                    'Asignatura' => $Asignatura
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesión ha terminado");
        }
    }

    public function CargarSimulacros()
    {

        return view('ModuloE.PrincipalSimulacro');

    }

    public function ConsultarSimulacros()
    {
        if (Auth::check()) {

          $Simualacros = \App\Simulacros::CargarSimulacros();
            for ($i = 0; $i < count($Simualacros); $i++) {
                $DetaSesionxsimulacro = \App\DetaSesionesSimul::ConsultarSesiones($Simualacros[$i]['id']);
                $Simualacros[$i]['SesionesxSimulacro'] = $DetaSesionxsimulacro;
            }

            if (request()->ajax()) {
                return response()->json([
                    'Simualacros' => $Simualacros,
                ]);
            }
        } else {
            return redirect('/')->with('error', 'Su sesión ha Terminado');
        }
    }

    public function ConsultarSesiones()
    {

        if (Auth::check()) {

            $idSimu = request()->get('idSimu');
            $Simulacro = \App\Simulacros::BuscarSimuxEstu($idSimu);
            $Sesiones = \App\DetaSesionesSimul::ConsultarSesiones($idSimu);

            for ($i = 0; $i < $Sesiones->count(); $i++) {
                $DetaSesionAreas = \App\SessionArea::Consultar($Sesiones[$i]['id']);
                $Sesiones[$i]['AreasxSesiones'] = $DetaSesionAreas;
            }

            if (request()->ajax()) {
                return response()->json([
                    'Simulacro' => $Simulacro,
                    'Sesiones' => $Sesiones,
                ]);
            }
        } else {
            return redirect('/')->with('error', 'Su sesión ha Terminado');
        }
    }

    public function ConsultarAreasxSesion()
    {
        if (Auth::check()) {
            $idAreaSes = request()->get('idSesi');
            $Sesion = \App\DetaSesionesSimul::ConsultarSesion($idAreaSes);
            $SesAre = \App\SessionArea::ConsultarAreasSesion($idAreaSes);

            if (request()->ajax()) {
                return response()->json([
                    'SesAre' => $SesAre,
                    'Sesion' => $Sesion,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }


    public function ConsultarPreguntasAreas()
    {

        if (Auth::check()) {
            $datos = request()->all();

            $idArea = $datos['idAreaSesion'];
            $areaxsesion = \App\SessionArea::ConsultarInf($idArea);
            ////MODIFICAR CONSULTA QUE TRAE LAS PREGUNTAS DE INGLES
            if ($areaxsesion->area == "5") {
                $PregArea = \App\ModE_PreguntAreas::ConsultarInfIngles($idArea, "Est");
            } else {
                $PregArea = \App\ModE_PreguntAreas::ConsultarInf($idArea);
            }




            //    $PregArea = \App\ModE_PreguntAreas::ConsultarInf($idArea);
            if (request()->ajax()) {
                return response()->json([
                    'PregArea' => $PregArea,
                    'areaxsesion' => $areaxsesion,

                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function consulPregAlumnoSimu()
    {
        if (Auth::check()) {
            $IdPreg = request()->get('Pregunta');
            $partePreg = request()->get('partePreg');
            $sesion = request()->get('sesionId');


            if ($partePreg == "PARTE 1") {
                $PregMult = \App\PreguntasParte1::ConsultarPregParte($IdPreg);
                $OpciMult =  \App\PregOpcMulMe::ConsulPreg($PregMult->parte);
                $opciMultCompe = $OpciMult->competencia;
                $opciMultCompo = $OpciMult->componente;
                $OpciMult = $OpciMult->pregunta;

                $RespPregMul = \App\PreguntasParte1::BuscOpcRespPruebaParte($IdPreg, Auth::user()->id, $sesion);
            } else {
                $PregMult = \App\PregOpcMulMe::ConsulPreg($IdPreg);
                $OpciMult = \App\OpcPregMulModuloE::ConsulGrupOpcPreg($IdPreg);
                $opciMultCompe = $PregMult->competencia;
                $opciMultCompo = $PregMult->componente;
                $RespPregMul = \App\OpcPregMulModuloE::BuscOpcRespPrueba($IdPreg, Auth::user()->id, $sesion);
            }




            if (request()->ajax()) {
                return response()->json([
                    'PregMult' => $PregMult,
                    'OpciMult' => $OpciMult,
                    'RespPregMul' => $RespPregMul,
                    'opciMultCompe' => $opciMultCompe,
                    'opciMultCompo' => $opciMultCompo,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }


    public function RespSimulacro()
    {
        if (Auth::check()) {
            $datos = request()->all();

            $fecha = date('Y-m-d  H:i:s');

            $Respuesta = \App\RespMultPregMEPruebaSimulacro::Guardar($datos, $fecha);

            $Sesiones = \App\sesiones::Guardar(Auth::user()->id);

            if ($datos['PosPreg'] === "Ultima") {
                $LibroCalif = \App\LibroPruebaModuloE::Guardar($datos, $Respuesta['RegViejo'], $Respuesta['RegNuevo'], $fecha);

                $Log = \App\Log::Guardar('Pregunta Desarrollada Simulacro', $datos['idSimulacro']);

                $Sesion = \App\DetaSesionesSimul::ConsultarSesion($datos['IdSesion']);
                $SesAre = \App\SessionArea::ConsultarAreasSesion($datos['IdSesion']);

                if (request()->ajax()) {
                    return response()->json([
                        'SesAre' => $SesAre,
                        'Sesion' => $Sesion,
                    ]);
                }
            } else {
                $LibroCalif = \App\LibroPruebaModuloE::Guardar($datos, $Respuesta['RegViejo'], $Respuesta['RegNuevo'], $fecha);

                if ($Respuesta) {
                    if (request()->ajax()) {
                        return response()->json([
                            'Resp' => 'guardada',
                        ]);
                    }
                }
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

    public function guadarInicioSesion()
    {
        $datos = request()->all();
        $Sesion = \App\SesionAlumnos::Consultar($datos);
        if ($Sesion->count() == 0) {
            $Sesion = \App\SesionAlumnos::Guardar($datos);
        }
        if (request()->ajax()) {
            return response()->json([
                'Sesion' => $Sesion,

            ]);
        }
    }
    
    public function GuardarSesionEstudiante()
    {
        if (Auth::check()) {
            $datos = request()->all();
            $flagt = "1";

            $DetaSesion = \App\SesionAlumnos::Editar($datos);
            $DetaSesion = \App\SesionAlumnos::ConsultarTodo($datos);



            foreach ($DetaSesion as $ses) {
                if ($ses->estado != "FINALIZADA") {
                    $flagt = "0";
                }
            }

            if ($flagt == "1") {
                $Simula = \App\simulacrosEstudiantes::guardar($datos);
            }

            //   $areaSesion = \App\SesionAlumnos::Guardar($datos);
            if (request()->ajax()) {
                return response()->json([
                    'DetaSesion' => $DetaSesion,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesión ha Terminado");
        }
    }

    public function CargarTemasModuloE()
    {
        if (Auth::check()) {
            $idAsig = request()->get('idAsig');

            $Temas = \App\TemasModuloE::listarxAssig($idAsig);
            $InfAsig = \App\AsignaturasModuloE::BuscarAsig($idAsig);
            Session::put('DOCENTE', $InfAsig->docente);
            if (request()->ajax()) {
                return response()->json([
                    'Temas' => $Temas,
                    'NomAsig' => $InfAsig->nombre . ' - Grado ' . $InfAsig->grado . '°',
                    'Docente' => $InfAsig->docente,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesión ha terminado");
        }
    }


    public function CargaDetTemasModuloE()
    {
        if (Auth::check()) {
            $idTema = request()->get('idTem');
            $TipCont = request()->get('TipCont');
            $detTema = "";
            $Tema = \App\TemasModuloE::BuscarTem($idTema);
            if ($TipCont === "DOC") {
                $TemasDet = \App\TemasModuloE_Doc::BuscarTema($idTema);
            } else if ($TipCont === "IMG") {
                $TemasDet = \App\TemasModuloE_Img::BuscarTema($idTema);
                $detTema = $TemasDet->first();
                $detTema = $detTema->imagen;
            } else {
                $TemasDet = \App\TemasModuloE_Vid::BuscarTema($idTema);
            }

            $Practicas = \App\Evaluacion::ListEval($idTema, 'ME');

            if (request()->ajax()) {
                return response()->json([
                    'TemasDet' => $TemasDet,
                    'Tema' => $Tema,
                    'npractica' => count($Practicas),
                    'primeImg' => $detTema,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesión ha terminado");
        }
    }

    public function CargarPracticas()
    {

        
        if (Auth::check()) {
            $id = request()->get('Tema');
            $Clasf = request()->get('clasf');
            $Temas = \App\TemasModuloE::BuscarTem($id);

            $Eval = \App\Evaluacion::ListEvalxClasif($id, $Clasf, 'ME');

            foreach ($Eval as $eval){
                $busResp = \App\LibroCalificaciones::BusEvalList($eval->id,Auth::user()->id);
                if($busResp){
                    $eval->evaluado = $busResp->estado_eval;
                   
                }else{
                    $eval->evaluado ="no";
                }
             
            }

            $Sesiones = \App\sesiones::Guardar(Auth::user()->id);

            if (request()->ajax()) {
                return response()->json([
                    'Eval' => $Eval,
                    'TitTemas' => $Temas->titulo,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su Sesión ha Terminado");
        }
    }

}
