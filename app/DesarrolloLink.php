<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesarrolloLink extends Model
{
      protected $table = 'cont_link';
    protected $fillable = [
        'contenido',
        'titulo',
        'url',
        'hab_conversacion',
        'zona_libre'
    ];
    
       public static function DesLink($id, $ZL) {
        $DesLink = DesarrolloLink::where('contenido', $id)
                ->where('zona_libre', $ZL)
                ->get();
        return $DesLink;
    }
}
