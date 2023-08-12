<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContDidactico extends Model {

    protected $table = 'cont_didactico';
    protected $fillable = [
        'contenido',
        'titulo',
        'cont_didactico',
        'zona_libre'
    ];

    public static function BuscarTema($id, $ZL) {
        $InfTema = ContDidactico::where('contenido', $id)
                ->where('zona_libre', $ZL)
                ->get();
        return $InfTema;
    }

}
