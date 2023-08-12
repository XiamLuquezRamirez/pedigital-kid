<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;

class Periodos extends Model {

    protected $table = 'periodos';
    protected $fillable = [
        'modulo',
        'des_periodo',
        'avance_perido',
    ];

    public static function periodo($id) {
        $Periodo = Periodos::where('modulo', $id)
                ->where('estado', 'ACTIVO')
                ->get();
        return $Periodo;
    }

    public static function listar($id) {
        $Periodo = Periodos::where('modulo', $id)
                ->get();
        return $Periodo;
    }

    public static function Guardar($data) {
        foreach ($data["txtperi"] as $key => $val) {
            $respuesta = Periodos::updateOrCreate([
                        'id' => $data["txtidperi"][$key]
                            ], [
                        'modulo' => $data["modulo_id"],
                        'des_periodo' => $data["txtperi"][$key],
                        'avance_perido' => $data["txtporc"][$key]
            ]);
        }
        return $respuesta;
    }

}
