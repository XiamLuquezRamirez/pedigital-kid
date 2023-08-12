<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ContenidoController extends Controller
{

    public function VerTema($IdTema)
    {
        $IdGrad = Session::get('IDGRADO');
        $Contenido = "";
        $Titulo = "";
        $IdUsu = Session::get('IDUSU');
      
        Session::put('IDTEMA', $IdTema);
        $ActIni = 'n';
        $Produc = 'n';
        $Animac = 'n';

        if (Auth::check()) {

            $Modulos = \App\Modulos::BuscarAsig($IdGrad);
            $Grado = $Modulos->grado_modulo;

            $Asig = \App\Asignaturas::InfAsig($Modulos->asignatura);
            $NomAsig = $Asig->nombre;
            if (Auth::user()->tipo_usuario == "Profesor") {
                $NomCom = Auth::user()->nombre_usuario;
            } else {
                $Estud = \App\Alumnos::Buscar($IdUsu);
                $Nombre = explode(' ', $Estud->nombre_alumno);
                $Apellido = explode(' ', $Estud->apellido_alumno);
                $NomCom = $Nombre[0] . " " . $Apellido[0];
            }

            $Temas = \App\Temas::BuscarTema($IdTema);
            $Unidad = \App\Unidades::BuscarUnidad($Temas->unidad);
            $TitUnidad = $Unidad->nom_unidad . ' - ' . $Unidad->des_unidad;
            $infEval = \App\Evaluacion::ListEval($IdTema, 'C');

            $TipCont = $Temas->tip_contenido;
            $Titulo = $Temas->titu_contenido;

            if ($TipCont == "DOCUMENTO") {
                $DesaTema = \App\DesarrollTema::Destemas($IdTema, 'NO');
                $Titulo = $DesaTema->titulo;
                $Contenido = $DesaTema->cont_documento;

            } else if ($TipCont == "ARCHIVO") {

                $DesaTema = \App\SubirArcTema::DesArch($IdTema, 'NO');
            } else {
                $DesaTema = \App\ContDidactico::BuscarTema($IdTema, 'NO');
            }

            if ($Temas->hab_cont_didact === "SI") {
                $Animac = 's';
            }

            foreach ($infEval as $Eval) {
                if ($Eval->clasificacion == "ACTINI") {
                    $ActIni = 's';
                }

                if ($Eval->clasificacion == "PRODUC") {
                    $Produc = 's';
                }
            }

            return view('Contenido.Tema', compact('Temas', 'Grado', 'NomAsig', 'NomCom', 'Titulo', 'Contenido', 'TitUnidad', 'ActIni', 'Produc', 'Animac', 'TipCont', 'DesaTema'));
        } else {
            return redirect("/");
        }
    }

    public function VerTemasMod($IdTema)
    {
        $IdGrad = Session::get('IDGRADO');
        $Contenido = "";
        $Titulo = "";
       
        $IdUsu = Session::get('IDUSU');
        Session::put('IDTEMA', $IdTema);
        $ActIni = 'n';
        $Produc = 'n';
        $Animac = 'n';

        if (Auth::check()) {

            $Modulos = \App\GradosModulos::BuscarAsig($IdGrad);
            $Grado = $Modulos->grado_modulo;

            $Asig = \App\ModulosTransversales::InfAsig($Modulos->modulo);
            $NomAsig = $Asig->nombre;
            if (Auth::user()->tipo_usuario == "Profesor") {
                $NomCom = Auth::user()->nombre_usuario;
            } else {
                $Estud = \App\Alumnos::Buscar($IdUsu);
                $Nombre = explode(' ', $Estud->nombre_alumno);
                $Apellido = explode(' ', $Estud->apellido_alumno);
                $NomCom = $Nombre[0] . " " . $Apellido[0];
            }
            $Temas = \App\TemasModulos::BuscarTema($IdTema);
            $TipCont = $Temas->tip_contenido;
            $Titulo = $Temas->titu_contenido;

            $Unidad = \App\UnidadesModulos::BuscarUnidad($Temas->unidad);

            $TitUnidad = $Unidad->nom_unidad . ' - ' . $Unidad->des_unidad;
            $infEval = \App\Evaluacion::ListEval($IdTema, 'M');

            if ($Temas->tip_contenido == "DOCUMENTO") {
                $DesaTema = \App\DesarrollTemaModulos::Destemas($IdTema, 'NO');
                $Titulo = $DesaTema->titulo;
                $Contenido = $DesaTema->cont_documento;
            } else if ($TipCont == "ARCHIVO") {

                $DesaTema = \App\SubirArcTemaMod::DesArch($IdTema, 'NO');
            } else {
                $DesaTema = \App\ContDidacticoMod::BuscarTema($IdTema, 'NO');
            }

            if ($Temas->hab_cont_didact === "SI") {
                $Animac = 's';
            }

            foreach ($infEval as $Eval) {
                if ($Eval->clasificacion == "ACTINI") {
                    $ActIni = 's';
                }

                if ($Eval->clasificacion == "PRODUC") {
                    $Produc = 's';
                }
            }

            return view('Contenido.TemaMod', compact('Temas', 'Grado', 'NomAsig', 'NomCom', 'Titulo', 'Contenido', 'TitUnidad', 'ActIni', 'Produc', 'Animac', 'TipCont', 'DesaTema'));
        } else {
            return redirect("/");
        }
    }

    public function GuardarComent()
    {
        $idTema = request()->get('idTemaComent');
        $Coment = request()->get('Coment');
        $Comet = \App\ComentTemas::Guardar($idTema, $Coment);
//        dd($Temas);die;
        if (request()->ajax()) {
            return response()->json([
                'Comet' => $Comet,
            ]);
        }
    }

    public function ConusulComent()
    {
        $idTema = request()->get('Tema');
        $Comet = \App\ComentTemas::Consultar($idTema);
        if (request()->ajax()) {
            return response()->json([
                'Comet' => $Comet,
            ]);
        }
    }

    /////////////////CARGAR ACTIVIDADES Y PRODUCCIÓN

    public function VerActEval($id, $Clasif)
    {

        $IdGrad = Session::get('IDGRADO');
        $IdUsu = Session::get('IDUSU');

        if (Auth::check()) {

            $Eval = \App\Evaluacion::ListEvalxClasif($id, $Clasif, 'C');

            $Modulos = \App\Modulos::BuscarAsig($IdGrad);

            $Grado = $Modulos->grado_modulo;
            $Asig = \App\Asignaturas::InfAsig($Modulos->asignatura);
            $NomAsig = $Asig->nombre;
            if (Auth::user()->tipo_usuario == "Profesor") {
                $NomCom = Auth::user()->nombre_usuario;
            } else {
                $Estud = \App\Alumnos::Buscar($IdUsu);
                $Nombre = explode(' ', $Estud->nombre_alumno);
                $Apellido = explode(' ', $Estud->apellido_alumno);
                $NomCom = $Nombre[0] . " " . $Apellido[0];
            }

            $Temas = \App\Temas::BuscarTema($id);

            if ($Clasif == "ACTINI") {
                $Clasif = "ACTIVIDADES DE INICIO";
            } else {
                $Clasif = "PRODUCCIÓN";
            }

            return view('Contenido.Evaluaciones', compact('Temas', 'Grado', 'NomAsig', 'NomCom', 'Eval', 'Clasif'));
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function VerActEvalMod($id, $Clasif)
    {

        $IdGrad = Session::get('IDGRADO');
        $IdUsu = Session::get('IDUSU');

        if (Auth::check()) {

            $Eval = \App\Evaluacion::ListEvalxClasif($id, $Clasif, 'M');

            $Modulos = \App\GradosModulos::BuscarAsig($IdGrad);

            $Grado = $Modulos->grado_modulo;
            $Asig = \App\ModulosTransversales::InfAsig($Modulos->modulo);
            $NomAsig = $Asig->nombre;
            if (Auth::user()->tipo_usuario == "Profesor") {
                $NomCom = Auth::user()->nombre_usuario;
            } else {
                $Estud = \App\Alumnos::Buscar($IdUsu);
                $Nombre = explode(' ', $Estud->nombre_alumno);
                $Apellido = explode(' ', $Estud->apellido_alumno);
                $NomCom = $Nombre[0] . " " . $Apellido[0];
            }

            $Temas = \App\TemasModulos::BuscarTema($id);

            if ($Clasif == "ACTINI") {
                $Clasif = "ACTIVIDADES DE INICIO";
            } else {
                $Clasif = "PRODUCCIÓN";
            }
            return view('Contenido.EvaluacionesMod', compact('Temas', 'Grado', 'NomAsig', 'NomCom', 'Eval', 'Clasif'));
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    /////////////////CARGAR ANIMACIONES

    public function VerAnimaciones($id)
    {

        $IdGrad = Session::get('IDGRADO');
        $IdUsu = Session::get('IDUSU');

        if (Auth::check()) {

            $Anima = \App\DesarrollTemaDida::BuscarTema($id);

            $Modulos = \App\Modulos::BuscarAsig($IdGrad);

            $Grado = $Modulos->grado_modulo;
            $Asig = \App\Asignaturas::InfAsig($Modulos->asignatura);
            $NomAsig = $Asig->nombre;
            if (Auth::user()->tipo_usuario == "Profesor") {
                $NomCom = Auth::user()->nombre_usuario;
            } else {
                $Estud = \App\Alumnos::Buscar($IdUsu);
                $Nombre = explode(' ', $Estud->nombre_alumno);
                $Apellido = explode(' ', $Estud->apellido_alumno);
                $NomCom = $Nombre[0] . " " . $Apellido[0];
            }

            $Temas = \App\Temas::BuscarTema($id);

            return view('Contenido.Animaciones', compact('Temas', 'Grado', 'NomAsig', 'NomCom', 'Anima'));
        } else {
            return redirect("/");
        }
    }

    public function VerAnimacionesMod($id)
    {

        $IdGrad = Session::get('IDGRADO');
        $IdUsu = Session::get('IDUSU');
       
       
        if (Auth::check()) {

            $Anima = \App\DesarrollTemaDidaMod::BuscarTema($id);

            $Modulos = \App\GradosModulos::BuscarAsig($IdGrad);

            $Grado = $Modulos->grado_modulo;
            $Asig = \App\ModulosTransversales::InfAsig($Modulos->modulo);
            $NomAsig = $Asig->nombre;
            if (Auth::user()->tipo_usuario == "Profesor") {
                $NomCom = Auth::user()->nombre_usuario;
            } else {
                $Estud = \App\Alumnos::Buscar($IdUsu);
                $Nombre = explode(' ', $Estud->nombre_alumno);
                $Apellido = explode(' ', $Estud->apellido_alumno);
                $NomCom = $Nombre[0] . " " . $Apellido[0];
            }

            $Temas = \App\TemasModulos::BuscarTema($id);

            return view('Contenido.AnimacionesMod', compact('Temas', 'Grado', 'NomAsig', 'NomCom', 'Anima'));
        } else {
            return redirect("/");
        }
    }

////////////////////////////////CARGAR GRADOS
    public function GradosxAsignatura($Grad)
    {

        Session::put('IDGRADO', '');
        Session::put('IDTEMA', '');
        // Session::put('IDUSU', '');
        Session::put('IDASIG', $Grad);
        Session::put('TIPCONT', 'ASI');
        Session::put('SLIDER', 'NO');

        $Asignatura = \App\Modulos::ListModulos($Grad);
        $imgAsig = \App\ImgModulos::imgmodulo();

        $Modulos = \App\ModulosTransversales::AsigxUsu(Auth::user()->grado_usuario);
        $imgmodulo = \App\ImgGradosModulosTransv::imgmodulo();

        $Alumno = \App\Alumnos::Buscar(Session::get('IDUSU'));
        $ZonaLibre = \App\ZonaLibre::LisTemasEst($Alumno->grado_alumno, $Alumno->grupo, $Alumno->jornada);

        if (count($ZonaLibre) > 0) {
            Session::put('ZONALIBRE', 'SI');
        } else {
            Session::put('ZONALIBRE', 'NO');
        }

        return view('Contenido.Grados', compact('Asignatura', 'imgAsig', 'Modulos', 'imgmodulo'));

    }

    public function GradosxAsignaturaSinCont($Usu)
    {

        $Alumno = \App\Alumnos::Buscar($Usu);
        $respuesta = \App\Usuarios::login2($Usu);

        Session::put('IDGRADO', '');
        Session::put('IDTEMA', '');
        Session::put('IDUSU', $Usu);
        Session::put('IDASIG', $Alumno->grado_alumno);
        Session::put('NOMBREST', $respuesta->nombre_usuario);
        Session::put('TIPCONT', 'ASI');
        Session::put('SLIDER', 'NO');

        $Asignatura = \App\Modulos::ListModulos($Alumno->grado_alumno);
        $imgAsig = \App\ImgModulos::imgmodulo();

        $Modulos = \App\ModulosTransversales::AsigxUsu($Alumno->grado_alumno);
        $imgmodulo = \App\ImgGradosModulosTransv::imgmodulo();

        $ZonaLibre = \App\ZonaLibre::LisTemasEst($Alumno->grado_alumno, $Alumno->grupo, $Alumno->jornada);
        if (count($ZonaLibre) > 0) {
            Session::put('ZONALIBRE', 'SI');
        } else {
            Session::put('ZONALIBRE', 'NO');
        }

        return view('Contenido.Grados', compact('Asignatura', 'imgAsig', 'Modulos', 'imgmodulo'));

    }

    public function GradosxAsignaturaDoc($id)
    {

        Session::put('IDGRADO', '');
        Session::put('IDTEMA', '');
        Session::put('IDASIG', $id);
        Session::put('TIPCONT', 'ASI');

        $Modulos = \App\Modulos::ListModulosDoc($id);
        $imgmodulo = \App\ImgModulos::imgmodulo();

        return view('Contenido.Grados', compact('id', 'Modulos', 'imgmodulo'));

    }

    public function ZonaPlay($Alum)
    {
        if (Auth::check()) {
        $Alumno = \App\Alumnos::Buscar($Alum);
        $NAlumno = $Alumno->nombre_alumno ." ".$Alumno->apellido_alumno;
        $Gradoalumno = $Alumno->grado_alumno;
        Session::put('ZonaJuegoAct', 'SI');
        return view('ZonaPlay.Principal', compact( 'NAlumno', 'Gradoalumno'));
        }else{
            return redirect("/");

        }

    }

    public function ModuloE($Alum)
    {
        if (Auth::check()) {
        $Alumno = \App\Alumnos::Buscar($Alum);
        $NAlumno = $Alumno->nombre_alumno ." ".$Alumno->apellido_alumno;
        $Gradoalumno = $Alumno->grado_alumno;
        Session::put('moduloEAct', 'SI');
        return view('ModuloE.Principal', compact( 'NAlumno', 'Gradoalumno'));
        }else{
            return redirect("/");

        }

    }

////////////////////////////////CARGAR GRADOS MÓDULOS
    public function GradosxModulos($id)
    {
        Session::put('IDGRADO', '');
        Session::put('IDTEMA', '');
        Session::put('IDASIG', $id);
        Session::put('TIPCONT', 'MOD');

        $Modulos = \App\GradosModulos::ListModulos($id);
        $imgmodulo = \App\ImgGradosModulosTransv::imgmodulo();

        return view('Contenido.GradosModulos', compact('id', 'Modulos', 'imgmodulo'));

    }

    public function GradosxModulosDoc($id)
    {
        Session::put('IDGRADO', '');
        Session::put('IDTEMA', '');
        Session::put('IDASIG', $id);
        Session::put('TIPCONT', 'MOD');

        $Modulos = \App\GradosModulos::ListModulosDoc($id);

        $imgmodulo = \App\ImgGradosModulosTransv::imgmodulo();

        return view('Contenido.GradosModulos', compact('id', 'Modulos', 'imgmodulo'));

    }

////////////////////////////////CARGAR GRADOS DOCENTE
    public function VerAsigxDoce()
    {

        Session::put('IDGRADO', '');
        Session::put('IDTEMA', '');
        Session::put('IDUSU', '1');
        Session::put('IDASIG', '1');

        if (Auth::check()) {
            Session::put('NOMBREST', Auth::user()->nombre_usuario);
            $Asignatura = \App\AsigProf::ListModulos();
            $imgAsig = \App\ImgAsignatura::imgAsig();
            $Modulos = \App\ModulosTransversales::AsigxDoc();
            $imgmodulo = \App\ImgModulosTransversales::imgAsig();

            return view('Usuario.AsigDocences', compact('Asignatura', 'imgAsig', 'Modulos', 'imgmodulo'));
        } else {
            return redirect("/");
        }
    }

////////////////////////////////CARGAR ESTUDIANTES
    public function GradosxEstud($Grad)
    {
        Session::put('GRADO', $Grad);
        $ParGrupos = \App\Modulos::listarGrupos($Grad);
        $IdGrupo = $ParGrupos->first();
        $Grup = $IdGrupo->grupo;
        Session::put('GRUPO', $Grup);
        Session::put('IDGRUPO', $IdGrupo->id);
        Session::put('SLIDER', 'NO');

        $Estud = \App\Alumnos::AlumnosxGrado($Grad, $Grup);

        return view('Contenido.Estudiantes', compact('Grad', 'Estud', 'ParGrupos', 'Grup'));
    }

    public function GradosxEstudMod($id)
    {
        Session::put('IDGRADO', $id);
        $Modulos = \App\GradosModulos::BuscarAsig($id);
        $ParGrupos = \App\GruposTransversales::listarGrupos($id);
        $Asig = \App\ModulosTransversales::InfAsig($Modulos->modulo);

        $IdGrupo = $ParGrupos->first();
        $Grup = $IdGrupo->grupo;
        Session::put('IDGRUPO', $Grup);

        $Estud = \App\Alumnos::AlumnosxGrado($Modulos->grado_modulo, $Grup);

        return view('Contenido.EstudiantesMod', compact('id', 'Modulos', 'Estud', 'Asig', 'ParGrupos', 'Grup'));
    }

    public function GradosxEstud2($Grad, $Grup)
    {
        $ParGrupos = \App\Modulos::listarGrupos($Grad);
        $Estud = \App\Alumnos::AlumnosxGrado($Grad, $Grup);
        return view('Contenido.Estudiantes', compact('Grad', 'Estud', 'ParGrupos', 'Grup'));
    }

    public function GradosxEstudMod2($id, $Grup)
    {

        Session::put('IDGRADO', $id);

        $Modulos = \App\GradosModulos::BuscarAsig($id);
        $ParGrupos = \App\GruposTransversales::listarGrupos($id);
        $Asig = \App\ModulosTransversales::InfAsig($Modulos->asignatura);
        $Estud = \App\Alumnos::AlumnosxGrado($Modulos->grado_modulo, $Grup);
        return view('Contenido.EstudiantesMod', compact('id', 'Modulos', 'Estud', 'Asig', 'ParGrupos', 'Grup'));
    }

////////////////////////////////CARGAR ESTUDIANTES
    public function PresentacionCont($id, $Est)
    {

        Session::put('IDGRADO', $id);
        Session::put('IDTEMA', '');
        Session::put('PROFASIG', "NO");
        Session::put('TIPCONT', "ASI");
        Session::put('SLIDER', 'NO');

        if (Auth::user() == null) {
            $respuesta = \App\Usuarios::login2((int) $Est);

        }

        $Modulos = \App\Modulos::BuscarAsig($id);
        Session::put('IDASIG', $Modulos->grado_modulo);
        $Asig = \App\Asignaturas::InfAsig($Modulos->asignatura);

        if (Auth::user()->tipo_usuario == "Profesor") {
            $NomCom = Auth::user()->nombre_usuario;
        } else {

            $Estud = \App\Alumnos::Buscar($Est);
            $Nombre = explode(' ', $Estud->nombre_alumno);
            $Apellido = explode(' ', $Estud->apellido_alumno);
            $NomCom = $Nombre[0] . " " . $Apellido[0];
            $DatGrup = \App\Grupos::BuscGrup($Estud->grupo);


            if( $DatGrup){
                Session::put('GRUPO', $DatGrup->id);
                Session::put('JORNADA', $Estud->jornada);
                Session::put('IDUSU', $Est);
            }else{
                return redirect('Contenido/GradosxAsignaturaSinCont/'.$Est)->with('error', 'No existe un grupo creado para este Grado, asegurese de crear los grupos para cada Grado de Asignatura');

            }           

            $DatDoce = \App\AsigProf::BuscDat2($id);

            if ($DatDoce) {
                Session::put('PROFASIG', "SI");
                Session::put('DOCENTE', $DatDoce->id);
                Session::put('USUDOCENTE', $DatDoce->usuario_profesor);
            }else{
                return redirect('Contenido/GradosxAsignaturaSinCont/'.$Est)->with('error', 'No se ha Asignado un Docente a esta Asignatura');

            }
        }

        $Periodo = \App\Periodos::periodo($id);
        $Unidad = \App\Unidades::unidad($id);

        $Temas = \App\Temas::LisTemas($id);

        $Laboratorios = \App\Laboratorios::LisLab($id);
        Session::put('NLABO', $Laboratorios->nlab);

        Session::put('NOMBREST', $NomCom);
        return view('Contenido.Presentacion', compact('Modulos', 'Asig', 'NomCom', 'Periodo', 'Unidad', 'Temas'));
//        } else {
        //            return redirect("/");
        //        }
    }

    ////////////////////////////////CARGAR ESTUDIANTES
    public function PresentacionContMod($id, $Est)
    {

        Session::put('IDGRADO', $id);
        Session::put('IDTEMA', '');
        Session::put('PROFASIG', "NO");
        Session::put('TIPCONT', "MOD");
        Session::put('SLIDER', 'NO');

        if (Auth::user() == null) {
            $respuesta = \App\Usuarios::login2((int) $Est);
        }

        $Modulos = \App\GradosModulos::BuscarAsig($id);
        Session::put('IDASIG', $Modulos->grado_modulo);
        $Asig = \App\ModulosTransversales::InfAsig($Modulos->modulo);

        if (Auth::user()->tipo_usuario == "Profesor") {
            $NomCom = Auth::user()->nombre_usuario;
        } else {

            $Estud = \App\Alumnos::Buscar($Est);
            $Nombre = explode(' ', $Estud->nombre_alumno);
            $Apellido = explode(' ', $Estud->apellido_alumno);
            $NomCom = $Nombre[0] . " " . $Apellido[0];

            $DatGrup = \App\GruposTransversales::BuscGrup($Estud->grupo);

              if( $DatGrup){
                Session::put('GRUPO', $DatGrup->id);
                Session::put('JORNADA', $Estud->jornada);
                Session::put('IDUSU', $Est);
            }else{
                return redirect('Contenido/GradosxAsignaturaSinCont/'.$Est)->with('error', 'No existe un grupo creado para este Grado, asegurese de crear los grupos para cada Grado de Módulo');

            }

            $DatDoce = \App\ModProf::BuscDat($id);
            if ($DatDoce) {
                Session::put('PROFASIG', "SI");
                Session::put('DOCENTE', $DatDoce->id);
                Session::put('USUDOCENTE', $DatDoce->usuario_profesor);
            }else{
                return redirect('Contenido/GradosxAsignaturaSinCont/'.$Est)->with('error', 'No se ha Asignado un Docente a este Módulo');

            }
        }

        $Periodo = \App\PeriodosModTransv::periodo($id);
        $Unidad = \App\UnidadesModulos::unidad($id);
        $Temas = \App\TemasModulos::LisTemas($id);

        Session::put('NOMBREST', $NomCom);
        return view('Contenido.PresentacionMod', compact('Modulos', 'Asig', 'NomCom', 'Periodo', 'Unidad', 'Temas'));
//        } else {
        //            return redirect("/");
        //        }
    }

    public function Laboratorios($id)
    {

        if (Auth::check()) {
            $DesLabo = \App\Laboratorios::ListLabUnidad($id);
            return view('Contenido.Laboratorios', compact('DesLabo'));

        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }

    }

    public function Calificaciones($id, $Est)
    {

        Session::put('IDGRADO', $id);
        Session::put('IDTEMA', '');
        Session::put('IDUSU', $Est);

        if (Auth::user() == null) {
            $respuesta = \App\Usuarios::login2((int) $Est);
        }

        $Modulos = \App\Modulos::BuscarAsig($id);
        $Asig = \App\Asignaturas::InfAsig($Modulos->asignatura);

        if (Auth::user()->tipo_usuario == "Profesor") {
            $NomCom = Auth::user()->nombre_usuario;
        } else {
            $Estud = \App\Alumnos::Buscar($Est);
            $Nombre = explode(' ', $Estud->nombre_alumno);
            $Apellido = explode(' ', $Estud->apellido_alumno);
            $NomCom = $Nombre[0] . " " . $Apellido[0];
            $Alumno = \App\LibroCalificaciones::BuscarEvalxAlumn($id, 'C');
          
            // dd($Alumno);die;
        }

        Session::put('NOMBREST', $NomCom);
        return view('Contenido.Calificaciones', compact('Modulos', 'Asig', 'NomCom', 'Alumno'));
    }

    public function CalificacionesMod($id, $Est)
    {

        Session::put('IDGRADO', $id);
        Session::put('IDTEMA', '');
        Session::put('IDUSU', $Est);

        if (Auth::user() == null) {
            $respuesta = \App\Usuarios::login2((int) $Est);
        }

        $Modulos = \App\GradosModulos::BuscarAsig($id);
        $Asig = \App\ModulosTransversales::InfAsig($Modulos->modulo);

        if (Auth::user()->tipo_usuario == "Profesor") {
            $NomCom = Auth::user()->nombre_usuario;
        } else {
            $Estud = \App\Alumnos::Buscar($Est);
            $Nombre = explode(' ', $Estud->nombre_alumno);
            $Apellido = explode(' ', $Estud->apellido_alumno);
            $NomCom = $Nombre[0] . " " . $Apellido[0];
            $Alumno = \App\LibroCalificaciones::BuscarEvalxAlumn($id, 'M');
        }

        Session::put('NOMBREST', $NomCom);
        return view('Contenido.Calificaciones', compact('Modulos', 'Asig', 'NomCom', 'Alumno'));
    }

    public function ZonaLibre($Est)
    {
        Session::put('SLIDER', 'NO');
        if (Auth::check()) {
            $SelGrupos = "";
            $DatDoce = "";
            $Comentarios = "";
            if (Auth::user()->tipo_usuario == "Estudiante") {
                $Alumno = \App\Alumnos::Buscar($Est);

                $Temas = \App\ZonaLibre::LisTemasEst($Alumno->grado_alumno, $Alumno->grupo, $Alumno->jornada);

                if (count($Temas) > 0) {
                    $DetTema = $Temas->last();
                    $Comentarios = \App\DesarroComentario::LisComentarioEst($Alumno->grado_alumno, $Alumno->grupo, $Alumno->jornada);

                    $DatDoce = \App\Profesores::Buscar($DetTema->docente);

                }
            } else {

                $grado = request()->get('idgrado');
                $grupo = request()->get('idgrupo');
                $jorna = request()->get('idjorna');
                $Temas = \App\ZonaLibre::LisTemas(Auth::user()->id, $grado, $grupo, $jorna);

                $Comentarios = \App\DesarroComentario::LisComentario();
                $DatDoce = \App\Profesores::Buscar(Auth::user()->id);
                $Cole = \App\Colegios::InfColeg();

                $ParGrupos = \App\ParGrupos::LisGrupos($Cole->num_cursos, $Cole->cant_grupos);

                foreach ($ParGrupos as $Grup) {
                    $SelGrupos .= "<option value='$Grup->id' >" . strtoupper($Grup->descripcion) . "</option>";
                }
            }

            Session::put('CURSO', $Est);

            $TamTem = 0;
            $TamArc = 0;
            $TamVid = 0;
            $TamLin = 0;
            $TamCom = 0;

            foreach ($Temas as $Tem) {
                if ($Tem->tip_contenido == "DOCUMENTO") {
                    $TamTem++;
                }
                if ($Tem->tip_contenido == "VIDEOS") {
                    $TamVid++;
                }
                if ($Tem->tip_contenido == "ARCHIVO") {
                    $TamArc++;
                }
                if ($Tem->tip_contenido == "LINK") {
                    $TamLin++;
                }
                if ($Tem->tip_contenido == "COMENTARIO") {
                    $TamCom++;
                }
            }

            $Sesiones = \App\sesiones::Guardar(Auth::user()->id);

            return view('Contenido.Zonalibre', compact('Temas', 'DatDoce', 'Comentarios', 'TamTem', 'TamVid', 'TamArc', 'TamLin', 'TamCom', 'SelGrupos'));
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function CambiarContenidoModaZonaLibre()
    {
        if (Auth::check()) {
            $idTema = request()->get('id_tema');
            $DesaTema = \App\DesarrollTema::Destemas($idTema, 'SI');

            $Sesiones = \App\sesiones::Guardar(Auth::user()->id);
            if (request()->ajax()) {
                return response()->json([
                    'DesaTema' => $DesaTema,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function CambiarArchModalZona()
    {
        if (Auth::check()) {
            $idTema = request()->get('id_tema');
            $DesArch = \App\SubirArcTema::DesArch($idTema, 'SI');
            $Sesiones = \App\sesiones::Guardar(Auth::user()->id);
            if (request()->ajax()) {
                return response()->json([
                    'DesArch' => $DesArch,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

////////////////////////////////CARGAR ASIGNATURAS
    public function Asignaturas($id, $Est)
    {
        Session::put('PROFASIG', "NO");
        $Modulos = \App\Modulos::BuscarAsig($id);
        $Grado = $Modulos->grado_modulo;
        $Asignaturas = \App\Asignaturas::AsigxUsu($Grado);

        $imgmodulo = \App\ImgModulos::imgmodulo();
        $Estud = \App\Alumnos::Buscar($Est);
        $Nombre = explode(' ', $Estud->nombre_alumno);
        $Apellido = explode(' ', $Estud->apellido_alumno);
        $NomCom = $Nombre[0] . " " . $Apellido[0];
        Session::put('NOMBREST', $NomCom);
        $DatDoce = \App\AsigProf::BuscDat($id);
        if ($DatDoce) {
            Session::put('PROFASIG', "SI");
        }

        return view('Contenido.Asignaturas', compact('Asignaturas', 'imgmodulo', 'Grado', 'NomCom', 'Modulos', 'Est'));
    }

    public function Modulos($id, $Est)
    {
        Session::put('PROFASIG', "NO");
        $Modulos = \App\GradosModulos::BuscarAsig($id);
        $Grado = $Modulos->grado_modulo;
        $Asignaturas = \App\ModulosTransversales::AsigxUsu($Grado);

        $imgmodulo = \App\ImgGradosModulosTransv::imgmodulo();
        $Estud = \App\Alumnos::Buscar($Est);
        $Nombre = explode(' ', $Estud->nombre_alumno);
        $Apellido = explode(' ', $Estud->apellido_alumno);
        $NomCom = $Nombre[0] . " " . $Apellido[0];
        Session::put('NOMBREST', $NomCom);
        $DatDoce = \App\ModProf::BuscDat($id);
        if ($DatDoce) {
            Session::put('PROFASIG', "SI");
        }

        return view('Contenido.ModulosTransversales', compact('Asignaturas', 'imgmodulo', 'Grado', 'NomCom', 'Modulos', 'Est'));
    }

    public function CambiarPresentacion()
    {
        $idmod = request()->get('id');
        $presentacion = \App\Modulos::BuscarAsig($idmod);
        if (request()->ajax()) {
            return response()->json([
                'presentacion' => $presentacion,
            ]);
        }
    }

    public function CambiarGrupo()
    {
        $idgrupo = request()->get('idGrupo');
        Session::put('GrupAct', $idgrupo);
        if (request()->ajax()) {
            return response()->json([
                'Resp' => "ok",
            ]);
        }
    }

    public function CambiarArchModal()
    {

        $idTema = request()->get('id_tema');
        $DesArch = \App\SubirArcTema::DesArch($idTema, 'SI');

        if (request()->ajax()) {
            return response()->json([
                'DesArch' => $DesArch,
            ]);
        }
    }

    public function CambiarAnimZonaLibre()
    {
        if (Auth::check()) {
            $IdTema = request()->get('TemaAni');
            $Temas = \App\ZonaLibre::BuscarTema($IdTema);

            if ($Temas->tip_video == "LINK") {
                $DesAnimaciones = \App\DesarrolloLink::DesLink($IdTema, 'SI');
            } else {
                $DesAnimaciones = \App\ContDidactico::BuscarTema($IdTema, 'SI');
            }

            $Sesiones = \App\sesiones::Guardar(Auth::user()->id);
            if (request()->ajax()) {
                return response()->json([
                    'DesAnim' => $DesAnimaciones,
                    'TitTema' => $Temas->titu_contenido,
                    'tip_video' => $Temas->tip_video,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function CambiarLinkZonaLibre()
    {
        if (Auth::check()) {
            $IdTema = request()->get('TemaAni');
            $Temas = \App\ZonaLibre::BuscarTema($IdTema);

            $DesLink = \App\DesarrolloLink::DesLink($IdTema, 'SI');

            $Sesiones = \App\sesiones::Guardar(Auth::user()->id);
            if (request()->ajax()) {
                return response()->json([
                    'DesLink' => $DesLink,
                    'TitTema' => $Temas->titu_contenido,
                    'tip_video' => $Temas->tip_video,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function CambiarEvalModal()
    {
        if (Auth::check()) {
            $idTema = request()->get('id');
            $DesEva = \App\Evaluacion::DesEval($idTema);

            $DatEva = \App\Evaluacion::DatosEvla($DesEva->id, 'INFALUM');
            $Sesiones = \App\sesiones::Guardar(Auth::user()->id);

            if ($DatEva == null) {
                $intreal = 0;
            } else {
                $intreal = $DatEva->int_realizados;
            }

            $titulo = $DesEva->titulo;
            $tipeval = $DesEva->tip_evaluacion;
            $id_eval = $DesEva->id;
            $intentos_perm = $DesEva->intentos_perm;
            $punt_max = $DesEva->punt_max;
            $calif_usando = $DesEva->calif_usando;
            $enunciado = $DesEva->enunciado;

            $conversa = $DesEva->hab_conversacion;
            $tiempo = $DesEva->tiempo;
            $hab_tiempo = $DesEva->hab_tiempo;
            $intentos_real = $intreal;
            $perfil = Auth::user()->tipo_usuario;

            $ideva = $DesEva->id;

            $Log = \App\Log::Guardar('Visualizacion de Evaluación', $ideva);

            $PregEval = \App\CosEval::GrupPreg($ideva);

            /////CONSULTAR VIDEO
            $VideoEval = \App\EvalPregDidact::PregDida($ideva);
            $video = "no";
            $id = "no";
            if ($VideoEval) {
                $video = $VideoEval->cont_didactico;
                $id = $VideoEval->id;
            }

            if (request()->ajax()) {
                return response()->json([
                    'titulo' => $titulo,
                    'int_perm' => $intentos_perm,
                    'int_realizados' => $intentos_real,
                    'enunciado' => $enunciado,
                    'conversa' => $conversa,
                    'tiempo' => $tiempo,
                    'hab_tiempo' => $hab_tiempo,
                    'perfil' => $perfil,
                    'Evaluacion' => $DesEva,
                    'PregEval' => $PregEval->shuffle(),
                    'VideoEval' => $video,
                    'idvideo' => $id,

                ]);
            }

        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function consulPregAlumno()
    {
        if (Auth::check()) {
            $IdPreg = request()->get('Pregunta');
            $TipPreg = request()->get('TipPregunta');

            if ($TipPreg == "PREGENSAY") {
                $PregEnsayo = \App\EvalPregEnsay::consulPregEnsay($IdPreg);
                $RespPregEnsayo = \App\RespEvalEnsay::DesResp($IdPreg, Auth::user()->id);
                if (request()->ajax()) {
                    return response()->json([
                        'PregEnsayo' => $PregEnsayo,
                        'RespPregEnsayo' => $RespPregEnsayo,
                    ]);
                }
            } else if ($TipPreg == "COMPLETE") {
                $PregComple = \App\EvalPregComplete::ConsultComplete($IdPreg);
                $RespPregComple = \App\RespEvalComp::DesResp($IdPreg, Auth::user()->id);
                if (request()->ajax()) {
                    return response()->json([
                        'PregComple' => $PregComple,
                        'RespPregComple' => $RespPregComple,
                    ]);
                }
            } else if ($TipPreg == "OPCMULT") {
                $PregMult = \App\PregOpcMul::ConsulPreg($IdPreg);
                $OpciMult = \App\OpcPregMul::ConsulGrupOpcPreg($IdPreg);
                $RespPregMul = \App\OpcPregMul::BuscOpcResp($IdPreg, Auth::user()->id);

                if (request()->ajax()) {
                    return response()->json([
                        'PregMult' => $PregMult,
                        'OpciMult' => $OpciMult,
                        'RespPregMul' => $RespPregMul,
                    ]);
                }
            } else if ($TipPreg == "VERFAL") {
                $PregVerFal = \App\EvalVerFal::ConVerFal($IdPreg);
                $RespPregVerFal = \App\EvalVerFal::VerFalResp($IdPreg, Auth::user()->id);
                if (request()->ajax()) {
                    return response()->json([
                        'PregVerFal' => $PregVerFal,
                        'RespPregVerFal' => $RespPregVerFal,
                    ]);
                }
            } else if ($TipPreg == "RELACIONE") {
                $PregRelacione = \App\PregRelacione::ConRela($IdPreg);
                $PregRelIndi = \App\EvalRelacione::PregRelDef($IdPreg);
                $PregRelResp = \App\EvalRelacioneOpc::PregRelOpc($IdPreg);
                $PregRelRespAdd = \App\EvalRelacioneOpc::PregRelOpcAdd($IdPreg);

                $RespPregRelacione = \App\RespEvalRelacione::RelacResp($IdPreg, Auth::user()->id);

                if (request()->ajax()) {
                    return response()->json([
                        'PregRelacione' => $PregRelacione,
                        'PregRelIndi' => $PregRelIndi,
                        'PregRelResp' => $PregRelResp,
                        'PregRelRespAdd' => $PregRelRespAdd,
                        'RespPregRelacione' => $RespPregRelacione,

                    ]);
                }
            } else if ($TipPreg == "TALLER") {
                $PregTaller = \App\EvalTaller::PregTaller($IdPreg);
                $RespPregTaller = \App\RespEvalTaller::RespEvalTallerAlum($IdPreg, Auth::user()->id);
                if (request()->ajax()) {
                    return response()->json([
                        'PregTaller' => $PregTaller,
                        'RespPregTaller' => $RespPregTaller,
                    ]);
                }
            }

        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }

    }

    public function GuardarRespEvaluaciones()
    {
        if (Auth::check()) {
            $datos = request()->all();

            $fecha = date('Y-m-d  H:i:s');

            if ($datos['TipPregunta'] == "PREGENSAY") {
                $InfPreg = \App\EvalPregEnsay::consulPregEnsay($datos['Pregunta']);
                $InfEval = \App\Evaluacion::DatosEvla($datos['IdEvaluacion'], 'IFEVAL');
                $Respuesta = \App\RespEvalEnsay::Guardar($InfPreg, $datos, $fecha);
                $InfEval['OriEva'] = "Estudiante";
                $Sesiones = \App\sesiones::Guardar(Auth::user()->id);

            } else if ($datos['TipPregunta'] == "COMPLETE") {

                $InfPreg = \App\EvalPregComplete::ConsultComplete($datos['Pregunta']);
                $InfEval = \App\Evaluacion::DatosEvla($datos['IdEvaluacion'], 'IFEVAL');
                $Respuesta = \App\RespEvalComp::Guardar($InfPreg, $datos, $fecha);
                $InfEval['OriEva'] = "Estudiante";
                $Sesiones = \App\sesiones::Guardar(Auth::user()->id);

            } else if ($datos['TipPregunta'] == "OPCMULT") {
                $Respuesta = \App\RespMultPreg::Guardar($datos, $fecha);
                $Sesiones = \App\sesiones::Guardar(Auth::user()->id);
                $InfEval = \App\Evaluacion::DatosEvla($datos['IdEvaluacion'], 'IFEVAL');

            } else if ($datos['TipPregunta'] == "VERFAL") {
                $Respuesta = \App\RespVerFal::Guardar($datos, $fecha);

                $Sesiones = \App\sesiones::Guardar(Auth::user()->id);
                $InfEval = \App\Evaluacion::DatosEvla($datos['IdEvaluacion'], 'IFEVAL');
                $InfEval['OriEva'] = "Estudiante";

            } else if ($datos['TipPregunta'] == "RELACIONE") {
                $Respuesta = \App\RespEvalRelacione::Guardar($datos, $fecha);
                $Sesiones = \App\sesiones::Guardar(Auth::user()->id);
                $InfEval = \App\Evaluacion::DatosEvla($datos['IdEvaluacion'], 'IFEVAL');
                $InfEval['OriEva'] = "Estudiante";

            } else if ($datos['TipPregunta'] == "TALLER") {

                if (request()->hasfile('archiTaller')) {
                    $prefijo = substr(md5(uniqid(rand())), 0, 6);
                    $name = self::sanear_string($prefijo . '_' . request()->file('archiTaller')->getClientOriginalName());
                    request()->file('archiTaller')->move(public_path() . '/app-assets/Archivos_EvalTaller_Resp/', $name);
                } else {
                    $name = $datos['NArchivo'];
                }

                $InfPreg = \App\EvalTaller::PregTaller($datos['Pregunta']);
                $Respuesta = \App\RespEvalTaller::Guardar($InfPreg, $name, $fecha);
                $Sesiones = \App\sesiones::Guardar(Auth::user()->id);
                $InfEval = \App\Evaluacion::DatosEvla($datos['IdEvaluacion'], 'IFEVAL');
                $InfEval['OriEva'] = "Estudiante";

            }

            if ($datos['nPregunta'] === "Ultima") {
                $LibroCalif = \App\LibroCalificaciones::Guardar($datos, $Respuesta['RegViejo'], $Respuesta['RegNuevo'], $InfEval, $fecha);
                $Intentos = \App\UpdIntEval::Guardar($datos['IdEvaluacion']);
                $InfEval = \App\Evaluacion::DatosEvla($datos['IdEvaluacion'], 'IFEVALFIN');

                $Log = \App\Log::Guardar('Evaluación Desarrollada', $datos['IdEvaluacion']);

                if ($Respuesta) {
                    if (request()->ajax()) {
                        return response()->json([
                            'Resp' => 'guardada',
                            'Libro' => $LibroCalif,
                            'InfEval' => $InfEval,
                        ]);
                    }
                }

            } else {
                $LibroCalif = \App\LibroCalificaciones::Guardar($datos, $Respuesta['RegViejo'], $Respuesta['RegNuevo'], $InfEval, $fecha);

                if ($Respuesta) {
                    if (request()->ajax()) {
                        return response()->json([
                            'Resp' => 'guardada',
                        ]);
                    }
                }
            }

        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function vistoContenido()
    {
        $id = request()->get('id');
        $estado = request()->get('estado');
        // dd(request()->all());die;
        // dd($estado);die;
        $cambio = \App\Temas::cambiarvisto($id, $estado);
        if ($cambio) {
            $mensaje = "SI";
        } else {
            $mensaje = "NO";
        }
        if (request()->ajax()) {
            return response()->json([
                'estado' => $estado,
            ]);
        }
    }

    public function MostLaboratorios()
    {
        if (Auth::check()) {
            $idunidad = request()->get('id');
            $TitUnidad = \App\Unidades::TitUnidades($idunidad);
            $Laboratorios = \App\Laboratorios::ListLaboTemas($idunidad);
            $Sesiones = \App\sesiones::Guardar(Auth::user()->id);

            if (request()->ajax()) {
                return response()->json([
                    'TitUnidad' => $TitUnidad,
                    'Laboratorios' => $Laboratorios,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function MostDetLaboratorios()
    {
        if (Auth::check()) {
            $idLab = request()->get('idLabo');
            $Laboratorios = \App\Laboratorios::BuscarLab($idLab);
            $ProcLabo = \App\ProcedLaboratorios::BuscarProc($idLab);
            $EvalLabo = \App\Evaluacion::ListEval($idLab, 'L');
            $Sesiones = \App\sesiones::Guardar(Auth::user()->id);

            if (request()->ajax()) {
                return response()->json([
                    'Laboratorios' => $Laboratorios,
                    'ProcLabo' => $ProcLabo,
                    'EvalLabo' => $EvalLabo,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function ConsulRetroalimentacion()
    {
        if (Auth::check()) {

            $Eva = request()->get('idEvalRetro');

            $Retroalimentacion = \App\PuntPreg::ConsulRetro($Eva);

            foreach ($Retroalimentacion as $Retro) {

                if ($Retro->tipo == "PREGENSAY") {

                    $PuntMax = \App\EvalPregEnsay::consulPregEnsay($Retro->pregunta);

                    $puntmax = $PuntMax->puntaje;

                    $promPunt = ($Retro->puntos / $puntmax) * 100;

                    $Retro->promPunt = $promPunt;

                } else if ($Retro->tipo == "COMPLETE") {
                    $PuntMax = \App\EvalPregComplete::ConsultComplete($Retro->pregunta);
                    $puntmax = $PuntMax->puntaje;
                    $promPunt = ($Retro->puntos / $puntmax) * 100;
                    $Retro->promPunt = $promPunt;

                } else if ($Retro->tipo == "TALLER") {
                    $PuntMax = \App\EvalTaller::PregTaller($Retro->pregunta);

                    $puntmax = $PuntMax->puntaje;
                    $promPunt = ($Retro->puntos / $puntmax) * 100;
                    $Retro->promPunt = $promPunt;
                } else {
                    if ($Retro->puntos > 0) {
                        $Retro->promPunt = 100;
                    } else {
                        $Retro->promPunt = 0;
                    }

                }

            }

            if (request()->ajax()) {
                return response()->json([
                    'Retro' => $Retroalimentacion,
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function VerRespAlumno()
    {
        if (Auth::check()) {

            $IdPreg = request()->get('PreguntaResp');
            $Eval = request()->get('idEvaVerResp');
            $Pregunta = \App\CosEval::ConsulPreg($IdPreg, $Eval);

            if ($Pregunta->tipo == "PREGENSAY") {
                $PregEnsayo = \App\EvalPregEnsay::consulPregEnsay($IdPreg);
                $RespPregEnsayo = \App\RespEvalEnsay::DesResp($IdPreg, Auth::user()->id);
                if (request()->ajax()) {
                    return response()->json([
                        'PregEnsayo' => $PregEnsayo,
                        'RespPregEnsayo' => $RespPregEnsayo,
                        'tipo' => $Pregunta->tipo,
                        'retro' => $Pregunta->retro,

                    ]);
                }
            } else if ($Pregunta->tipo == "COMPLETE") {
                $PregComple = \App\EvalPregComplete::ConsultComplete($IdPreg);
                $RespPregComple = \App\RespEvalComp::DesResp($IdPreg, Auth::user()->id);

                if (request()->ajax()) {
                    return response()->json([
                        'PregComple' => $PregComple,
                        'RespPregComple' => $RespPregComple,
                        'tipo' => $Pregunta->tipo,
                        'retro' => $Pregunta->retro,

                    ]);
                }

            } else if ($Pregunta->tipo == "OPCMULT") {
                $PregMult = \App\PregOpcMul::ConsulPreg($IdPreg);
                $OpciMult = \App\OpcPregMul::ConsulGrupOpcPreg($IdPreg);
                $RespPregMul = \App\OpcPregMul::BuscOpcResp($IdPreg, Auth::user()->id);

                if (request()->ajax()) {
                    return response()->json([
                        'PregMult' => $PregMult,
                        'OpciMult' => $OpciMult,
                        'RespPregMul' => $RespPregMul,
                        'tipo' => $Pregunta->tipo,
                        'retro' => $Pregunta->retro,

                    ]);
                }

            } else if ($Pregunta->tipo == "VERFAL") {
                $PregVerFal = \App\EvalVerFal::ConVerFal($IdPreg);
                $RespPregVerFal = \App\EvalVerFal::VerFalResp($IdPreg, Auth::user()->id);

                if (request()->ajax()) {
                    return response()->json([
                        'PregVerFal' => $PregVerFal,
                        'RespPregVerFal' => $RespPregVerFal,
                        'tipo' => $Pregunta->tipo,
                        'retro' => $Pregunta->retro,

                    ]);
                }

            } else if ($Pregunta->tipo == "RELACIONE") {
                $PregRelacione = \App\PregRelacione::ConRela($IdPreg);
                $PregRelIndi = \App\EvalRelacione::PregRelDef($IdPreg);
                $RespPregRelacione = \App\RespEvalRelacione::RelacRespEtt($IdPreg, Auth::user()->id);

                if (request()->ajax()) {
                    return response()->json([
                        'PregRelacione' => $PregRelacione,
                        'PregRelIndi' => $PregRelIndi,
                        'RespPregRelacione' => $RespPregRelacione,
                        'tipo' => $Pregunta->tipo,
                        'retro' => $Pregunta->retro,

                    ]);
                }

            } else if ($Pregunta->tipo == "TALLER") {
                $PregTaller = \App\EvalTaller::PregTaller($IdPreg);
                $RespPregTaller = \App\RespEvalTaller::RespEvalTallerAlum($IdPreg, Auth::user()->id);
                if (request()->ajax()) {
                    return response()->json([
                        'PregTaller' => $PregTaller,
                        'RespPregTaller' => $RespPregTaller,
                        'tipo' => $Pregunta->tipo,
                        'retro' => $Pregunta->retro,

                    ]);
                }

            }

        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function sanear_string($string)
    {

        $string = trim($string);

        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $string
        );

        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $string
        );

        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $string
        );

        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $string
        );

        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $string
        );

        $string = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'), array('n', 'N', 'c', 'C'), $string
        );

        //Esta parte se encarga de eliminar cualquier caracter extraño
        $string = str_replace(
            array("¨", "º", "-", "~", "", "@", "|", "!",
                "·", "$", "%", "&", "/",
                "(", ")", "?", "'", " h¡",
                "¿", "[", "^", "<code>", "]",
                "+", "}", "{", "¨", "´",
                ">", "< ", ";", ",", ":",
                " "), '', $string
        );

        return $string;
    }

}
