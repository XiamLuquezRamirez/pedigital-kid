<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Grupos extends Model {

    protected $table = 'grupos';
    protected $fillable = [
        'grupo',
        'modulo',
        'estado'
    ];

    public static function Guardar($data) {

        foreach ($data["grupos"] as $key => $val) {

            $respuesta = Grupos::updateOrCreate([
                        'grupo' => $data["grupos"][$key],
                        'modulo' => $data["modulo_id"]
                            ], [
                        'grupo' => $data["grupos"][$key],
                        'modulo' => $data["modulo_id"],
                        'estado' => 'ACTIVO'
            ]);
        }
        return $respuesta;
    }

    public static function listar($id) {
        $Periodo = Grupos::where('modulo', $id)
                ->orderBy("grupo", "ASC")
                ->get();
        return $Periodo;
    }

    public static function BuscGrup($Grup) {
        $Periodo = Grupos::where('grupo', $Grup)
                ->where('modulo', Session::get('IDGRADO'))
                ->select('id')
                ->first();
        return $Periodo;
    }

    public static function listarGrupos($id) {
        $Periodo = Grupos::join("para_grupos", "para_grupos.id", "grupos.grupo")
                ->where('modulo', $id)
                ->select('para_grupos.descripcion', 'grupos.*')
                ->orderBy("grupo", "ASC")
                ->get();
        return $Periodo;
    }

    

}
