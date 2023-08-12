<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;

class DesarrollTema extends Model
{

    protected $table = 'cont_documento';
    protected $fillable = [
        'contenido',
        'titulo',
        'cont_documento',
        'hab_conversacion',
        'zona_libre'
    ];

      public static function Destemas($id, $ZL) {

        $DesTemas = DesarrollTema::where('contenido', $id)
                ->where('zona_libre', $ZL)
                ->first();
        return $DesTemas;
    }
 
  public static function BuscarTema($id, $ZL) {
        $InfTema = DesarrollTema::where('contenido', $id)
                ->where('zona_libre', $ZL)
                ->first();
        return $InfTema;
    }
}
