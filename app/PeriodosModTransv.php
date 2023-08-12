<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeriodosModTransv extends Model
{
    protected $table = 'periodos_modtransv';
    protected $fillable = [
        'modulo',
        'des_periodo',
        'avance_perido',
        'estado'
    ];

    public static function periodo($id) {
        $Periodo = PeriodosModTransv::where('modulo', $id)
                 ->where('estado', 'ACTIVO')
                ->get();
        return $Periodo;
    }
}
