<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesarrollTemaDidaMod extends Model
{
    protected $table = 'cont_didactico_modulos';
    protected $fillable = [
        'contenido',
        'titulo',
        'cont_didactico',
    ];

    public static function BuscarTema($id) {
        $InfTema = DesarrollTemaDidaMod::where('contenido', $id)
                ->get();
        return $InfTema;
    }
}
