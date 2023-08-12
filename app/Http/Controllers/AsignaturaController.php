<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsignaturaController extends Controller {

    public function GestionGrado() {
        $bandera = "Menu4";
        if (Auth::check()) {
            $busqueda = request()->get('txtbusqueda');
            $nombre = request()->get('nombre');
            $actual = request()->get('page');
            if ($actual == null || $actual == "") {
                $actual = 1;
            }
            $limit = 5;
            $Asignatura = \App\Modulos::Gestion($busqueda, $actual, $limit, $nombre);
            $numero_filas = \App\Modulos::numero_de_registros(request()->get('txtbusqueda'), $nombre);
            $ListAsig = \App\Asignaturas::listar();

            $select_Asig = "<option value='' selected>TODAS LAS ASIGNATURAS</option>";
            foreach ($ListAsig as $Asig) {
                if ($Asig->id == $nombre) {
                    $select_Asig .= "<option value='$Asig->id' selected> " . strtoupper($Asig->nombre) . "</option>";
                } else {
                    $select_Asig .= "<option value='$Asig->id' >" . strtoupper($Asig->nombre) . "</option>";
                }
            }
            $paginas = ceil($numero_filas / $limit); //$numero_filas/10;
            return view('Asignaturas.GestionAsig', compact('bandera', 'numero_filas', 'paginas', 'actual', 'limit', 'busqueda', 'Asignatura', 'select_Asig'));
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function GestionUnidades() {
        $bandera = "Menu4";
        if (Auth::check()) {
            $busqueda = request()->get('txtbusqueda');
            $nombre = request()->get('nombre');
            $actual = request()->get('page');
            if ($actual == null || $actual == "") {
                $actual = 1;
            }
            $limit = 5;
            $Unidades = \App\Unidades::Gestion($busqueda, $actual, $limit, $nombre);
            $numero_filas = \App\Unidades::numero_de_registros(request()->get('txtbusqueda'), $nombre);
            $paginas = ceil($numero_filas / $limit); //$numero_filas/10;
            $Asignaturas = \App\Asignaturas::listar();

            $select_Asig = "<option value='' selected>TODAS LAS ASIGNATURAS</option>";
            foreach ($Asignaturas as $Asig) {
                if ($Asig->id == $nombre) {
                    $select_Asig .= "<option value='$Asig->id' selected> " . strtoupper($Asig->nombre) . "</option>";
                } else {
                    $select_Asig .= "<option value='$Asig->id' >" . strtoupper($Asig->nombre) . "</option>";
                }
            }


            return view('Asignaturas.GestionUnidad', compact('bandera', 'numero_filas', 'paginas', 'actual', 'limit', 'busqueda', 'Unidades', 'select_Asig'));
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function GestionAsigEvaluacion($id) {
        $bandera = "Menu4";
        if (Auth::check()) {
            $Evaluaciones = \App\Evaluacion::ListEval($id);
            return view('Asignaturas.GestionEvaluaciones', compact('bandera', 'Evaluaciones', 'id'));
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function GestionTemas() {
        $bandera = "Menu4";
        if (Auth::check()) {
            $busqueda = request()->get('txtbusqueda');
            $nombre = request()->get('nombre');

            $actual = request()->get('page');
            if ($actual == null || $actual == "") {
                $actual = 1;
            }
            $limit = 5;
            $Temas = \App\Temas::Gestion($busqueda, $actual, $limit, $nombre);
            $Asignaturas = \App\Asignaturas::listar();

            $select_Asig = "<option value='' selected>TODAS LAS ASIGNATURAS</option>";
            foreach ($Asignaturas as $Asig) {
                if ($Asig->id == $nombre) {
                    $select_Asig .= "<option value='$Asig->id' selected> " . strtoupper($Asig->nombre) . "</option>";
                } else {
                    $select_Asig .= "<option value='$Asig->id' >" . strtoupper($Asig->nombre) . "</option>";
                }
            }


            $numero_filas = \App\Temas::numero_de_registros(request()->get('txtbusqueda'), $nombre);
            $paginas = ceil($numero_filas / $limit); //$numero_filas/10;

            return view('Asignaturas.GestionTemas', compact('bandera', 'numero_filas', 'paginas', 'actual', 'limit', 'busqueda', 'nombre', 'Temas', 'nombre', 'select_Asig'));
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }


    public function GestionNuevoTema() {
        $bandera = "Menu4";
        if (Auth::check()) {
            $Tema = new \App\Temas();
            $Asigna = \App\Modulos::listar();

            return view('Asignaturas.NuevoTema', compact('bandera', 'Tema', 'Asigna'));
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function GestionNuevaUnidad() {
        $idAsig = request()->get('id');
        $bandera = "Menu4";
        $opc = "nueva";
        if (Auth::check()) {
            $unid = new \App\Unidades();
            $Asigna = \App\Modulos::listar();

            return view('Asignaturas.NuevaUnidad', compact('bandera', 'unid', 'Asigna', 'opc'));
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function CambiarPeriodo() {
        $idAsig = request()->get('id');
        if (Auth::check()) {
            $Periodo = \App\Periodos::listar($idAsig);
            //            dd($Periodo);die();
            $select_Periodo = "<option value='' selected>Seleccione</option>";
            foreach ($Periodo as $Perio) {
                $select_Periodo .= "<option value='$Perio->id' >" . strtoupper($Perio->des_periodo) . "</option>";
            }
            if (request()->ajax()) {
                return response()->json([
                            'select_Periodo' => $select_Periodo
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }


    public function CambiarPeriodo2() {
        $idAsig = request()->get('id');
        $idPer = request()->get('idPer');
        if (Auth::check()) {
            $Periodo = \App\Periodos::listar($idAsig);

            $select_Periodo = "<option value='' selected>Seleccione</option>";
            foreach ($Periodo as $Perio) {
                $idPer = request()->get('idPer');
                if ($Perio->id == $idPer) {
                    $select_Periodo .= "<option value='$Perio->id' selected> " . strtoupper($Perio->des_periodo) . "</option>";
                } else {
                    $select_Periodo .= "<option value='$Perio->id' >" . strtoupper($Perio->des_periodo) . "</option>";
                }
            }
            if (request()->ajax()) {
                return response()->json([
                            'select_Periodo' => $select_Periodo
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function CambiarUnidad() {
        $idPeri = request()->get('id');
        if (Auth::check()) {
            $Unidades = \App\Unidades::listar($idPeri);
            //            dd($Periodo);die();
            $select_Unidades = "<option value='' selected>Seleccione</option>";
            foreach ($Unidades as $Uni) {
                $select_Unidades .= "<option value='$Uni->id' >" . strtoupper($Uni->nom_unidad . ' -- ' . $Uni->des_unidad) . "</option>";
            }
            if (request()->ajax()) {
                return response()->json([
                            'select_Unidades' => $select_Unidades
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function CambiarUnidad2() {
        $idPeri = request()->get('idPer');
        $idUnid = request()->get('idUnid');
        if (Auth::check()) {
            $Unidades = \App\Unidades::listar($idPeri);
            //            dd($Periodo);die();
            $select_Unidades = "<option value=''>Seleccione</option>";
            foreach ($Unidades as $Uni) {
                if ($Uni->id == $idUnid) {
                    $select_Unidades .= "<option value='$Uni->id' selected> " . strtoupper($Uni->nom_unidad . ' - ' . $Uni->des_unidad) . "</option>";
                } else {
                    $select_Unidades .= "<option value='$Uni->id' >" . strtoupper($Uni->nom_unidad . ' - ' . $Uni->des_unidad) . "</option>";
                }
            }
            if (request()->ajax()) {
                return response()->json([
                            'select_Unidades' => $select_Unidades
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function InfDocumentos() {
        $IdTema = request()->get('IdTema');
        if (Auth::check()) {
            $DesTema = \App\DesarrollTema::BuscarTema($IdTema);
            $content = $DesTema->cont_documento;
            if (request()->ajax()) {
                return response()->json([
                            'DesTema' => $DesTema,
                            'content' => $content
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function InfArchivos() {
        $IdTema = request()->get('IdTema');
        if (Auth::check()) {
            $DatArchivos = \App\SubirArcTema::BuscarArchi($IdTema);
            if (request()->ajax()) {
                return response()->json([
                            'Archivos' => $DatArchivos
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function InfLinks() {
        $IdTema = request()->get('IdTema');
        if (Auth::check()) {
            $DatLink = \App\DesarrolloLink::DesLink($IdTema);
            if (request()->ajax()) {
                return response()->json([
                            'Links' => $DatLink
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function InfEval() {
        $IdTema = request()->get('IdTema');
        if (Auth::check()) {
            $Dat = \App\Evaluacion::DesEval($IdTema);
            if ($Dat->tip_evaluacion == "GRUPREGUNTA") {
                $Pregutas = \App\EvalGrupPreg::GrupPreg($Dat->id);
                if (request()->ajax()) {
                    return response()->json([
                                'Resp' => $Pregutas,
                                'id_eval' => $Dat->id,
                                'titulo' => $Dat->titulo,
                                'hab_conversacion' => $Dat->hab_conversacion,
                                'intentos_perm' => $Dat->intentos_perm,
                                'calif_usando' => $Dat->calif_usando,
                                'punt_max' => $Dat->punt_max
                    ]);
                }
            } else if ($Dat->tip_evaluacion == "PREGENSAY") {
                $PregEnsy = \App\EvalPregEnsay::PregEnsay($Dat->id);
                $Preguta = $PregEnsy->pregunta;
                if (request()->ajax()) {
                    return response()->json([
                                'Resp' => $Preguta,
                                'id_eval' => $Dat->id,
                                'titulo' => $Dat->titulo,
                                'hab_conversacion' => $Dat->hab_conversacion,
                                'intentos_perm' => $Dat->intentos_perm,
                                'calif_usando' => $Dat->calif_usando,
                                'punt_max' => $Dat->punt_max
                    ]);
                }
            } else if ($Dat->tip_evaluacion == "OPCMULT") {
                $PregOpcMul = \App\PregOpcMul::GrupPreg($Dat->id);
                $OpcMul = \App\OpcPregMul::GrupOpc2($Dat->id);
                if (request()->ajax()) {
                    return response()->json([
                                'Preg' => $PregOpcMul,
                                'Opc' => $OpcMul,
                                'id_eval' => $Dat->id,
                                'titulo' => $Dat->titulo,
                                'hab_conversacion' => $Dat->hab_conversacion,
                                'intentos_perm' => $Dat->intentos_perm,
                                'calif_usando' => $Dat->calif_usando,
                                'punt_max' => $Dat->punt_max
                    ]);
                }
            } else {
                $Pregutas = \App\EvalVerFal::VerFal($Dat->id);

                if (request()->ajax()) {
                    return response()->json([
                                'Resp' => $Pregutas,
                                'id_eval' => $Dat->id,
                                'titulo' => $Dat->titulo,
                                'hab_conversacion' => $Dat->hab_conversacion,
                                'intentos_perm' => $Dat->intentos_perm,
                                'calif_usando' => $Dat->calif_usando,
                                'punt_max' => $Dat->punt_max
                    ]);
                }
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function GuardarAsig() {
        $bandera = "Menu4";

        if (Auth::check()) {

            $this->validate(request(), [
                'nombre' => 'required',
                'grado_modulo' => 'required',
                'grupos' => 'required'
                    ], [
                'nombre.required' => 'Debe Seleccionar la Asignatura',
                'grado_modulo.required' => 'Debe Seleccionar el Grado',
                'grupos.required' => 'Debe Seleccionar Los Grupos para el Grado Seleccionado'
            ]);
            $data = request()->all();

            if (request()->hasfile('imagen')) {

                foreach (request()->file('imagen') as $file) {
                    $name = rand(1, 100) . '_' . $file->getClientOriginalName();
                    $file->move(public_path() . '/app-assets/images/Img_Modulos/', $name);
                    $img[] = $name;
                }
            }
            $data['img'] = $img;
            $Asig = \App\Modulos::Guardar($data);
            if ($Asig) {
                $data['modulo_id'] = $Asig->id;
                $Grupos = \App\Grupos::Guardar($data);
                if ($Grupos) {
                    $periodos = \App\Periodos::Guardar($data);
                    if ($periodos) {
                        $ImgMod = \App\ImgModulos::Guardar($data);
                        if ($ImgMod) {
                            return redirect('Asignaturas/GestionGrado')->with('success', 'Datos Guardados');
                        } else {
                            return redirect('Asignaturas/GestionGrado')->with('error', 'Datos no Guardados');
                        }
                    } else {
                        return redirect('Asignaturas/GestionGrado')->with('error', 'Datos no Guardados');
                    }
                } else {
                    return redirect('Asignaturas/GestionGrado')->with('error', 'Datos no Guardados');
                }
            } else {
                return redirect('Asignaturas/GestionGrado')->with('error', 'Datos no Guardados');
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function editar($id) {
        $bandera = "Menu4";
        $opc = "editar";
        $trPer = '';
        $tr_img = '';
        $Cursos = '';

        if (Auth::check()) {

            $Modulo = \App\Modulos::BuscarAsig($id);
            $Asigna = \App\Asignaturas::listar();
            $Cole = \App\Colegios::InfColeg();

            $Perio = \App\Periodos::listar($id);
            $Grupos = \App\Grupos::listar($id);
            $Imagenes = \App\ImgModulos::ListImg($id);

            $ParGrupos = \App\ParGrupos::LisGrupos($Cole->num_cursos, $Cole->cant_grupos);

            $SelGrupos = "";
        
            foreach ($ParGrupos as $ParGrup) {
                $SelGrupos .= "<option value='$ParGrup->id' ";
                foreach ($Grupos as $Grup) {
                    if ($Grup->grupo == $ParGrup->id) {
                        $SelGrupos .= "selected";
                    }
                }
                $SelGrupos .= ">" . strtoupper($ParGrup->descripcion) . "</option>";
            }


            $i = 1;
            foreach ($Perio as $PR) {
                $trPer .= '<tr id="tr_' . $i . '">
                    <td class="text-truncate">' . $PR->des_periodo . '</td><input type="hidden" id="txtperi' . $i . '" name="txtperi[]"  value="' . $PR->des_periodo . '"><input type="hidden" id="txtidperi' . $i . '" name="txtidperi[]"  value="' . $PR->id . '">
                    <td class="text-truncate" id="td_porc' . $i . '">' . $PR->avance_perido . '</td><input type="hidden" id="txtporc' . $i . '" name="txtporc[]"  value="' . $PR->avance_perido . '">
                    <td class="text-truncate">
                    <a onclick="$.EditPer(' . $i . ')" class="btn btn-info btn-sm btnQuitar text-white"  title="Editar"><i class="fa fa-edit font-medium-3" aria-hidden="true"></i></a>&nbsp;
                    <a onclick="$.DelPer(' . $i . ')" class="btn btn-danger btn-sm btnQuitar text-white"  title="Eliminar"><i class="fa fa-trash-o font-medium-3" aria-hidden="true"></i></a>&nbsp;
              
                    </td>
                </tr>';
                $i++;
            }
            $j = 1;
            foreach ($Imagenes as $Img) {
                $tr_img .= '<tr id="trImg_' . $Img->id . '">
                    <td class="text-truncate">' . $j . '</td>
                    <td class="text-truncate">' . $Img->url_img . '</td>
                    <td class="text-truncate">
                    <a onclick="$.DelImg(' . $Img->id . ')" class="btn btn-danger btn-sm btnQuitar text-white"  title="Eliminar"><i class="fa fa-trash-o font-medium-3" aria-hidden="true"></i></a>&nbsp;
                     <a onclick="$.MostImg(this.id)" id="' . $Img->id . '"  data-archivo="' . $Img->url_img . '" class="btn btn-primary btn-sm btnVer text-white"  title="Ver"><i class="fa fa-search font-medium-3" aria-hidden="true"></i></a>&nbsp;   
                </td>
                </tr>';
                $j++;
            }

            return view('Asignaturas.EditarAsig', compact('bandera', 'Modulo', 'Asigna', 'trPer', 'tr_img', 'i', 'opc', 'SelGrupos'));
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function editarTema($id) {
        $bandera = "Menu4";
        $opc = "editar";
        if (Auth::check()) {

            $Tema = \App\Temas::BuscarTema($id);
            $Asigna = \App\Asignaturas::listar();
            return view('Asignaturas.EditarTema', compact('bandera', 'Tema', 'Asigna', 'opc'));
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function EditarEval($id) {
        $bandera = "Menu4";
        $opc = "editar";
        if (Auth::check()) {
            $Eval = \App\Evaluacion::BusEval($id);
            $Tema = \App\Temas::BuscarTema($Eval->contenido);
            $Asigna = \App\Modulos::listar();
            return view('Asignaturas.EditarEval', compact('bandera', 'Tema', 'Asigna', 'opc', 'Eval'));
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function modificarAsig($id) {
        if (Auth::check()) {
            $Asig = \App\Modulos::BuscarAsig($id);
            $this->validate(request(), [
                'nombre' => 'required',
                'grado_modulo' => 'required'
                    ], [
                'nombre.required' => 'Debe Seleccionar la Asignatura',
                'grado_modulo.required' => 'Debe Seleccionar el Grado'
            ]);
            $data = request()->all();
            $data['modulo_id'] = $id;

            if (request()->hasfile('imagen')) {

                foreach (request()->file('imagen') as $file) {
                    $name = rand(1, 100) . '_' . $file->getClientOriginalName();
                    $file->move(public_path() . '/app-assets/images/Img_Modulos/', $name);
                    $img[] = $name;
                }
                $data['img'] = $img;
            }
         
            $respuesta = \App\Modulos::modificar($data, $id);
            if ($respuesta) {
                $Grupos = \App\Grupos::Guardar($data);
                if ($Grupos) {
                    $periodos = \App\Periodos::Guardar($data);
                    if ($periodos) {
                        if (request()->hasfile('imagen')) {
                            $ImgMod = \App\ImgModulos::Guardar($data);
                            if ($ImgMod) {
                                return redirect('Asignaturas/GestionGrado')->with('success', 'Datos Guardados');
                            } else {
                                return redirect('Asignaturas/GestionGrado')->with('error', 'Datos no Guardados');
                            }
                        } else {
                            return redirect('Asignaturas/GestionGrado')->with('success', 'Datos Guardados');
                        }
                    } else {
                        return redirect('Asignaturas/GestionGrado')->with('error', 'Datos no Guardados');
                    }
                } else {
                    return redirect('Asignaturas/GestionGrado')->with('error', 'Datos no Guardados');
                }
            } else {
                return redirect('Asignaturas/GestionGrado')->with('error', 'Datos no Guardados');
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function consultarAsig($id) {
        $bandera = "Menu4";
        $opc = "Consulta";
        $trPer = '';
        $tr_img = '';

        if (Auth::check()) {
            $Asig = \App\Asignaturas::BuscarAsig($id);
            $Perio = \App\Periodos::listar($id);
            $Imagenes = \App\ImgModulos::ListImg($id);

            $i = 1;
            foreach ($Perio as $PR) {
                $trPer .= '<tr id="tr_' . $i . '">
                    <td class="text-truncate">' . $PR->des_periodo . '</td><input type="hidden" id="txtperi' . $i . '" name="txtperi[]"  value="' . $PR->des_periodo . '">
                    <td class="text-truncate">' . $PR->avance_perido . '</td><input type="hidden" id="txtporc' . $i . '" name="txtporc[]"  value="' . $PR->avance_perido . '">
                   
                </tr>';
                $i++;
            }
            $j = 1;
            foreach ($Imagenes as $Img) {
                $tr_img .= '<tr id="trImg_' . $Img->id . '">
                    <td class="text-truncate">' . $j . '</td>
                    <td class="text-truncate">' . $Img->url_img . '</td>
                    <td class="text-truncate">
                     <a onclick="$.MostImg(this.id)" id="' . $Img->id . '"  data-archivo="' . $Img->url_img . '" class="btn btn-primary btn-sm btnVer text-white"  title="Ver"><i class="fa fa-search font-medium-3" aria-hidden="true"></i></a>&nbsp;   
                </td>
                </tr>';
                $j++;
            }


            return view('Asignaturas.ConsultarAsig', compact('bandera', 'Asig', 'trPer', 'tr_img', 'i', 'opc'));
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function consultarUnidad($id) {
        $bandera = "Menu4";
        $opc = "Consulta";

        if (Auth::check()) {
            $unid = \App\Unidades::BuscarUnidad($id);
            $Asigna = \App\Modulos::listar();
            return view('Asignaturas.ConsultarUnidad', compact('bandera', 'unid', 'Asigna', 'opc'));
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function EliminarAsig() {
        $mensaje = "";
        $id = request()->get('id');
        if (Auth::check()) {
            $Asig = \App\Asignaturas::BuscarAsig($id);
            $estado = "ACTIVO";
            if ($Asig->estado_modulo == "ACTIVO") {
                $estado = "ELIMINADO";
            } else {
                $estado = "ACTIVO";
            }
            $respuesta = \App\Asignaturas::editarestado($id, $estado);

            if ($respuesta) {
                if ($estado == "ELIMINADO") {
                    $mensaje = 'Operación Realizada de Manera Exitosa';
                }
            } else {
                $mensaje = 'La Operación no pudo ser Realizada';
            }
            if (request()->ajax()) {
                return response()->json([
                            'estado' => $estado,
                            'mensaje' => $mensaje,
                            'id' => $id
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function EliminarUnidad() {
        $mensaje = "";
        $id = request()->get('id');
        if (Auth::check()) {
            $Unid = \App\Unidades::BuscarUnidad($id);
            $estado = "ACTIVO";
            if ($Unid->estado == "ACTIVO") {
                $estado = "ELIMINADO";
            } else {
                $estado = "ACTIVO";
            }
            $respuesta = \App\Unidades::editarestado($id, $estado);

            if ($respuesta) {
                if ($estado == "ELIMINADO|") {
                    $mensaje = 'Operación Realizada de Manera Exitosa';
                }
            } else {
                $mensaje = 'La Operación no pudo ser Realizada';
            }
            if (request()->ajax()) {
                return response()->json([
                            'estado' => $estado,
                            'mensaje' => $mensaje,
                            'id' => $id
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function EliminarTema() {
        $mensaje = "";
        $id = request()->get('id');
        if (Auth::check()) {
            $Tema = \App\Temas::BuscarTema($id);
        
            $estado = "ACTIVO";
            if ($Tema->estado == "ACTIVO") {
                $estado = "ELIMINADO";
            } else {
                $estado = "ACTIVO";
            }
            $respuesta = \App\Temas::editarestado($id, $estado);

            if ($respuesta) {
                if ($estado == "ELIMINADO") {
                    $mensaje = 'Operación Realizada de Manera Exitosa';
                }
            } else {
                $mensaje = 'La Operación no pudo ser Realizada';
            }
            if (request()->ajax()) {
                return response()->json([
                            'estado' => $estado,
                            'mensaje' => $mensaje,
                            'id' => $id
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function EliminarEval() {
        $mensaje = "";
        $icon = "";
        $id = request()->get('id');
        if (Auth::check()) {
            $Eval = \App\Evaluacion::BusEval($id);
            $Elib = \App\LibroCalificaciones::BusEval($id);
            if ($Elib) {
                $estado = "ACTIVO";
                $mensaje = 'La Evaluación no puede ser Eliminada, ya que ha sido resuelta por algun  Estudiante';
                $icon = 'warning';
            } else {
                $estado = "ACTIVO";
                if ($Eval->estado == "ACTIVO") {
                    $estado = "ELIMINADO";
                } else {
                    $estado = "ACTIVO";
                }
                $respuesta = \App\Evaluacion::editarestado($id, $estado);
                if ($respuesta) {
                    if ($estado == "ELIMINADO") {
                        $mensaje = 'Operación Realizada de Manera Exitosa';
                        $icon = 'success';
                    }
                } else {
                    $mensaje = 'La Operación no pudo ser Realizada';
                }
            }

            if (request()->ajax()) {
                return response()->json([
                            'estado' => $estado,
                            'mensaje' => $mensaje,
                            'id' => $id,
                            'icon' => $icon
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function DelImgMod() {

        $mensaje = "";
        $estado = "no";
        $id = request()->get('id');
        if (Auth::check()) {
            $respuesta = \App\ImgModulos::EliminarImg($id);
            if ($respuesta) {
                $mensaje = 'Operación Realizada de Manera Exitosa';
                $estado = "ok";
            } else {
                $mensaje = 'La Operación no pudo ser Realizada';
            }
            if (request()->ajax()) {
                return response()->json([
                            'id' => $id,
                            'mensaje' => $mensaje,
                            'estado' => $estado
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function DelArchivos() {

        $mensaje = "";
        $estado = "no";
        $id = request()->get('id');
        if (Auth::check()) {
            $respuesta = \App\SubirArcTema::EliminarArch($id);
            if ($respuesta) {
                $mensaje = 'Operación Realizada de Manera Exitosa';
                $estado = "ok";
            } else {
                $mensaje = 'La Operación no pudo ser Realizada';
            }
            if (request()->ajax()) {
                return response()->json([
                            'id' => $id,
                            'mensaje' => $mensaje,
                            'estado' => $estado
                ]);
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function guardarUnidad() {
        $bandera = "Menu4";

        if (Auth::check()) {
            $this->validate(request(), [
                'periodo' => 'required',
                'modulo' => 'required',
                'nom_unidad' => 'required'
                    ], [
                'modulo.required' => 'Debe Seleccionar la Asinatura',
                'periodo.required' => 'Debe Seleccionar el Periodo',
                'nom_unidad.required' => 'Seleccione el numero de la Unidad'
            ]);
            $data = request()->all();
            $Unid = \App\Unidades::Guardar($data);
            if ($Unid) {
                return redirect('Asignaturas/GestionUnid')->with('success', 'Datos Guardados');
            } else {
                return redirect('Asignaturas/GestionUnid')->with('error', 'Datos no Guardados');
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function editarUnidad($id) {
        $bandera = "Menu4";
        $opc = "editar";
        $trPer = '';

        if (Auth::check()) {

            $unid = \App\Unidades::BuscarUnidad($id);
            $Asigna = \App\Modulos::listar();
            return view('Asignaturas.EditarUnidad', compact('bandera', 'unid', 'opc', 'Asigna'));
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function AsigEvaluacion($id) {
        $bandera = "Menu4";
        $trEval = '';

        if (Auth::check()) {
            $Tema = \App\Temas::BuscarTema($id);

            $Eval = new \App\Evaluacion();
            $Asigna = \App\Modulos::listar();
            return view('Asignaturas.AsigEvaluacion', compact('bandera', 'Tema', 'Asigna', 'Eval'));
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function modificarUnidad($id) {
        if (Auth::check()) {
            $this->validate(request(), [
                'periodo' => 'required',
                'modulo' => 'required',
                'nom_unidad' => 'required'
                    ], [
                'modulo.required' => 'Debe Seleccionar la Asinatura',
                'periodo.required' => 'Debe Seleccionar el Periodo',
                'nom_unidad.required' => 'Seleccione el numero de la Unidad'
            ]);
            $data = request()->all();
            $respuesta = \App\Unidades::modificar($data, $id);
            if ($respuesta) {
                return redirect('Asignaturas/GestionUnid')->with('success', 'Datos Guardados');
            } else {
                return redirect('Asignaturas/GestionUnid')->with('error', 'Datos no Guardados');
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function guardarCont() {
        if (Auth::check()) {
            $this->validate(request(), [
                'modulo' => 'required',
                'periodo' => 'required',
                'unidad' => 'required',
                'tip_contenido' => 'required'
                    ], [
                'modulo.required' => 'Debe Seleccionar la Asinatura',
                'periodo.required' => 'Debe Seleccionar el Periodo',
                'unidad.required' => 'Seleccione el numero de la Unidad',
                'tip_contenido.required' => 'Seleccione el tipo de contenido'
            ]);
            $datos = request()->all();

            if ($datos['tip_contenido'] === "DOCUMENTO") {
                $Tem = \App\Temas::GuardarTipCont($datos);
                if ($Tem) {
                    $datos['tema_id'] = $Tem->id;
                    $ContTema = \App\DesarrollTema::GuardarContTema($datos);
                    if ($ContTema) {
                        return redirect('Asignaturas/GestionTem')->with('success', 'Datos Guardados');
                    } else {
                        return redirect('Asignaturas/GestionTem')->with('error', 'Datos no Guardados');
                    }
                } else {
                    return redirect('Asignaturas/GestionTem')->with('error', 'Datos no Guardados');
                }
            } else if ($datos['tip_contenido'] === "ARCHIVO") {

                $Tem = \App\Temas::GuardarTipCont($datos);
                if ($Tem) {
                    $datos['tema_id'] = $Tem->id;

                    if (request()->hasfile('archi')) {

                        foreach (request()->file('archi') as $file) {
                            $name = $file->getClientOriginalName();
                            $file->move(public_path() . '/app-assets/Archivos_Contenidos/', $name);
                            $arch[] = $name;
                        }
                    }
                    $datos['archi'] = $arch;
                    $ContTemaArc = \App\SubirArcTema::GuardarArchCont($datos);
                    if ($ContTemaArc) {
                        return redirect('Asignaturas/GestionTem')->with('success', 'Datos Guardados');
                    } else {
                        return redirect('Asignaturas/GestionTem')->with('error', 'Datos no Guardados');
                    }
                } else {
                    return redirect('Asignaturas/GestionTem')->with('error', 'Datos no Guardados');
                }
            } else if ($datos['tip_contenido'] === "LINK") {
                $Tem = \App\Temas::GuardarTipCont($datos);
                if ($Tem) {
                    $datos['tema_id'] = $Tem->id;

                    $ContTemaLink = \App\DesarrolloLink::Guardar($datos);

                    if ($ContTemaLink) {
                        return redirect('Asignaturas/GestionTem')->with('success', 'Datos Guardados');
                    } else {
                        return redirect('Asignaturas/GestionTem')->with('error', 'Datos no Guardados');
                    }
                } else {
                    return redirect('Asignaturas/GestionTem')->with('error', 'Datos no Guardados');
                }
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

///////////////////GUARDAR EVALUACIÓN
    public function guardarEvaluacion() {
        if (Auth::check()) {
            $this->validate(request(), [
                'clasificacion' => 'required',
                'tip_evaluacion' => 'required'
                    ], [
                'clasificacion.required' => 'Seleccione la Clasificación.',
                'tip_evaluacion.required' => 'Seleccione el tipo de Evaluación.'
            ]);
            $datos = request()->all();
            $IdTema = request()->get('tema_id');
            if ($datos['tip_evaluacion'] === "GRUPREGUNTA") {
                $ContEval = \App\Evaluacion::Guardar($datos);

                if ($ContEval) {
                    $ContOpcPre = \App\EvalGrupPreg::Guardar($datos, $ContEval->id);
                    if ($ContOpcPre) {
                        return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdTema)->with('success', 'Datos Guardados');
                    } else {
                        return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdTema)->with('error', 'Datos no Guardados');
                    }
                } else {
                    return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdTema)->with('error', 'Datos no Guardados');
                }
            } else if ($datos['tip_evaluacion'] === "PREGENSAY") {

                $ContEval = \App\Evaluacion::Guardar($datos);
                if ($ContEval) {
                    $ContOpcPre = \App\EvalPregEnsay::Guardar($datos, $ContEval->id);
                    if ($ContOpcPre) {
                        return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdTema)->with('success', 'Datos Guardados');
                    } else {
                        return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdTema)->with('error', 'Datos no Guardados');
                    }
                } else {
                    return redirect('Asignaturas/GestionTem/' . $IdTema)->with('error', 'Datos no Guardados');
                }
            } else if ($datos['tip_evaluacion'] === "VERFAL") {
                $ContEval = \App\Evaluacion::Guardar($datos);
                if ($ContEval) {

                    $ContVerFal = \App\EvalVerFal::Guardar($datos, $ContEval->id);
                    if ($ContVerFal) {
                        return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdTema)->with('success', 'Datos Guardados');
                    } else {
                        return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdTema)->with('error', 'Datos no Guardados');
                    }
                } else {
                    return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdTema)->with('error', 'Datos no Guardados');
                }
            } else if ($datos['tip_evaluacion'] === "OPCMULT") {

                $ContEval = \App\Evaluacion::Guardar($datos);
                if ($ContEval) {
                    $j = 1;
                    foreach ($datos['PreMulResp'] as $key => $val) {
                        $PregOpcMul = \App\PregOpcMul::Guardar($datos['PreMulResp'][$key], $datos['PreMulPunt'][$key], $ContEval->id);
                        if ($PregOpcMul) {
                            $OpciPregMul = \App\OpcPregMul::Guardar($datos, $PregOpcMul->id, $j, $ContEval->id);
                            if ($OpciPregMul) {
                                if ($val === end($datos['PreMulResp'])) {
                                    return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdTema)->with('success', 'Datos Guardados');
                                }
                            } else {
                                return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdTema)->with('error', 'Datos no Guardados');
                            }
                        } else {
                            return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdTema)->with('error', 'Datos no Guardados');
                        }
                        $j++;
                    }
                } else {
                    return redirect('Asignaturas/GestionTem')->with('error', 'Datos no Guardados');
                }
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function ModificarTema($id) {
        if (Auth::check()) {
            $this->validate(request(), [
                'modulo' => 'required',
                'periodo' => 'required',
                'unidad' => 'required',
                'tip_contenido' => 'required'
                    ], [
                'modulo.required' => 'Debe Seleccionar la Asinatura',
                'periodo.required' => 'Debe Seleccionar el Periodo',
                'unidad.required' => 'Seleccione el numero de la Unidad',
                'tip_contenido.required' => 'Seleccione el tipo de contenido'
            ]);
            $datos = request()->all();
            $datos['tema_id'] = $id;

            if ($datos['tip_contenido'] === "DOCUMENTO") {

                $Tem = \App\Temas::Modificar($datos, $id);

                if ($Tem) {
                    $ContTema = \App\DesarrollTema::Modificar($datos, $id);
                    if ($ContTema) {
                        return redirect('Asignaturas/GestionTem')->with('success', 'Datos Guardados');
                    } else {
                        return redirect('Asignaturas/GestionTem')->with('error', 'Datos no Guardados');
                    }
                } else {
                    return redirect('Asignaturas/GestionTem')->with('error', 'Datos no Guardados');
                }
            } else if ($datos['tip_contenido'] === "ARCHIVO") {
                $Tem = \App\Temas::Modificar($datos, $id);
                if (request()->hasfile('archi')) {

                    foreach (request()->file('archi') as $file) {
                        $name = $file->getClientOriginalName();
                        $file->move(public_path() . '/app-assets/Archivos_Contenidos/', $name);
                        $arch[] = $name;
                    }
                }
                $datos['archi'] = $arch;
                $ContTemaArc = \App\SubirArcTema::GuardarArchCont($datos);
                if ($ContTemaArc) {
                    return redirect('Asignaturas/GestionTem')->with('success', 'Datos Guardados');
                } else {
                    return redirect('Asignaturas/GestionTem')->with('error', 'Datos no Guardados');
                }
            } else if ($datos['tip_contenido'] === "LINK") {
                $Tem = \App\Temas::Modificar($datos, $id);
                if ($Tem) {

                    $ContTemaLink = \App\DesarrolloLink::Modificar($datos, $id);

                    if ($ContTemaLink) {
                        return redirect('Asignaturas/GestionTem')->with('success', 'Datos Guardados');
                    } else {
                        return redirect('Asignaturas/GestionTem')->with('error', 'Datos no Guardados');
                    }
                } else {
                    return redirect('Asignaturas/GestionTem')->with('error', 'Datos no Guardados');
                }
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

    public function ModificarEva($id) {
        if (Auth::check()) {
            $this->validate(request(), [
                'clasificacion' => 'required',
                'tip_evaluacion' => 'required'
                    ], [
                'clasificacion.required' => 'Seleccione la Clasificación.',
                'tip_evaluacion.required' => 'Seleccione el tipo de Evaluación.'
            ]);
            $datos = request()->all();
            $IdEval = request()->get('tema_id');
            if ($datos['tip_evaluacion'] === "GRUPREGUNTA") {

                $ContEval = \App\Evaluacion::ModifEval($datos, $id);
                if ($ContEval) {
                    $ContOpcPre = \App\EvalGrupPreg::ModifOpcPreg($datos);
                    if ($ContOpcPre) {
                        return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdEval)->with('success', 'Datos Guardados');
                    } else {
                        return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdEval)->with('error', 'Datos no Guardados');
                    }
                } else {
                    return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdEval)->with('error', 'Datos no Guardados');
                }
            } else if ($datos['tip_evaluacion'] === "PREGENSAY") {

                $ContEval = \App\Evaluacion::ModifEval($datos, $id);
                if ($ContEval) {
                    $ContPreg = \App\EvalPregEnsay::ModifPreg($datos);
                    if ($ContPreg) {
                        return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdEval)->with('success', 'Datos Guardados');
                    } else {
                        return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdEval)->with('error', 'Datos no Guardados');
                    }
                } else {
                    return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdEval)->with('error', 'Datos no Guardados');
                }
            } else if ($datos['tip_evaluacion'] === "OPCMULT") {

                $ContEval = \App\Evaluacion::ModifEval($datos, $id);
                if ($ContEval) {
                    $j = 1;
                    foreach ($datos['PreMulResp'] as $key => $val) {
                        $PregOpcMul = \App\PregOpcMul::ModiPreMul($datos['PreMulResp'][$key], $datos['PreMulPunt'][$key], $datos['Id_Eval'], $j);
                        if ($PregOpcMul) {
                            $OpciPregMul = \App\OpcPregMul::ModOpcPreg($datos, $PregOpcMul->id, $j, $datos['Id_Eval']);
                            if ($OpciPregMul) {
                                if ($val === end($datos['PreMulResp'])) {
                                    return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdEval)->with('success', 'Datos Guardados');
                                }
                            } else {
                                return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdEval)->with('error', 'Datos no Guardados');
                            }
                        } else {
                            return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdEval)->with('error', 'Datos no Guardados');
                        }
                        $j++;
                    }
                } else {
                    return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdEval)->with('error', 'Datos no Guardados');
                }
            } else if ($datos['tip_evaluacion'] === "VERFAL") {

                $ContEval = \App\Evaluacion::ModifEval($datos, $id);
                if ($ContEval) {
                    $ContPreg = \App\EvalVerFal::ModifOpcPreg($datos);
                    if ($ContPreg) {
                        return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdEval)->with('success', 'Datos Guardados');
                    } else {
                        return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdEval)->with('error', 'Datos no Guardados');
                    }
                } else {
                    return redirect('Asignaturas/GestionAsigEvaluacion/' . $IdEval)->with('error', 'Datos no Guardados');
                }
            }
        } else {
            return redirect("/")->with("error", "Su sesion ha terminado");
        }
    }

}
