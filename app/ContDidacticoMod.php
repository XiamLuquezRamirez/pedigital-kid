<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContDidacticoMod extends Model
{
    protected $table = 'cont_didactico_modulos';
    protected $fillable = [
        'contenido',
        'titulo',
        'cont_didactico',
        'zona_libre'
    ];

    public static function BuscarTema($id, $ZL) {
        $InfTema = ContDidacticoMod::where('contenido', $id)
                ->where('zona_libre', $ZL)
                ->get();
        return $InfTema;
    }
}
