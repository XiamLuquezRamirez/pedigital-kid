<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Unidades extends Model
{

    protected $table = 'unidades';
    protected $fillable = [
        'periodo',
        'modulo',
        'nom_unidad',
        'des_unidad',
        'estado',
        'introduccion',
    ];

    public static function unidad($id)
    {

        if (Auth::user()->tipo_usuario == "Profesor") {
            $Usu = Auth::user()->id;
            $Unidade = Unidades::where('modulo', $id)
                ->where(function ($query) use ($Usu) {
                    $query->where('unidades.docente', "")
                        ->orWhere('unidades.docente', $Usu);
                })
                ->orderBy('periodo', 'ASC')
                ->get();
            return $Unidade;
        } else if (Auth::user()->tipo_usuario == "Estudiante") {
            $Usu = Session::get('USUDOCENTE');
            $Unidade = Unidades::where('modulo', $id)
                ->where(function ($query) use ($Usu) {
                    $query->where('unidades.docente', "")
                    ->orWhere('unidades.docente','LIKE', "%".$Usu."%");
                })
                ->orderBy('periodo', 'ASC')
                ->get();
            return $Unidade;
        } else {
            $Unidade = Unidades::where('modulo', $id)
                ->orderBy('periodo', 'ASC')
                ->get();
            return $Unidade;
        }

    }

    public static function listar($id)
    {
        $Unidade = Unidades::where('periodo', $id)
            ->get();
        return $Unidade;
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
                $respuesta = Unidades::join('modulos', 'modulos.id', 'unidades.modulo')
                    ->join('periodos', 'periodos.id', 'unidades.periodo')
                    ->join('asignaturas', 'asignaturas.id', 'modulos.asignatura')
                    ->where('unidades.estado', 'ACTIVO')
                    ->where('modulos.asignatura', $Asig)
                    ->where(function ($query) use ($busqueda) {
                        $query->where('unidades.nom_unidad', 'LIKE', '%' . $busqueda . '%')
                            ->orWhere('unidades.des_unidad', 'LIKE', '%' . $busqueda . '%')
                            ->orWhere('asignaturas.nombre', 'LIKE', '%' . $busqueda . '%');
                    })
                    ->select('unidades.*', 'asignaturas.nombre', 'periodos.des_periodo', 'modulos.grado_modulo')
                    ->orderBy('nom_unidad', 'ASC')
                    ->limit($limit)->offset($offset);
            } else {
                $respuesta = Unidades::join('modulos', 'modulos.id', 'unidades.modulo')
                    ->join('periodos', 'periodos.id', 'unidades.periodo')
                    ->join('asignaturas', 'asignaturas.id', 'modulos.asignatura')
                    ->where('unidades.estado', 'ACTIVO')
                    ->where(function ($query) use ($busqueda) {
                        $query->where('unidades.nom_unidad', 'LIKE', '%' . $busqueda . '%')
                            ->orWhere('unidades.des_unidad', 'LIKE', '%' . $busqueda . '%')
                            ->orWhere('asignaturas.nombre', 'LIKE', '%' . $busqueda . '%');
                    })
                    ->select('unidades.*', 'asignaturas.nombre', 'periodos.des_periodo', 'modulos.grado_modulo')
                    ->orderBy('nom_unidad', 'ASC')
                    ->limit($limit)->offset($offset);
            }
        } else {
            if (!empty($Asig)) {
                $respuesta = Unidades::join('modulos', 'modulos.id', 'unidades.modulo')
                    ->join('periodos', 'periodos.id', 'unidades.periodo')
                    ->join('asignaturas', 'asignaturas.id', 'modulos.asignatura')
                    ->where('unidades.estado', 'ACTIVO')
                    ->where('modulos.asignatura', $Asig)
                    ->select('unidades.*', 'asignaturas.nombre', 'periodos.des_periodo', 'modulos.grado_modulo')
                    ->orderBy('nom_unidad', 'ASC')
                    ->limit($limit)->offset($offset);
            } else {
                $respuesta = Unidades::join('modulos', 'modulos.id', 'unidades.modulo')
                    ->join('periodos', 'periodos.id', 'unidades.periodo')
                    ->join('asignaturas', 'asignaturas.id', 'modulos.asignatura')
                    ->where('unidades.estado', 'ACTIVO')
                    ->select('unidades.*', 'asignaturas.nombre', 'periodos.des_periodo', 'modulos.grado_modulo')
                    ->orderBy('nom_unidad', 'ASC')
                    ->limit($limit)->offset($offset);
            }
        }

        return $respuesta->get();
    }

    public static function numero_de_registros($busqueda, $Asig)
    {
        if (!empty($busqueda)) {
            if (!empty($Asig)) {
                $respuesta = Unidades::join('modulos', 'modulos.id', 'unidades.modulo')
                    ->where('unidades.estado', 'ACTIVO')
                    ->where('modulos.asignatura', $Asig)
                    ->where(function ($query) use ($busqueda) {
                        $query->where('nom_unidad', 'LIKE', '%' . $busqueda . '%')
                            ->orWhere('des_unidad', 'LIKE', '%' . $busqueda . '%');
                    })
                    ->orderBy('nom_unidad', 'ASC');
            } else {
                $respuesta = Unidades::join('modulos', 'modulos.id', 'unidades.modulo')
                    ->where('unidades.estado', 'ACTIVO')
                    ->where(function ($query) use ($busqueda) {
                        $query->where('nom_unidad', 'LIKE', '%' . $busqueda . '%')
                            ->orWhere('des_unidad', 'LIKE', '%' . $busqueda . '%');
                    })
                    ->orderBy('nom_unidad', 'ASC');
            }
        } else {
            if (!empty($Asig)) {
                $respuesta = Unidades::join('modulos', 'modulos.id', 'unidades.modulo')
                    ->where('estado', 'ACTIVO')
                    ->where('modulos.asignatura', $Asig)
                    ->orderBy('nom_unidad', 'ASC');
            } else {
                $respuesta = Unidades::join('modulos', 'modulos.id', 'unidades.modulo')
                    ->where('estado', 'ACTIVO')
                    ->orderBy('nom_unidad', 'ASC');
            }
        }
        return $respuesta->count();
    }

    public static function TitUnidades($id)
    {
        $DesUnidade = Unidades::where('id', $id)
            ->first();
        return $DesUnidade;
    }

    public static function BuscarUnidad($id)
    {
        return Unidades::findOrFail($id);
    }

    public static function Guardar($datos)
    {

        return Unidades::create([
            'periodo' => $datos['periodo'],
            'modulo' => $datos['modulo'],
            'nom_unidad' => $datos['nom_unidad'],
            'des_unidad' => $datos['des_unidad'],
            'estado' => 'ACTIVO',
            'introduccion' => $datos['introduccion'],
        ]);
    }

    public static function modificar($data, $id)
    {
        $respuesta = Unidades::where(['id' => $id])->update([
            'periodo' => $data['periodo'],
            'modulo' => $data['modulo'],
            'nom_unidad' => $data['nom_unidad'],
            'des_unidad' => $data['des_unidad'],
            'introduccion' => $data['introduccion'],
        ]);
        return $respuesta;
    }

    public static function editarestado($id, $estado)
    {
        $Respuesta = Unidades::where('id', $id)->update([
            'estado' => $estado,
        ]);
        return $Respuesta;
    }

}
