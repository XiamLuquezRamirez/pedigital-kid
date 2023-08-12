<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcedLaboratorios extends Model
{
    protected $table = 'proced_laboratorio';
    protected $fillable = [
        'laboratorio',
        'procedimiento',
        'vide_proced'
    ];

    public static function BuscarProc($id) {
        $ProcLab = ProcedLaboratorios::where('laboratorio', $id)
                ->get();
        return $ProcLab;
    }

}
