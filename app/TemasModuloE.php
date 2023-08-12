<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemasModuloE extends Model
{
    protected $table = 'temas_moduloe';
    protected $fillable = [
        'titulo',
        'asignatura',
        'componente',
        'tipo_contenido',
        'animacion',
        'estado',
    ];


    public static function listarxAssig($Asig)
    {
        $Asig = TemasModuloE::where('estado', "ACTIVO")
            ->where('asignatura', $Asig)
            ->get();
        return $Asig;
    }

    public static function BuscarTem($id)
    {
        return TemasModuloE::findOrFail($id);
    }
}
