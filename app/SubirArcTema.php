<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;

class SubirArcTema extends Model {

    protected $table = 'cont_archivos';
    protected $fillable = [
        'contenido',
        'titulo',
        'nom_arch',
        'url_arch',
        'hab_conversacion',
        'zona_libre'
    ];

    public static function DesArch($id, $ZL) {
        $DesArc = SubirArcTema::where('contenido', $id)
                ->where('zona_libre', $ZL)
                ->get();
        return $DesArc;
    }

}
