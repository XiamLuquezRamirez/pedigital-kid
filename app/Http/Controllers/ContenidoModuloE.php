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
