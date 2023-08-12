<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesarrollTemaModulos extends Model
{
    protected $table = 'cont_documento_modulos';
    protected $fillable = [
        'contenido',
        'titulo',
        'cont_documento',
        'hab_conversacion',
        'zona_libre',
    ];

    public static function Destemas($id, $ZL)
    {

        $DesTemas = DesarrollTemaModulos::where('contenido', $id)
            ->select('titulo', 'cont_documento', 'hab_conversacion')
            ->where('zona_libre', $ZL)
            ->first();
        return $DesTemas;
    }
}
