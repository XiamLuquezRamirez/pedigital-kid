<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvalTaller extends Model {

    protected $table = 'eval_taller';
    protected $fillable = [
        'evaluacion',
        'nom_archivo'
    ];

    public static function PregTaller($id)
    {
        $PregTaller = EvalTaller::where('id', $id)
            ->first();
        return $PregTaller;
    }

    public static function EliminarArch($id) {
        $Archi = EvalTaller::find($id);
        $Archi->delete();
        return $Archi;
    }

}
