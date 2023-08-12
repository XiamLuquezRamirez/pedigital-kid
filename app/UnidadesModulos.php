<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class UnidadesModulos extends Model
{
    protected $table = 'unidades_modulos';
    protected $fillable = [
        'periodo',
        'modulo',
        'nom_unidad',
        'des_unidad',
        'estado',
        'introduccion',
        'origunidad',
        'docente',
    ];

    public static function unidad($id)
    {
       
        if (Auth::user()->tipo_usuario == "Profesor") {
            $Usu = Auth::user()->id;
            $Unidade = UnidadesModulos::where('modulo', $id)
                ->where(function ($query) use ($Usu) {
                    $query->where('unidades_modulos.docente', "")
                        ->orWhere('unidades_modulos.docente', $Usu);
                })
                ->orderBy('periodo', 'ASC')
                ->get();
            return $Unidade;
        } else if (Auth::user()->tipo_usuario == "Estudiante") {
            $Usu = Session::get('USUDOCENTE');
            $Unidade = UnidadesModulos::where('modulo', $id)
                ->where(function ($query) use ($Usu) {
                    $query->where('unidades_modulos.docente', "")
                    ->orWhere('unidades_modulos.docente','LIKE', "%".$Usu."%");
                })
                ->orderBy('periodo', 'ASC')
                ->get();
            return $Unidade;
        } else {
            $Unidade = UnidadesModulos::where('modulo', $id)
                ->orderBy('periodo', 'ASC')
                ->get();
            return $Unidade;
        }
    }

    public static function BuscarUnidad($id)
    {
        return UnidadesModulos::findOrFail($id);
    }
}
