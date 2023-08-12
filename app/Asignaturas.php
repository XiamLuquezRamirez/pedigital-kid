<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignaturas extends Model {

    protected $table = 'asignaturas';
    protected $fillable = [
        'nombre',
        'estado',
        'descripcion'
    ];

    public static function listar() {
        $Asig = Asignaturas::where('estado', "ACTIVO")
                ->get();
        return $Asig;
    }

    public static function listarAsigModulo() {
        $Asig = Asignaturas::where('estado', "ACTIVO")
                ->get();
        return $Asig;
    }

    public static function AsigxUsu($grado) {

        $Asig = Asignaturas::join("modulos", "modulos.asignatura", "asignaturas.id")
                ->where('modulos.grado_modulo', $grado)
                ->where('estado_modulo', 'ACTIVO')
                ->select("modulos.*", 'asignaturas.nombre')
                ->get();
        return $Asig;
    }

    public static function InfAsig($id) {
        $Asig = Asignaturas::where('id', $id)
                ->first();
        return $Asig;
    }

}
