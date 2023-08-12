<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller {

    public function Inicio() {
        $Asignatura = \App\Asignaturas::listar();
        Session::put('IDGRADO', '');
        Session::put('IDUSU', '');
        Session::put('IDASIG', '');
        Session::put('IDTEMA', '');
        Session::put('TIPCONT', '');
        Session::put('SLIDER', '');
        Session::put('ZonaJuegoAct', 'NO');

        $imgmodulo = \App\ImgAsignatura::imgAsig();
        /////CARGAR NODULOS
        $Modulos = \App\ModulosTransversales::ModulosTransv();
        $imgmoduloTransv = \App\ImgModulosTransversales::imgAsig();

        $Permiso = \App\ConsUrl::ConsulPar('PED-KID');
       

        $colegios = \App\Colegios::InfColeg($Permiso->colegio);
        Session::put('PASW', $colegios->habpasw);
   
        Session::put('PerModE', $Permiso->mod_entre);
        Session::put('PerLabo', $Permiso->mod_labo);
        Session::put('PerZonL', $Permiso->mod_zona);
        Session::put('PerModJ', $Permiso->mod_juego);
        Session::put('PerAsig', $Permiso->mod_asig);
        Session::put('PerModu', $Permiso->mod_modu);

        $UrlReal = \App\ConsUrl::ConsulUrl("PED");
        Session::put('URL', $UrlReal->url);
        Session::put('URLPet', $UrlReal->urlpeticiones);
    

        return view('Usuario.Login', compact('Asignatura', 'imgmodulo','Modulos','imgmoduloTransv'));
    }

    public function Entrar() {

        $respuesta = \App\Usuarios::login(request()->all());
       
        if ($respuesta) {
            $Alumno = \App\Alumnos::Buscar($respuesta->id);
            Session::put('JORNADA', $Alumno->jornada);
            Session::put('IDUSU', $respuesta->id);
            Session::put('NOMBREST', $respuesta->nombre_usuario);
            $Mesnaje = "si";
        } else {
            $Mesnaje = "no";
        }
        if (request()->ajax()) {
            return response()->json([
                        'Mensaje' => $Mesnaje
            ]);
        }
    }

    public function EntrarDocente() {

        $respuesta = \App\Usuarios::loginDocente(request()->all());
     

        if ($respuesta) {
            $Mesnaje = "si";
        } else {
            $Mesnaje = "no";
        }
        if (request()->ajax()) {
            return response()->json([
                        'Mensaje' => $Mesnaje
            ]);
        }
        
        
    }

    public function LoginDocente() {
        Session::put('IDGRADO', 'Login');
        return view('Usuario.LoginDocente');
    }

    public function logout() {
        Auth::logout();
        Session::flush();
        return redirect('/')->with('success', 'Sesión Finalizada');
    }

}
