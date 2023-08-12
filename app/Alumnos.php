<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Alumnos extends Model {

    protected $table = 'alumnos';
    protected $fillable = [
        'ident_alumno',
        'nombre_alumno',
        'apellido_alumno',
        'grado_alumno',
        'grupo',
        'sexo_alumno',
        'nacimiento_alumno',
        'direccion_alumno',
        'telefono_alumno',
        'email_alumno',
        'usuario_alumno',
        'estado_alumno',
        'foto_alumno',
        'jornada'
    ];

    public static function Gestion($busqueda, $pagina, $limit) {
        if ($pagina == "1") {
            $offset = 0;
        } else {
            $pagina--;
            $offset = $pagina * $limit;
        }
        if (!empty($busqueda)) {
            $respuesta = Alumnos::where('estado_alumno', 'ACTIVO')
                            ->where(function ($query) use ($busqueda) {
                                $query->where('ident_alumno', 'LIKE', '%' . $busqueda . '%')
                                ->orWhere('nombre_alumno', 'LIKE', '%' . $busqueda . '%')
                                ->orWhere('apellido_alumno', 'LIKE', '%' . $busqueda . '%')
                                ->orWhere('email_alumno', 'LIKE', '%' . $busqueda . '%');
                            })
                            ->selectRaw('CONCAT_WS(" ",nombre_alumno,apellido_alumno) as nomb')
                            ->select('alumnos.*')
                            ->orderBy('nombre_alumno', 'ASC')
                            ->limit($limit)->offset($offset);
        } else {
            $respuesta = Alumnos::where('estado_alumno', 'ACTIVO')
                            ->selectRaw('CONCAT_WS(" ",nombre_alumno,apellido_alumno) as nomb')
                            ->select('alumnos.*')
                            ->orderBy('nombre_alumno', 'ASC')
                            ->limit($limit)->offset($offset);
        }

        return $respuesta->get();
    }

    public static function GestionAlumnosEval($busqueda, $pagina, $limit, $grado) {
        if ($pagina == "1") {
            $offset = 0;
        } else {
            $pagina--;
            $offset = $pagina * $limit;
        }
        if (!empty($busqueda)) {
            $respuesta = Alumnos::where('estado_alumno', 'ACTIVO')
                            ->Where('grado_alumno', $grado)
                            ->where(function ($query) use ($busqueda) {
                                $query->where('ident_alumno', 'LIKE', '%' . $busqueda . '%')
                                ->orWhere('nombre_alumno', 'LIKE', '%' . $busqueda . '%')
                                ->orWhere('apellido_alumno', 'LIKE', '%' . $busqueda . '%')
                                ->orWhere('email_alumno', 'LIKE', '%' . $busqueda . '%');
                            })
                            ->selectRaw('CONCAT_WS(" ",nombre_alumno,apellido_alumno) as nomb')
                            ->select('alumnos.*')
                            ->orderBy('nombre_alumno', 'ASC')
                            ->limit($limit)->offset($offset);
        } else {
            $respuesta = Alumnos::where('estado_alumno', 'ACTIVO')
                            ->Where('grado_alumno', $grado)
                            ->selectRaw('CONCAT_WS(" ",nombre_alumno,apellido_alumno) as nomb')
                            ->select('alumnos.*')
                            ->orderBy('nombre_alumno', 'ASC')
                            ->limit($limit)->offset($offset);
        }

        return $respuesta->get();
    }

    public static function numero_de_registros($busqueda) {
        if (!empty($busqueda)) {
            $respuesta = Alumnos::where('estado_alumno', 'ACTIVO')
                    ->where(function ($query) use ($busqueda) {
                        $query->where('ident_alumno', 'LIKE', '%' . $busqueda . '%')
                        ->orWhere('nombre_alumno', 'LIKE', '%' . $busqueda . '%')
                        ->orWhere('apellido_alumno', 'LIKE', '%' . $busqueda . '%')
                        ->orWhere('email_alumno', 'LIKE', '%' . $busqueda . '%');
                    })
                    ->orderBy('nombre_alumno', 'ASC');
        } else {
            $respuesta = Alumnos::where('estado_alumno', 'ACTIVO')
                    ->orderBy('nombre_alumno', 'ASC');
        }
        return $respuesta->count();
    }

    public static function numero_de_registrosAlumnosEval($busqueda, $grado) {
        if (!empty($busqueda)) {
            $respuesta = Alumnos::where('estado_alumno', 'ACTIVO')
                    ->Where('grado_alumno', $grado)
                    ->where(function ($query) use ($busqueda) {
                        $query->where('ident_alumno', 'LIKE', '%' . $busqueda . '%')
                        ->orWhere('nombre_alumno', 'LIKE', '%' . $busqueda . '%')
                        ->orWhere('apellido_alumno', 'LIKE', '%' . $busqueda . '%')
                        ->orWhere('email_alumno', 'LIKE', '%' . $busqueda . '%');
                    })
                    ->orderBy('nombre_alumno', 'ASC');
        } else {
            $respuesta = Alumnos::where('estado_alumno', 'ACTIVO')
                    ->Where('grado_alumno', $grado)
                    ->orderBy('nombre_alumno', 'ASC');
        }
        return $respuesta->count();
    }

    public static function Guardar($data) {

        return Alumnos::create([
                    'ident_alumno' => $data['ident_alumno'],
                    'nombre_alumno' => $data['nombre_alumno'],
                    'apellido_alumno' => $data['apellido_alumno'],
                    'grado_alumno' => $data['grado_alumno'],
                    'grupo' => $data['grupo'],
                    'sexo_alumno' => $data['sexo_alumno'],
                    'nacimiento_alumno' => $data['fnacimiento'],
                    'direccion_alumno' => $data['direccion_alumno'],
                    'telefono_alumno' => $data['telefono_alumno'],
                    'email_alumno' => $data['email_alumno'],
                    'usuario_alumno' => $data['usuario_alumno'],
                    'estado_alumno' => 'ACTIVO',
                    'foto_alumno' => $data['img']
        ]);
    }

    public static function BuscarAlum($id) {

        return Alumnos::findOrFail($id);
    }

    public static function modificar($data, $id) {
        $respuesta = Alumnos::where(['id' => $id])->update([
            'ident_alumno' => $data['ident_alumno'],
            'nombre_alumno' => $data['nombre_alumno'],
            'apellido_alumno' => $data['apellido_alumno'],
            'grado_alumno' => $data['grado_alumno'],
            'grupo' => $data['grupo'],
            'sexo_alumno' => $data['sexo_alumno'],
            'nacimiento_alumno' => $data['fnacimiento'],
            'direccion_alumno' => $data['direccion_alumno'],
            'telefono_alumno' => $data['telefono_alumno'],
            'email_alumno' => $data['email_alumno'],
            'foto_alumno' => $data['img']
        ]);
        return $respuesta;
    }

    public static function editarestado($id, $estado) {
        $Respuesta = Alumnos::where('id', $id)->update([
            'estado_alumno' => $estado
        ]);
        return $Respuesta;
    }

    public static function Buscar($id) {
        $Alumno = Alumnos::join('users', 'users.id', 'alumnos.usuario_alumno')
                        ->where('usuario_alumno', $id)->first();
        return $Alumno;
    }

    public static function AlumnosxGrado($Grado,$Grupo) {
            
        return Alumnos::where('grado_alumno', $Grado)
                ->where('grupo',$Grupo)
                        ->get();
    }

}
