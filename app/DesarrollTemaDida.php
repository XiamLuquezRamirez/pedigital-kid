<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesarrollTemaDida extends Model {

    protected $table = 'cont_didactico';
    protected $fillable = [
        'contenido',
        'titulo',
        'cont_didactico',
    ];

    public static function BuscarTema($id) {
        $InfTema = DesarrollTemaDida::where('contenido', $id)
                ->get();
        return $InfTema;
    }

}
