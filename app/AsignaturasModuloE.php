<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignaturasModuloE extends Model
{

    protected $table = 'asignaturas_mode';
    protected $fillable = [
        'nombre',
        'grado',
        'area',
        'descripcion',
        'imagen',
        'docente',
        'estado',
    ];

    public static function BuscarAsig($id)
    {
        return AsignaturasModuloE::findOrFail($id);
    }

    public static function AsigxUsu($Grado, $TipUsu)
    {
        $Asig = AsignaturasModuloE::where('grado', $Grado)
            ->where('estado', 'ACTIVO')
            ->get();

        return $Asig;
    }
}
