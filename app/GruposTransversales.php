<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;

class GruposTransversales extends Model
{
    protected $table = 'grupos_transversales';
    protected $fillable = [
        'grupo',
        'modulo',
        'estado',
    ];

    public static function listarGrupos($id) {
        $Periodo = GruposTransversales::join("para_grupos", "para_grupos.id", "grupos_transversales.grupo")
                ->where('modulo', $id)
                ->select('para_grupos.descripcion', 'grupos_transversales.*')
                ->orderBy("grupo", "ASC")
                ->get();
        return $Periodo;
    }

    public static function BuscGrup($Grup) {
        $Periodo = GruposTransversales::where('grupo', $Grup)
                ->where('modulo', Session::get('IDGRADO'))
                ->select('id')
                ->first();
        return $Periodo;
    }
}
