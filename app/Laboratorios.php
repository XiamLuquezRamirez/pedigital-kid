<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratorios extends Model
{
    protected $table = 'laboratorios';
    protected $fillable = [
        'modulo',
        'periodo',
        'unidad',
        'titulo',
        'objetivo',
        'fund_teorico',
        'materiales',
        'habilitado',
        'docente',
        'estado',
    ];

    public static function LisLab($id)
    {

        $ListLab = Laboratorios::join('unidades', 'unidades.id', 'laboratorios.unidad')
            ->join('modulos', 'modulos.id', 'unidades.modulo')
            ->where('laboratorios.modulo', $id)
            ->selectRaw('count(*) as nlab')
            ->first();
        return $ListLab;

    }

    public static function ListLabUnidad($id)
    {

        $ListLab = Laboratorios::join('unidades', 'unidades.id', 'laboratorios.unidad')
            ->join('modulos', 'modulos.id', 'unidades.modulo')
            ->where('laboratorios.modulo', $id)
            ->selectRaw('count(*) as nlab,unidades.nom_unidad,unidades.des_unidad,unidades.id')
            ->groupBy('unidades.id', 'unidades.nom_unidad', 'unidades.des_unidad')
            ->get();

        return $ListLab;

    }

    public static function BuscarLab($id)
    {
        return Laboratorios::findOrFail($id);
    }

    public static function ListLaboTemas($id)
    {

        $ListLab = Laboratorios::join('unidades', 'unidades.id', 'laboratorios.unidad')
            ->join('modulos', 'modulos.id', 'unidades.modulo')
            ->join('asig_prof', 'asig_prof.grado', 'modulos.id')
            ->join('asignaturas', 'asignaturas.id', 'modulos.asignatura')
            ->where('asignaturas.estado', 'ACTIVO')
            ->where('laboratorios.estado', 'ACTIVO')
            ->where('laboratorios.unidad', $id)
            ->selectRaw('laboratorios.id,laboratorios.titulo,laboratorios.objetivo')
            ->orderBy('laboratorios.titulo', 'ASC')
            ->groupBy('laboratorios.id', 'laboratorios.titulo', 'laboratorios.objetivo')
            ->get();
        return $ListLab;

    }
}
